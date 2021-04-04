<?php
use Illuminate\Support\Facades\Route;

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

// ドキュメントルートで本一覧表示
Route::get('/','App\Http\Controllers\BooksController@index'); //コントローラーの名前の前に名前空間を追加（Laravel8特有）

// 本を登録
Route::post('/books','App\Http\Controllers\BooksController@register'); 

// 更新画面
Route::post('/booksedit/{books}', 'App\Http\Controllers\BooksController@edit');

// 本を更新
Route::post('books/update','App\Http\Controllers\BooksController@update');

// 本を削除
Route::delete('/book/{book}', 'App\Http\Controllers\BooksController@delete');

//認証用ルーティング
Auth::routes();
Route::get('/home', [App\Http\Controllers\BooksController::class, 'index'])->name('home');