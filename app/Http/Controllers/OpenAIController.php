<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OpenAIController extends Controller
{

    public function index()
    {
        $summaries = [];
        return view('app', compact('summaries'));
    }
    public function openai()
    {

        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://chatgpt-api8.p.rapidapi.com/', [
            'body' => '[

            {
                "content": "who won the super bowl 2019?",
                "role": "user"
            }
        ]',
            'headers' => [
                'X-RapidAPI-Host' => 'chatgpt-api8.p.rapidapi.com',
                'X-RapidAPI-Key' => '19134f2b12msh515696babb2758dp1ccff8jsn8272ee676b32',
                'content-type' => 'application/json',
            ],
        ]);
        
        echo $response->getBody();
    }

    public function crawler(Request $request)
    {
        $crawler = Goutte::request('GET', 'https://duckduckgo.com/html/?q="' . $request->title . '"');

        $summaries = $crawler->filter('.result__body')->each(function ($node) {
            return $node->filter('.result__snippet')->text();
        });

        return view('app')->with('summaries', $summaries);
    }
}
