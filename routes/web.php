<?php

use App\Http\Controllers\AutorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LivroController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('livros.index'));

Route::resource('categorias', CategoriaController::class)->except('show');
Route::resource('autores', AutorController::class)->except('show')->parameters(['autores' => 'autor']);
Route::resource('livros', LivroController::class)->except('show');
