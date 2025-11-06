<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use SimplePie; // O leitor de RSS
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon; // Para datas

class FetchRssFeeds extends Command
{
    protected $signature = 'app:fetch-rss-feeds';
    protected $description = 'Busca novos posts de feeds RSS configurados';

    // ... (sua função getPostModel() continua igual) ...
    private function getPostModel()
    {
        return DB::table('aggregated_posts');
    }


    // Cole isso dentro da sua classe FetchRssFeeds
    // Substituindo o método handle() antigo

    public function handle()
    {
        $this->info('Iniciando busca por novos posts...');

        // O array de feeds continua o mesmo
        $feeds = [
            ['name' => 'Canaltech - Carreira', 'url' => 'https://canaltech.com.br/rss/carreira/', 'category' => 'Artigos', 'limit' => 15, 'ignore_age' => false],
            ['name' => 'Blog da Alura', 'url' => 'https://www.alura.com.br/artigos/rss', 'category' => 'Artigos', 'limit' => 50, 'ignore_age' => true],
            ['name' => 'G1 - Tecnologia', 'url' => 'https://g1.globo.com/tecnologia/rss.xml', 'category' => 'Artigos', 'limit' => 15, 'ignore_age' => false],
            ['name' => 'RemotaJob (Vagas)', 'url' => 'https://remotajob.com/rss', 'category' => 'Vagas', 'limit' => 25, 'ignore_age' => false],
        ];

        foreach ($feeds as $feedConfig) {
            $this->info("Processando: {$feedConfig['name']} (Categoria: {$feedConfig['category']})");

            try {
                $feed = new SimplePie();
                $feed->set_feed_url($feedConfig['url']);
                $feed->set_cache_location(storage_path('framework/cache'));

                // ============ INÍCIO DA CORREÇÃO DE SSL ============
                // O site da Alura pode estar bloqueando por SSL no seu PC.
                // Esta linha desabilita a verificação de SSL (OK para TCC local)
                $feed->set_curl_options([
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => 0,
                ]);
                // ============ FIM DA CORREÇÃO DE SSL ============

                $feed->init(); // É aqui que o erro acontecia

                // Limite de posts customizado
                $limit = $feedConfig['limit'] ?? 15;
                $items = array_slice($feed->get_items(), 0, $limit);

                // Flag de ignorar idade
                $ignoreAge = $feedConfig['ignore_age'] ?? false;

                foreach ($items as $item) {

                    $guid = $item->get_id();

                    $exists = $this->getPostModel()->where('guid', $guid)->exists();
                    if ($exists) {
                        continue;
                    }

                    // Pular antigos, EXCETO se ignorar
                    $postDate = $item->get_date('Y-m-d H:i:s');

                    if ($ignoreAge === false && $postDate < Carbon::now()->subDays(90)) {
                        $this->line("  -> Ignorando (muito antigo): {$item->get_title()}");
                        continue;
                    }

                    // Pegar a imagem
                    $imageUrl = null;
                    $enclosure = $item->get_enclosure(0);

                    if ($enclosure && str_starts_with($enclosure->get_type(), 'image/')) {
                        $imageUrl = $enclosure->get_link();
                    }

                    // Salva no banco
                    $this->getPostModel()->insert([
                        'title'         => $item->get_title(),
                        'source_name'   => $feedConfig['name'],
                        'category'      => $feedConfig['category'],
                        'source_url'    => $item->get_permalink(),
                        'snippet'       => strip_tags($item->get_description()),
                        'thumbnail_url' => $imageUrl,
                        'published_at'  => $postDate,
                        'guid'          => $guid,
                        'created_at'    => Carbon::now(),
                        'updated_at'    => Carbon::now(),
                    ]);
                    $this->line("  -> Novo post salvo: {$item->get_title()}");
                } // Fim do loop de items

            } catch (\Exception $e) {
                Log::error("Falha ao processar feed {$feedConfig['name']}: " . $e->getMessage());
                $this->error("Falha ao processar {$feedConfig['name']}");

                // ============ MELHORIA NO ERRO ============
                // Isso vai nos mostrar o VERDADEIRO erro no console
                $this->error("   -> Erro real: " . $e->getMessage());
                // ============ FIM DA MELHORIA ============
            }
        } // Fim do loop de feeds

        $this->info('Busca finalizada.');
        return 0;
    }
}
