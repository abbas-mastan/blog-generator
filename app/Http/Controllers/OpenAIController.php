<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class OpenAIController extends Controller
{

  public function index() 
  {
    $summaries = [];
    return view('app',compact('summaries'));
  }
    public function openai()
    {


      $client = new \GuzzleHttp\Client();
      
      $response = $client->request('POST', 'https://chatgpt-chatgpt3-5-chatgpt4.p.rapidapi.com/v1/chat/completions', [
        'body' => '{
          "model": "gpt-3.5-turbo",
          "messages": [
              {
                  "role": "user",
                  "content": "generate a blog how to train a little dog"
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
      
      echo $response->getBody();
    }

    public function crawler(Request $request) 
    {
      $crawler = Goutte::request('GET', 'https://duckduckgo.com/html/?q="'.$request->title.'"');
   
      $summaries = $crawler->filter('.result__body')->each(function ($node) {
        return $node->filter('.result__snippet')->text();
    });

    return view('app')->with('summaries', $summaries);
    }
}
