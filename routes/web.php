<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use Illuminate\Support\Facades\Route;


Route::get('/', [BookController::class, 'index'])->name('home');
Route::resource('books', BookController::class);
Route::get('/books', [BookController::class, 'list'])->name('books.index');
Route::patch('/books/{book}/progress', [BookController::class, 'updateProgress'])->name('books.updateProgress');
Route::resource('authors', AuthorController::class)->except(['destroy']);
Route::resource('genres', GenreController::class)->except(['destroy']);


//Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
//Route::post('/books', [BookController::class, 'store'])->name('books.store');
