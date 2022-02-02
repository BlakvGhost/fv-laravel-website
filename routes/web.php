<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Home;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ExploitController;
use App\Http\Controllers\ServiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Home::class, 'index']);

Route::get('/contactez-nous', [ContactController::class, 'index'])
    ->name('contact');

Route::get('/article/{post}/{title}', [PostController::class, 'show'])
    ->name('post.show');

Route::get('/a-propos-de-nous', [AboutController::class, 'show'])
    ->name('about.show');

Route::get('/pourquoi-nous-choisir/{exploit}/{title}', [ExploitController::class, 'show'])
    ->name('exploit.show');

Route::get('/nos-services/{service}/{title}', [ServiceController::class, 'show'])
    ->name('service.show');

Route::get('/nos-services', [ServiceController::class, 'all'])
    ->name('service.all');

Route::get('/notre-blog', [BlogController::class, 'all'])
    ->name('blog.all');

Route::get('/notre-blog/{blog}/{title}', [BlogController::class, 'show'])
    ->name('blog.show');

Route::post('/notre-blog/{blog}/{title}', [BlogController::class, 'comment'])
    ->name('blog.comment');

require __DIR__ . '/auth.php';
require __DIR__ . '/dash.php';

