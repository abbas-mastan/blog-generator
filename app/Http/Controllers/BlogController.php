<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $client = new \GuzzleHttp\Client();

        <?php

        $client = new \GuzzleHttp\Client();
        
        $response = $client->request('POST', 'https://chat-gpt26.p.rapidapi.com/', [
            'body' => '{
            "model": "gpt-3.5-turbo",
            "messages": [
                {
                    "role": "user",
                    "content": "Hello"
                }
            ]
        }',
            'headers' => [
                'Content-Type' => 'application/json',
                'X-RapidAPI-Host' => 'chat-gpt26.p.rapidapi.com',
                'X-RapidAPI-Key' => '19134f2b12msh515696babb2758dp1ccff8jsn8272ee676b32',
                'content-type' => 'application/json',
            ],
        ]);
        

        dd($response->getBody());
        $client = new Client();
        $crawler = $client->request('GET', 'https://duckduckgo.com/html/?q=("' . $request->title . '")');
        $summaries = [];
        if ($request->title) {
            $summaries = $crawler->filter('.result__body')->each(function ($node) {
                return $node->filter('.result__snippet')->text();
            });
            $summar = '';
            foreach ($summaries as $summary) {
                $summar .= $summary;
            }
            $summaries = $this->generateSummary($summar);
            $headings = $crawler->filter('.result__body')->each(function ($node) {
                return $node->filter('h2')->text();
            });
        }
        return view('app')->with(['summaries' => $summaries, 'headings' => $headings]);

    }
    public function app()
    {
        $summaries = [];
        return view('app')->with('summaries', $summaries);

    }

    private function generateSummary($crawler)
    {
        $text = <<<EOD
         $crawler
         EOD;

        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://chatgpt-chatgpt3-5-chatgpt4.p.rapidapi.com/v1/chat/completions', [
            'body' => '{
          "model": "gpt-3.5-turbo",
          "messages": [
              {
                  "role": "user",
                  "content": "generate a summary of ' . $text . '"
              }
          ],
          "temperature": 0.8
      }',
            'headers' => [
                'X-RapidAPI-Host' => 'chatgpt-chatgpt3-5-chatgpt4.p.rapidapi.com',
                'X-RapidAPI-Key' => '19134f2b12msh515696babb2758dp1ccff8jsn8272ee676b32',
                'content-type' => 'application/json',
            ],
        ]);

        return $response->getBody();
    }
}
