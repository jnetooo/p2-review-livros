<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\AutorController;
use App\Http\Controllers\Api\GeneroController;
use App\Http\Controllers\Api\LivroController;
use App\Http\Controllers\Api\ReviewController;

// Agrupamento das rotas da API
Route::prefix('v1')->group(function () {

    // Rotas Básicas
    Route::apiResource('usuarios', UsuarioController::class);
    Route::apiResource('autores', AutorController::class);
    Route::apiResource('generos', GeneroController::class);
    Route::apiResource('livros', LivroController::class);
    Route::apiResource('reviews', ReviewController::class);

    // Rotas Adicionais

    // Livros
    Route::get('livros/{livro}/reviews', [LivroController::class, 'reviews']); // Listar reviews de um livro
    Route::get('livros-com-detalhes', [LivroController::class, 'indexWithDetails']); // Listar livros com reviews, autor e gênero

    // Autores
    Route::get('autores/{autor}/livros', [AutorController::class, 'livros']); // Listar livros de um autor
    Route::get('autores-com-livros', [AutorController::class, 'indexWithLivros']); // Listar autores com seus livros

    // Usuários
    Route::get('usuarios/{usuario}/reviews', [UsuarioController::class, 'reviews']); // Listar reviews de um usuário

    // Gêneros
    Route::get('generos/{genero}/livros', [GeneroController::class, 'livros']); // Listar livros de um gênero
    Route::get('generos-com-livros', [GeneroController::class, 'indexWithLivros']); // Listar gêneros com seus livros

});

