<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenAIController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/', function(Request $request) {
    $crawler = Goutte::request('GET', 'https://duckduckgo.com/html/?q="'.$request->title.'"');
   
    $summaries = $crawler->filter('.result__body')->each(function ($node) {
        return $node->filter('.result__snippet')->text();
    });
    return view('app')->with('summaries', $summaries);

})->name('blog');

// Route::get('open-ai', [OpenAIController::class, 'index']);
Route::get('bring-summary', [OpenAIController::class, 'index']);
