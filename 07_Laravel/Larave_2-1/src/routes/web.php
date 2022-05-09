<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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
// All listings
Route::get('/', [ListingController::class, 'index'])->name('listings.show');

// 投稿のルートグループ
Route::group(['prefix' => 'listings', 'controller' => ListingController::class],  function () {
  // 投稿を保存する
  Route::post('/', 'store')->name('listing.store')->middleware('auth');
  // 投稿するフォームを表示する
  Route::get('/create', 'create')->name('listing.create')->middleware('auth');
  // 編集するフォームを表示する
  Route::get('/{listing}/edit', 'edit')->name('listing.edit')->middleware('auth');
  // 投稿を編集する
  Route::put('/{listing}', 'update')->name('listing.update')->middleware('auth');
  // 投稿を削除する
  Route::delete('/{listing}', 'destroy')->name('listing.destroy')->middleware('auth');
  // １つの投稿を表示する
  Route::get('/{listing}', 'show')->name('listing.show');
});

// ユーザーのルートグループ
Route::controller(UserController::class)->group(function () {
  // ユーザー登録画面を表示
  Route::get('/register', 'create')->name('users.create')->middleware('guest');
  // 新しいユーザーを作成
  Route::post('/', 'store')->name('users.store');
  // ユーザーをログアウトする
  Route::post('/logout', 'logout')->name('users.logout')->middleware('auth');
  // ログイン画面を表示
  Route::get('/login', 'login')->name('users.login')->middleware('guest');
  // ユーザーをログインする
  Route::post('/users/authenticate', 'authenticate')->name('users.authenticate');
});