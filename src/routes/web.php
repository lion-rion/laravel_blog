<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::get('/',[PostController::class, 'index'])->name('home');
//詳細表示
Route::get('/post/{post}', [PostController::class, 'show']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'showCreate'])->name('create');
    //ブログ登録
    Route::post('/posts/store', [PostController::class, 'exeStore'])->name('store');
    //ブログ編集
    Route::get('/posts/edit/{id}', [PostController::class, 'showEdit'])->name('edit');
    //更新
    Route::post('/posts/update', [PostController::class, 'exeUpdate'])->name('update');
    //ブログ削除
    Route::post('/posts/delete/{id}', [PostController::class, 'exeDelete'])->name('delete');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
