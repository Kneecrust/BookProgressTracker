<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use Illuminate\Support\Facades\Route;


Route::get('/', [BookController::class, 'index'])->name('home');
Route::resource('books', BookController::class)->only(['index', 'show']);
Route::get('/books', [BookController::class, 'list'])->name('books.index');
Route::patch('/books/{book}/progress', [BookController::class, 'updateProgress'])->name('books.updateProgress');
Route::resource('authors', AuthorController::class)->only(['index', 'show']);
Route::resource('genres', GenreController::class)->only(['index', 'show']);

