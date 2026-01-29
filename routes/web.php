<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BookController;

Route::get('/', [ArticleController::class, 'home'])->name('home');

// Публичные статьи
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// Публичные книги
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
Route::get('/books/{book}/read', [BookController::class, 'read'])->name('books.read');
Route::get('/books/{book}/download', [BookController::class, 'download'])->name('books.download');
Route::get('/books/{book}/pdf', [BookController::class, 'pdf'])->name('books.pdf');

// Админка (защищена basic auth)
Route::middleware('admin.basic')->prefix('admin')->group(function () {
    Route::get('/', fn() => redirect()->route('admin.books.index'));

    // книги в админке
    Route::resource('books', BookController::class)
        ->names('admin.books')
        ->except(['show']);

    // статьи в админке
    Route::resource('articles', ArticleController::class)
        ->names('admin.articles')
        ->except(['show']);
});