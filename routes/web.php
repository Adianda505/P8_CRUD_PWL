<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookshelfController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\loandetailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReturnController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    
    Route::get('/books', [BookController::class, 'index'])->name('book');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('book.edit');
    Route::match(['PUT', 'PATCH'], 'books/{id}', [BookController::class, 'update'])->name('book.update');
    Route::delete('books/{id}', [BookController::class, 'destroy'])->name('book.destroy');

    Route::resource('bookshelves', BookshelfController::class);
    Route::get('bookshelves', [BookshelfController::class, 'index'])->name('bookshelves');
    Route::get('/booksheves/create', [BookshelfController::class, 'create'])->name('bookshelf.create');
    Route::post('/bookshelves', [BookshelfController::class, 'store'])->name('bookshelf.store');
    Route::get('/bookshelves/{id}/edit', [BookshelfController::class, 'edit'])->name('bookhelf.edit');
    Route::match(['PUT', 'PATCH'], 'bookshelf/{id}', [BookshelfController::class, 'update'])->name('bookshelf.update');
    Route::delete('bookshelf/{id}', [BookshelfController::class, 'destroy'])->name('bookshelf.destroy');
    
    
    
    Route::resource('categories', CategoryController::class);
    Route::resource('loans', LoanController::class);
    Route::resource('loan-detail', loandetailController::class);
    Route::resource('returns', ReturnController::class);


    Route::get('/books/pdf', [BookController::class, 'exportPdf'])->name('books.pdf');
});
require __DIR__.'/auth.php';
