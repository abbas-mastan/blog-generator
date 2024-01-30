<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        
        $client = new Client();
        $crawler = $client->request('GET', 'https://duckduckgo.com/html/?q=("' . $request->title . '")');
        $data['summaries'] = [];
        $data['headings'] = [];
        if ($request->title) {
            $summaries = $crawler->filter('.result__body')->each(function ($node) {
                return $node->filter('.result__snippet')->text();
            });
            $summar = '';
            foreach ($summaries as $summary) {
                $summar .= $summary;
            }
            $data['title'] = $request->title;
            $data['summaries'] = $this->generateSummary($summar);
            $data['headings'] = $crawler->filter('.result__body')->each(function ($node) {
                return $node->filter('h2')->text();
            });
        }
        return view('app')->with($data);

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
        // $response = $client->request('POST', 'https://gpt-summarization.p.rapidapi.com/summarize', [
        //     'body' => json_encode([
        //         'text' => $text,
        //         'num_sentences' => 10,
        //     ]),
        //     'headers' => [
        //         'X-RapidAPI-Host' => 'gpt-summarization.p.rapidapi.com',
        //         'X-RapidAPI-Key' => '19134f2b12msh515696babb2758dp1ccff8jsn8272ee676b32',
        //         'content-type' => 'application/json',
        //     ],
        // ]);
    
        $response = $client->request('POST', 'https://chat-gpt26.p.rapidapi.com/', [
            'body' => '{
            "model": "gpt-3.5-turbo",
            "messages": [
                {
                    "role": "user",
                    "content": "how are you"
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
        
      
    

        return $response->getBody();
    }
}
