<?php

use App\Http\Controllers\Api\ProdutoController;
use Illuminate\Support\Facades\Route;

// Rotas públicas (Listar e Ver detalhes)
Route::get('produtos', [ProdutoController::class, 'index']);
Route::get('produtos/{produto}', [ProdutoController::class, 'show']);

// Rotas protegidas (Criar, Editar, Deletar)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('produtos', [ProdutoController::class, 'store']);
    Route::put('produtos/{produto}', [ProdutoController::class, 'update']);
    Route::delete('produtos/{produto}', [ProdutoController::class, 'destroy']);
});
