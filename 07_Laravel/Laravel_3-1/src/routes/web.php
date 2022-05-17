<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

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
    return view('home');
})->name('home');

// Authentication
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// 一般ユーザー
Route::get('/dashboard', [UsersController::class, 'index'])->name('dashboard');

Route::prefix('users')->name('users.')->group(function(){
    Route::get('/{user}/edit', [UsersController::class, 'edit'])->name('edit')->middleware('can:edit-status');
    Route::put('/{user}', [UsersController::class, 'update'])->name('update');
    Route::delete('/{user}', [UsersController::class, 'destroy'])->name('destroy');
});

// adminユーザー
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:edit-roles')->group(function(){
    Route::resource('/users', 'UsersController', ['except' => 'show', 'create', 'store']);
});
