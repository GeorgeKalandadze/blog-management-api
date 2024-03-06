<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/posts/create', function () {
    return view('post.create');
})->name('posts.create');

Route::get('/posts/edit', function () {
    return view('post.edit');
})->name('posts.edit');

Route::get('/posts/show', function () {
    return view('post.show');
})->name('posts.show');

