<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/', fn () => view('welcome'));
Route::get('/contacts', Livewire\Contacts\Index::class)->name('contacts.index');
Route::get('/posts', Livewire\Posts\Index::class)->name('posts.index');
Route::get('/posts/create', Livewire\Posts\Create::class)->name('posts.create');
Route::get('/posts/{post}/edit', Livewire\Posts\Edit::class)->name('posts.edit');
Route::get('/categories', Livewire\Categories\Index::class)->name('categories.index');