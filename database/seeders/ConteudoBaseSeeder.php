<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Conteudo;
use App\Models\Tag;
use App\Models\Categoria;
use App\Models\Usuario;
use Illuminate\Support\Carbon;

class ConteudoBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Configuração e Busca de IDs
        $admin = Usuario::where('type_user', 'ADM')->first();

        // Nomes das categorias principais 
        $catOrientacao = Categoria::where('name_category', 'Orientação Profissional/Material de Apoio')->first();
        $catRequisitos = Categoria::where('name_category', 'Áreas de Atuação e Requisitos Técnicos')->first();
        $catTecnico = Categoria::where('name_category', 'Conteúdo Técnico Específico')->first();

        if (!$admin || !$catOrientacao || !$catRequisitos || !$catTecnico) {
             echo "ERRO: Dependências (Admin ou Categorias Principais) não encontradas. Verifique se AdminUserSeeder e CategoriasPrincipaisSeeder rodaram.\n";
             return;
        }

        // Busca de Tags
        $tags = Tag::all()->pluck('id', 'name_tag')->toArray();

        // Função para mapear strings de tags para IDs, ignorando tags não encontradas
        $mapTags = fn(array $names) => array_filter(array_map(fn($name) => $tags[$name] ?? null, $names));

        $allContent = $this->getContentData($catOrientacao->id, $catRequisitos->id, $catTecnico->id, $mapTags);

        //inserção e Attachments
        $dt_base = Carbon::now()->subDays(30);

        foreach ($allContent as $index => $data) {
            
            $conteudo = Conteudo::create([
                'autor_id' => $admin->id,
                'titulo' => $data['titulo'],
                'descricao' => $data['descricao'],
                'img' => $data['img'],
                'active_content' => true,
                // Distribui a data de criação ao longo dos 30 dias passados
                'dt_created' => $dt_base->copy()->addDays($index), 
                'dt_updated' => $dt_base->copy()->addDays($index),
            ]);

            // Anexa as Categorias (M:N)
            $conteudo->categorias()->attach($data['categorias_ids']);
            
            // Anexa as Tags (M:N)
            if (!empty($data['tags_ids'])) {
                $conteudo->tags()->attach($data['tags_ids']);
            }
        }
    }

    //Lista dos conteudos
    private function getContentData(int $catOrientacaoId, int $catRequisitosId, int $catTecnicoId, callable $mapTags): array
    {
        return [
            // =========================================================
            // TEMA 1: ORIENTAÇÃO PROFISSIONAL (10 CONTEÚDOS)
            // =========================================================
            [
                'titulo' => 'Guia Essencial: Currículo Vencedor',
                'descricao' => 'Um passo a passo detalhado sobre como estruturar um currículo sem experiência formal. Aborda o que incluir, o que omitir e como transformar projetos pessoais em experiência relevante. Inclui modelos e checklists essenciais para o seu início de carreira, garantindo que seu perfil se destaque no processo seletivo e chame a atenção dos recrutadores de tecnologia.',
                'img' => 'imagens_conteudo/cv_guia_definitivo.jpg',
                'categorias_ids' => [$catOrientacaoId],
                'tags_ids' => $mapTags(['Currículo', 'Entrevista', 'Carreira', 'Júnior']),
            ],
            [
                'titulo' => 'O Segredo das Entrevistas Comportamentais',
                'descricao' => 'Focado em como responder às perguntas de soft skills (ex: "Fale sobre um desafio"). Explica a metodologia STAR e como usá-la para narrar experiências de forma concisa e impactante, demonstrando suas habilidades de comunicação e resiliência sob pressão.',
                'img' => 'imagens_conteudo/metodo_star_diagrama.png',
                'categorias_ids' => [$catOrientacaoId],
                'tags_ids' => $mapTags(['Entrevista', 'Soft Skills', 'Comunicação', 'Resiliência']),
            ],
            [
                'titulo' => 'Criando Seu Primeiro Portfólio do Zero',
                'descricao' => 'Tutorial prático sobre quais plataformas usar (GitHub, Behance, Vercel), o que incluir em cada projeto e como escrever case studies convincentes que demonstrem seu processo de raciocínio, não apenas o código final. Essencial para quem busca a primeira vaga e precisa de exemplos visuais do seu trabalho.',
                'img' => 'imagens_conteudo/portfolio_website_mockup.png',
                'categorias_ids' => [$catOrientacaoId],
                'tags_ids' => $mapTags(['Portfólio', 'GitHub', 'Projeto Pessoal', 'Carreira']),
            ],
            [
                'titulo' => 'Como Evitar a "Síndrome do Impostor"',
                'descricao' => 'Artigo dedicado ao bem-estar e saúde mental na área de TI. Oferece estratégias para reconhecer, lidar e superar a sensação de não ser bom o suficiente, comum entre iniciantes. Foco em técnicas de auto-estima e validação profissional para manter a motivação nos estudos e na carreira.',
                'img' => 'imagens_conteudo/sindrome_impostor_icone.jpg',
                'categorias_ids' => [$catOrientacaoId],
                'tags_ids' => $mapTags(['Bem-Estar', 'Saúde Mental', 'Soft Skills', 'Carreira']),
            ],
            [
                'titulo' => 'Networking para Devs Introvertidos',
                'descricao' => 'Guia sobre como construir uma rede de contatos sólida sem precisar de eventos sociais. Focado em contribuições open source, interações no LinkedIn e participação ativa em comunidades online para criar conexões profissionais valiosas que abrem portas no mercado de trabalho.',
                'img' => 'imagens_conteudo/linkedin_network_path.png',
                'categorias_ids' => [$catOrientacaoId],
                'tags_ids' => $mapTags(['Networking', 'Comunidade', 'Open Source', 'Carreira']),
            ],
            [
                'titulo' => 'Dicas Essenciais para Testes Técnicos',
                'descricao' => 'O que esperar em testes práticos de código. Inclui conselhos sobre como pensar em voz alta, como lidar com o bloqueio e como documentar sua solução, mesmo que incompleta, para demonstrar raciocínio lógico ao recrutador durante a avaliação técnica.',
                'img' => 'imagens_conteudo/technical_test_code.jpg',
                'categorias_ids' => [$catOrientacaoId],
                'tags_ids' => $mapTags(['Entrevista', 'Teste Técnico', 'Código', 'Júnior']),
            ],
            [
                'titulo' => 'A Arte de Pedir Feedback (e Usá-lo)',
                'descricao' => 'Explica a importância do feedback para o crescimento e oferece frases prontas e métodos para solicitar críticas construtivas ao seu código ou trabalho de forma profissional, transformando-o em aprendizado acelerado. Aumente sua taxa de desenvolvimento com a mentoria correta.',
                'img' => 'imagens_conteudo/feedback_loop_diagram.png',
                'categorias_ids' => [$catOrientacaoId],
                'tags_ids' => $mapTags(['Soft Skills', 'Feedback', 'Comunicação', 'Mentoria']),
            ],
            [
                'titulo' => 'O Conceito de T-Shaped Developer',
                'descricao' => 'Define o que é ser um desenvolvedor em formato "T" (profundidade em uma área, conhecimento amplo em várias). Ajuda o iniciante a traçar um plano de estudos equilibrado que maximiza as chances de empregabilidade no mercado de TI, garantindo habilidades variadas.',
                'img' => 'imagens_conteudo/t_shaped_developer_diagram.png',
                'categorias_ids' => [$catOrientacaoId],
                'tags_ids' => $mapTags(['Carreira', 'Roadmap', 'Planejamento', 'Habilidades']),
            ],
            [
                'titulo' => 'Habilidades de Liderança que o Júnior Precisa',
                'descricao' => 'Desmistifica a ideia de que liderança é apenas para gerentes. Foca em habilidades como proatividade, autogestão e comunicação eficaz dentro de um time técnico, essenciais para o crescimento rápido e para assumir responsabilidades em projetos complexos.',
                'img' => 'imagens_conteudo/leadership_skills.jpg',
                'categorias_ids' => [$catOrientacaoId],
                'tags_ids' => $mapTags(['Liderança', 'Soft Skills', 'Carreira', 'Comunicação']),
            ],
            [
                'titulo' => 'De Estágio a Júnior: Como Fazer a Transição',
                'descricao' => 'Guia prático sobre o que fazer durante o estágio para garantir a contratação como júnior. Focado em proatividade, documentação, comunicação com o mentor e a entrega de valor contínuo para a empresa, convertendo a experiência em emprego formal.',
                'img' => 'imagens_conteudo/stage_to_junior_path.png',
                'categorias_ids' => [$catOrientacaoId],
                'tags_ids' => $mapTags(['Estágio', 'Júnior', 'Carreira', 'Transição', 'Emprego']),
            ],

            // =========================================================
            // TEMA 2: ÁREAS DE ATUAÇÃO E REQUISITOS TÉCNICOS (10 CONTEÚDOS)
            // =========================================================
            [
                'titulo' => 'Roadmap Completo: Desenvolvedor Front-end',
                'descricao' => 'Detalhamento completo das etapas: HTML/CSS, JavaScript, TypeScript, React/Vue/Angular, ferramentas de bundling (Vite/Webpack) e a importância do Git. Guia essencial para sua jornada de aprendizado visual, mostrando o caminho do iniciante ao profissional sênior.',
                'img' => 'imagens_conteudo/frontend_stack_map.png',
                'categorias_ids' => [$catRequisitosId],
                'tags_ids' => $mapTags(['Front-end', 'Roadmap', 'Requisitos Técnicos', 'JavaScript']),
            ],
            [
                'titulo' => 'O Que Faz um Desenvolvedor Back-end?',
                'descricao' => 'Explicação sobre a função do Back-end (lógica de negócios, APIs, segurança). Inclui as principais linguagens (Node, Java, Python, PHP) e conceitos de arquitetura (microsserviços, monolito), mostrando a importância do servidor para a performance da aplicação.',
                'img' => 'imagens_conteudo/backend_architecture.jpg',
                'categorias_ids' => [$catRequisitosId],
                'tags_ids' => $mapTags(['Back-end', 'API', 'Arquitetura', 'Node.js']),
            ],
            [
                'titulo' => 'Carreira em Ciência de Dados para Iniciantes',
                'descricao' => 'Apresenta o papel do Cientista de Dados. Foca nos requisitos técnicos: Python (Pandas/NumPy), SQL, e conceitos de Machine Learning (ML) supervisionado e não supervisionado, com foco no primeiro emprego e nas ferramentas de análise de dados.',
                'img' => 'imagens_conteudo/data_science_charts.png',
                'categorias_ids' => [$catRequisitosId],
                'tags_ids' => $mapTags(['Data Science', 'Python', 'ML', 'SQL']),
            ],
            [
                'titulo' => 'Entendendo o DevOps e Infraestrutura como Código',
                'descricao' => 'Introdução aos conceitos de DevOps e a cultura de automação. Aborda as ferramentas essenciais: Docker, Kubernetes e a filosofia de integração e entrega contínua (CI/CD) como diferencial de carreira para quem busca atuar com nuvem e infraestrutura.',
                'img' => 'imagens_conteudo/devops_pipeline.png',
                'categorias_ids' => [$catRequisitosId],
                'tags_ids' => $mapTags(['DevOps', 'Infraestrutura', 'Docker', 'CI/CD', 'Nuvem']),
            ],
            [
                'titulo' => 'Requisitos para QA Tester e Automação',
                'descricao' => 'Guia para quem deseja ingressar na área de Qualidade de Software (QA). Detalha a diferença entre testes manuais e automáticos e lista linguagens populares (Python, JavaScript) e frameworks (Selenium) para quem busca a primeira vaga em garantia de qualidade.',
                'img' => 'imagens_conteudo/qa_automation_tools.jpg',
                'categorias_ids' => [$catRequisitosId],
                'tags_ids' => $mapTags(['QA', 'Teste', 'Automação', 'Requisitos Técnicos']),
            ],
            [
                'titulo' => 'Essenciais de Banco de Dados para Qualquer Dev',
                'descricao' => 'Foco nos requisitos mínimos de DB. Explica a diferença entre SQL (PostgreSQL, MySQL) e NoSQL (MongoDB) e as operações CRUD que todo desenvolvedor precisa dominar, independentemente da área de atuação ou da linguagem de programação utilizada.',
                'img' => 'imagens_conteudo/db_server_connection.png',
                'categorias_ids' => [$catRequisitosId],
                'tags_ids' => $mapTags(['Banco de Dados', 'SQL', 'NoSQL', 'CRUD']),
            ],
            [
                'titulo' => 'O Que Estudar para o Full Stack',
                'descricao' => 'Detalha a interseção de habilidades para o Full Stack. Foca em como equilibrar o estudo entre a experiência do usuário (UX) e a performance do servidor (Back-end), evitando o erro de ser "generalista demais" e focando na profundidade T-shaped.',
                'img' => 'imagens_conteudo/fullstack_balance.jpg',
                'categorias_ids' => [$catRequisitosId],
                'tags_ids' => $mapTags(['Full Stack', 'Front-end', 'Back-end', 'Roadmap']),
            ],
            [
                'titulo' => 'Requisitos de Segurança da Informação (Básico)',
                'descricao' => 'Apresenta os conceitos básicos de segurança que todo dev júnior deve conhecer: injeção SQL, XSS, e o uso correto de variáveis de ambiente. Aborda as práticas mínimas de código seguro para proteger tanto o servidor quanto o cliente.',
                'img' => 'imagens_conteudo/security_shield_lock.png',
                'categorias_ids' => [$catRequisitosId],
                'tags_ids' => $mapTags(['Segurança', 'Infraestrutura', 'Requisitos Técnicos']),
            ],
            [
                'titulo' => 'As Ferramentas Mais Usadas no Mundo Corporativo',
                'descricao' => 'Apresenta ferramentas de colaboração e gerência de projetos, como Jira, Trello e Slack, além do Git/GitHub, que são requisitos essenciais para a comunicação e organização em ambientes profissionais e metodologia ágil.',
                'img' => 'imagens_conteudo/project_management_tools.jpg',
                'categorias_ids' => [$catRequisitosId],
                'tags_ids' => $mapTags(['Ferramentas', 'Git', 'Comunicação', 'Projeto']),
            ],
            [
                'titulo' => 'Dominando o Git e GitHub: Do Básico ao Branching',
                'descricao' => 'Tutorial sobre o fluxo de trabalho essencial: clone, commit, push, pull, branch e o básico de merge conflicts. Entenda como colaborar em projetos de forma segura e eficiente, sem perder código e seguindo o padrão de versionamento corporativo.',
                'img' => 'imagens_conteudo/github_branching_diagram.png',
                'categorias_ids' => [$catRequisitosId],
                'tags_ids' => $mapTags(['Git', 'GitHub', 'Versionamento', 'Código']),
            ],

            // =========================================================
            // TEMA 3: CONTEÚDO TÉCNICO ESPECÍFICO (10 CONTEÚDOS)
            // =========================================================
            [
                'titulo' => 'Python para Iniciantes: Seu Primeiro Script',
                'descricao' => 'Um tutorial prático ensinando a configurar o ambiente e escrever um script simples que manipula arquivos, focando na sintaxe e na execução. Perfeito para quem está dando os primeiros passos na linguagem e precisa de exemplos de código funcional.',
                'img' => 'imagens_conteudo/python_first_script.png',
                'categorias_ids' => [$catTecnicoId],
                'tags_ids' => $mapTags(['Código', 'Python', 'Sintaxe', 'Tutorial']),
            ],
            [
                'titulo' => 'Entendendo o JavaScript Assíncrono (Async/Await)',
                'descricao' => 'Desmistifica o conceito de assincronicidade no JS. Explica Promises, o que são callbacks e como usar async/await para código limpo e legível, essencial para o desenvolvimento Node.js e Front-end moderno e aprimorado.',
                'img' => 'imagens_conteudo/js_async_await_flow.jpg',
                'categorias_ids' => [$catTecnicoId],
                'tags_ids' => $mapTags(['JavaScript', 'Assíncrono', 'Promises', 'Código']),
            ],
            [
                'titulo' => 'Guia Rápido: Criando Componentes com React',
                'descricao' => 'Tutorial focado em React. Apresenta o conceito de componentes, JSX e a diferença entre componentes de função e de classe para iniciantes. Ensina a montar uma interface básica utilizando a biblioteca, focando na reutilização de código.',
                'img' => 'imagens_conteudo/react_components_tutorial.png',
                'categorias_ids' => [$catTecnicoId],
                'tags_ids' => $mapTags(['React', 'JavaScript', 'Front-end', 'Componentes']),
            ],
            [
                'titulo' => 'PHP Básico: Variáveis, Tipos e Funções',
                'descricao' => 'Focado na fundação do PHP para quem usa Laravel. Cobre a declaração de variáveis, tipos primitivos e a criação de funções básicas. Garante que você tenha uma base sólida antes de avançar para frameworks, entendendo a linguagem de baixo nível.',
                'img' => 'imagens_conteudo/php_syntax_basic.png',
                'categorias_ids' => [$catTecnicoId],
                'tags_ids' => $mapTags(['PHP', 'Laravel', 'Sintaxe', 'Código']),
            ],
            [
                'titulo' => 'Essenciais do SQL: Joins e Cláusulas WHERE',
                'descricao' => 'Tutorial prático sobre como interligar tabelas usando JOIN (INNER, LEFT, RIGHT) e como filtrar dados eficientemente com a cláusula WHERE. Domine as consultas básicas para qualquer banco de dados relacional e otimize a performance de suas aplicações.',
                'img' => 'imagens_conteudo/sql_joins_diagram.png',
                'categorias_ids' => [$catTecnicoId],
                'tags_ids' => $mapTags(['SQL', 'Banco de Dados', 'Joins', 'Tutorial']),
            ],
            [
                'titulo' => 'Layouts Perfeitos: CSS Grid para Iniciantes',
                'descricao' => 'Guia visual sobre como usar o CSS Grid para criar layouts complexos e responsivos em duas dimensões (linhas e colunas), superando o Flexbox para layouts estruturais. Essencial para Front-end e para construir interfaces que funcionam em qualquer tela.',
                'img' => 'imagens_conteudo/css_grid_visual.png',
                'categorias_ids' => [$catTecnicoId],
                'tags_ids' => $mapTags(['CSS', 'Layout', 'Grid', 'Front-end']),
            ],
            [
                'titulo' => 'O Que é REST e Como Consumir uma API',
                'descricao' => 'Explica o conceito de arquitetura RESTful. Ensina a usar ferramentas como Postman e código JS para fazer requisições GET, POST e entender os códigos HTTP. Fundamental para a comunicação entre Front e Back-end em qualquer projeto moderno.',
                'img' => 'imagens_conteudo/api_request_response.jpg',
                'categorias_ids' => [$catTecnicoId],
                'tags_ids' => $mapTags(['API', 'REST', 'HTTP', 'JavaScript']),
            ],
            [
                'titulo' => 'Primeiros Passos com o Framework Laravel',
                'descricao' => 'Tutorial de configuração inicial do Laravel. Ensina a rodar o php artisan serve, configurar o .env e criar o primeiro Controller e View. Introdução ao sistema de Rotas do framework, ideal para quem está começando no ecossistema PHP.',
                'img' => 'imagens_conteudo/laravel_artisan_serve.png',
                'categorias_ids' => [$catTecnicoId],
                'tags_ids' => $mapTags(['Laravel', 'PHP', 'Framework', 'Rotas']),
            ],
            [
                'titulo' => 'Entendendo a Programação Orientada a Objetos',
                'descricao' => 'Explicação clara sobre os 4 pilares da POO (Encapsulamento, Herança, Polimorfismo, Abstração) com exemplos práticos. Um conceito essencial para escrever código escalável em qualquer linguagem e avançar para níveis de desenvolvimento mais complexos.',
                'img' => 'imagens_conteudo/poo_pillars_diagram.jpg',
                'categorias_ids' => [$catTecnicoId],
                'tags_ids' => $mapTags(['POO', 'Código', 'Conceitos', 'Arquitetura']),
            ],
            [
                'titulo' => 'Introdução ao TypeScript para Quem já Sabe JS',
                'descricao' => 'Foca nos benefícios da tipagem estática. Guia a transição de um arquivo JavaScript simples para TypeScript, mostrando a sintaxe essencial (interface, type) e como isso previne erros em projetos grandes, aumentando a segurança do código Front-end.',
                'img' => 'imagens_conteudo/typescript_logo_code.png',
                'categorias_ids' => [$catTecnicoId],
                'tags_ids' => $mapTags(['TypeScript', 'JavaScript', 'Tipagem', 'Código']),
            ],
        ];
    }
}
