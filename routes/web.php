<?php

use Illuminate\Support\Facades\Route;
use App\Mail\NewUserWelcomeMail;

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

Route::get('/', function () {
    return view('store.index');
});

Route::get('ourshop', function () {
    return view('store.ourshop');
})->name('ourshop');

Route::get('/email', function () {
    return new NewUserWelcomeMail();
});

Auth::routes();
Route::get('home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/lost', [App\Http\Controllers\PostsController::class, 'index']);
Route::get('/tipsforadoption', function () {
    return view('store.Adopttips');
});
 
Route::get('/adopt', function () {
    return view('store.adopt');
});

Route::prefix('posts')->group(function () {

    Route::get('/create', [App\Http\Controllers\PostsController::class, 'create']);
    Route::get('/{post}/edit', [App\Http\Controllers\PostsController::class, 'edit']);
    Route::get('/{post}', [App\Http\Controllers\PostsController::class, 'show']);
    Route::post('/', [App\Http\Controllers\PostsController::class, 'store']);
    Route::put('/{post}', [App\Http\Controllers\PostsController::class, 'update']);
    Route::get('/{post}/delete', [App\Http\Controllers\PostsController::class, 'destroy']);
    
});

