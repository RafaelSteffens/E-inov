<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendNewsEmails extends Command
{
    /**
     * @var string
     */
    protected $signature = 'send:news-emails';

    /**
     * @var string
     */
    protected $description = 'Envia e-mails com as notícias do UOL para todos os usuários';

    /**
     * Execute o comando.
     */
    public function handle()
    {
        // Busca os usuários da API
        $response = Http::get('http://127.0.0.1:8000/api/users');

        if ($response->successful()) {
            $users = $response->json();

            // URL do feed RSS
            $feedUrl = 'https://rss.uol.com.br/feed/noticias.xml';

            // Carrega o XML a partir da URL
            $xml = simplexml_load_file($feedUrl);

            // Verifica se o XML foi carregado corretamente
            if ($xml === false) {
                $this->error('Erro ao carregar o feed RSS.');
                return;
            }

            // Prepara as notícias para o e-mail
            $news = [];
            foreach ($xml->channel->item as $item) {
                $news[] = [
                    'title' => (string) $item->title,
                    'description' => (string) $item->description,
                    'link' => (string) $item->link,
                ];
            }

            // Envia e-mails para cada usuário
            foreach ($users as $user) {
                try {
                    // Envia o e-mail com as notícias
                    Mail::send('emails.news', [
                        'name' => $user['name'],
                        'news' => $news, // Passa as notícias para o template
                    ], function ($message) use ($user) {
                        $message->to($user['email'], $user['name'])
                                ->subject('Notícias do UOL');
                    });

                    $this->info("E-mail enviado para: {$user['email']}");
                } catch (\Exception $e) {
                    // Registra falhas no log
                    Log::error("Erro ao enviar e-mail para {$user['email']}: " . $e->getMessage());
                    $this->error("Erro ao enviar e-mail para {$user['email']}");
                }
            }
        } else {
            Log::error('Erro ao buscar usuários da API: ' . $response->status());
            $this->error('Erro ao buscar usuários da API');
        }
    }
}