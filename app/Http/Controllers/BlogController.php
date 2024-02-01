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
            $data['summaries'] = $crawler->filter('.result__body')->each(function ($node) {
                return $node->filter('.result__snippet')->text();
            });
            $data['title'] = $request->title;
            // $data['summaries'] = $this->generateSummary($summar);
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

        $response = $client->request('POST', 'https://gpt-summarization.p.rapidapi.com/summarize', [
            'body' => '{
                "text": ' . $text . ',
                "num_sentences": 5
            }',
            'headers' => [
                'X-RapidAPI-Host' => 'gpt-summarization.p.rapidapi.com',
                'X-RapidAPI-Key' => '19134f2b12msh515696babb2758dp1ccff8jsn8272ee676b32',
                'content-type' => 'application/json',
            ],
        ]);
        return $response->getBody();
    }

    public function getBlog(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $responses = [];
        foreach ($request->headings as $heading) {
            $response = $client->request('POST', 'https://chat-gpt-3-5-turbo.p.rapidapi.com/ChatComplitition', [
                'body' => '{
    "Body": {
        "messages": [
            {
                "role": "assistant",
                "content": "Your name is OpenGPT by Asad. You are helpful assistant. Use friendly tone."
            },
            {
                "role": "user",
                "content": "generate a lenghty blog post from these headings ' . $heading . '"
            }
        ],
        "temperature": 0.9,
        "max_tokens": 200,
        "stream": false
    }
}',
                'headers' => [
                    'X-RapidAPI-Host' => 'chat-gpt-3-5-turbo.p.rapidapi.com',
                    'X-RapidAPI-Key' => '945a619e45msha1456a3d4e05e7ap14f40djsn1346e2bd420a',
                    'content-type' => 'application/json',
                ],
            ]);
            $responses[] = json_decode($response->getBody(), true);

        }
        return view('blog',compact('responses'));
    }
}
