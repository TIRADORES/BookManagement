<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;


// Route::get('/books', [BookController::class,'index']) -> name("book.getAll");
// Route::get('/books/{id}', [BookController::class,'show']) -> name("book.getBook");
// Route::put('/books/{id}', [BookController::class,'update']) -> name("book.updateBook");
// Route::delete('/books/{id}', [BookController::class,'destroy']) -> name("book.deletBook");
Route::apiResource("books", BookController::class);