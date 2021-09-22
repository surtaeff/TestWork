<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController as Home;
use App\Http\Controllers\PostsController as Posts;
use App\Http\Controllers\UsersController as Users;
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


Auth::routes();

   // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    // Admin routes
    Route::get('/', [Home::class, 'index'])->name('home');
    // Users
    Route::resource('users', Users::class)->middleware('can:isManager');
   
    // Users
    Route::resource('posts', Posts::class)->middleware('auth');
   