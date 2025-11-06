<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Smalot\PdfParser\Parser;
use HosseinHezami\LaravelGemini\Facades\Gemini;


class CurriculoController extends Controller
{
    public function analisar(Request $request)
    {

        $request->validate([
            'curriculo' => 'required|file|mimes:pdf|max:2048',
            'descricao_vaga' => 'nullable|string',
        ]);

        $arquivo = $request->file('curriculo');
        $parser = new Parser();
        $pdf = $parser->parseFile($arquivo->getPathname());
        $textoDoCurriculo = $pdf->getText();

        $descricaoVaga = $request->input('descricao_vaga');

        $prompt = "";


        if (empty(trim($descricaoVaga))) {

            // --- PROMPT 1 (VAGA VAZIA) ---
            // A IA faz apenas a análise geral.
            $prompt = "
                Você é um especialista em recrutamento e seleção (RH) focado em vagas de tecnologia.
                Analise o seguinte texto de currículo que foi extraído de um PDF:
                ---
                $textoDoCurriculo
                ---
                Com base APENAS no texto acima, me retorne uma análise em formato JSON.
                O JSON deve ter EXATAMENTE as seguintes chaves:
                1. 'pontos_fortes': (Uma lista [array de strings] com 2 ou 3 pontos fortes).
                2. 'pontos_a_melhorar': (Uma lista [array de strings] com 2 ou 3 dicas de melhoria. Seja construtivo).
                3. 'habilidades_encontradas': (Uma lista [array de strings] com as 5 a 10 principais habilidades técnicas ou soft skills encontradas).
                4. 'possivel_area': (Uma string única sugerindo a área de atuação mais provável).
                
                Formate a resposta APENAS como um JSON válido, começando com { e terminando com }.
            ";
        } else {
            $prompt = "
                Você é um Recrutador Sênior (Tech Recruiter) ético.
                Seu trabalho é analisar um [CURRÍCULO] e compará-lo com uma [VAGA].

                [CURRÍCULO]
                ---
                $textoDoCurriculo
                ---

                [VAGA]
                ---
                $descricaoVaga
                ---

                REGRA DE ÉTICA (MUITO IMPORTANTE):
                NUNCA sugira ao candidato adicionar habilidades ou experiências que NÃO estão no [CURRÍCULO] (NÃO MENTIR).
                Suas sugestões devem ser sobre REESCREVER ou REORGANIZAR o currículo para DAR DESTAQUE (highlight) ao que o candidato JÁ TEM.
                Exemplo CORRETO: 'A vaga pede 'API REST'. No seu projeto X, reescreva a descrição para focar em como você usou APIs.'
                Exemplo ERRADO: 'A vaga pede 'Docker'. Adicione 'Docker' nas suas habilidades.'

                Por favor, me retorne um JSON com EXATAMENTE as seguintes chaves:
                
                (Parte 1: Análise Geral)
                1. 'pontos_fortes': (Uma lista [array de strings] com 2 ou 3 pontos fortes GERAIS do currículo).
                2. 'pontos_a_melhorar': (Uma lista [array de strings] com 2 ou 3 dicas de melhoria GERAIS).
                3. 'habilidades_encontradas': (Uma lista [array de strings] com as 5 a 10 principais habilidades GERAIS).

                (Parte 2: Análise da Vaga - O que você pediu)
                5. 'sugestoes_com_base_na_vaga': (Uma lista [array de strings] com 2 ou 3 dicas de como REESCREVER o currículo para destacar habilidades que a [VAGA] pede e que o [CURRÍCULO] já possui, seguindo a REGRA DE ÉTICA).
                6. 'palavras_chave_faltando': (Uma lista [array de strings] de 3 a 5 palavras-chave que a [VAGA] pede e que o [CURRÍCULO] não mencionou. NÃO sugira mentir, apenas liste as palavras).
                
                Formate a resposta APENAS como um JSON válido, começando com { e terminando com }.
            ";
        }

        try {

            $respostaDaIA = Gemini::text()
                ->model('gemini-2.5-flash-lite')
                ->prompt($prompt)
                ->generate();

            // Lendo a resposta da IA
            $responseArray = $respostaDaIA->toArray();
            $jsonTexto = $responseArray['candidates'][0]['content']['parts'][0]['text'];

            // Limpando o texto para extrair apenas o JSON
            $jsonLimpo = preg_replace('/^```json\s*|\s*```$/m', '', trim($jsonTexto));
            $analiseArray = json_decode($jsonLimpo, true);

            if ($analiseArray) {
                return view('pages.aluno.curriculo-resultado', ['analise' => $analiseArray]);
            } else {
                throw new \Exception("Não foi possível decodificar o JSON recebido da IA.");
            }
        } catch (\Exception $e) {
            // Se a API der erro
            Log::error('Erro na API do Gemini: ' . $e->getMessage());
            echo "Ocorreu um erro ao tentar analisar o currículo. <br>";
            echo "Erro: " . $e->getMessage();
        }
    }
}
