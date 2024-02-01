<?php

use App\Http\Controllers\BlogController;
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

Route::get('/', [BlogController::class,'app']);
Route::post('/app', [BlogController::class,'index'])->name('blog');

Route::post('get-headings', [BlogController::class, 'getBlog'])->name('generateBlog');
Route::get('blog', [BlogController::class, 'blog']);
