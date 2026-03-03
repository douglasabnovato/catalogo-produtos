<?php

use App\Http\Controllers\Api\ProdutoController;
use Illuminate\Support\Facades\Route;

// Rota para buscar os dados que preencherão o formulário
Route::get('/produtos/{id}', [ProdutoController::class, 'show']);

// Rota para salvar a alteração
Route::put('/produtos/{id}', [ProdutoController::class, 'update']);

// Rotas protegidas (Criar, Editar, Deletar)
/*
Route::middleware('auth:sanctum')->group(function () {
    Route::post('produtos', [ProdutoController::class, 'store']);
    Route::put('produtos/{produto}', [ProdutoController::class, 'update']);
    Route::delete('produtos/{produto}', [ProdutoController::class, 'destroy']);
});*/
