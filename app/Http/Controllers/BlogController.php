<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Goutte\Client;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        try {
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
            return view('generator')->with($data);
        } catch (\Exception $ex) {
            throw new \Exception($ex);
        }
    }
    public function app()
    {
        $summaries = [];
        return view('generator')->with('summaries', $summaries);

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
        try {

            foreach ($request->headings as $heading) {
                $response = $client->request('POST', 'https://chat-gpt-3-5-turbo.p.rapidapi.com/ChatComplitition', [
                    'body' => '{
                "Body": {
                    "messages": [
                        {
                            "role": "assistant",
                            "content": "Your name is OpenGPT by Asad. You are a helpful assistant. Use a friendly tone."
                        },
                        {
                            "role": "user",
                            "content": "generate a lengthy blog post from these headings ' . $heading . '"
                        }
                    ],
                    "temperature": 0.9,
                    "max_tokens": 200,
                    "stream": false
                }
                }',
                    'headers' => [
                        'X-RapidAPI-Host' => 'chat-gpt-3-5-turbo.p.rapidapi.com',
                        'X-RapidAPI-Key' => '2869fdd3c2msh7629284e4466fa0p179645jsna2cd45092a95',
                        'content-type' => 'application/json',
                    ],
                ]);

                $responseArray = json_decode($response->getBody(), true);
                if ($responseArray && $responseArray[0]['message']['content']) {
                    $content = $responseArray[0]['message']['content'];
                    Blog::create([
                        'title' => $request->title,
                        'heading' => $heading,
                        'content' => $content,
                    ]);
                }
            }
            $responses = Blog::get();
            return view('blog', compact('responses'));
        } catch (\Exception $ex) {
            throw new \Exception($ex);
        }
    }

//     public function getBlog(Request $request)
// {
//     $client = new \GuzzleHttp\Client();

//     // Build an array to store messages for all headings
//     $messages = [];

//     foreach ($request->headings as $heading) {
//         $messages[] = [
//             "role" => "user",
//             "content" => "generate a lengthy blog post from these headings '$heading'"
//         ];
//     }

//     // Add assistant message to the array
//     $messages[] = [
//         "role" => "assistant",
//         "content" => "Your name is OpenGPT by Asad. You are a helpful assistant. Use a friendly tone."
//     ];

//     // Build the request body with all messages
//     $body = [
//         "Body" => [
//             "messages" => $messages,
//             "temperature" => 0.9,
//             "max_tokens" => 200,
//             "stream" => false
//         ]
//     ];

//     $response = $client->request('POST', 'https://chat-gpt-3-5-turbo.p.rapidapi.com/ChatComplitition', [
//         'body' => json_encode($body),
//         'headers' => [
//             'X-RapidAPI-Host' => 'chat-gpt-3-5-turbo.p.rapidapi.com',
//             // 'X-RapidAPI-Key' => '945a619e45msha1456a3d4e05e7ap14f40djsn1346e2bd420a',
//             'X-RapidAPI-Key' => '19134f2b12msh515696babb2758dp1ccff8jsn8272ee676b32',
//             'content-type' => 'application/json',
//         ],
//     ]);

//     $responseArray = json_decode($response->getBody(), true);

//     // Assuming the responses are in the same order as the headings
//         if ($responseArray && $responseArray[0]['message']['content']) {
//             $content = $responseArray[0]['message']['content'];
//             Blog::create([
//                 'heading' => $request->headings,
//                 'content' => $content,
//             ]);
//     }

//     $responses = Blog::get();
//     return view('blog', compact('responses'));
// }

    public function blog()
    {
        $responses = Blog::get();
        return view('blog', compact('responses'));
    }

}
