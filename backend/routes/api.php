<?php

use App\Http\Controllers\Api\ProdutoController;
use Illuminate\Support\Facades\Route;

// GET (index/show), POST (store), PUT/PATCH (update) e DELETE (destroy)
Route::apiResource('produtos', ProdutoController::class);

// Rotas protegidas (Criar, Editar, Deletar)
/*
Route::middleware('auth:sanctum')->group(function () {
    Route::post('produtos', [ProdutoController::class, 'store']);
    Route::put('produtos/{produto}', [ProdutoController::class, 'update']);
    Route::delete('produtos/{produto}', [ProdutoController::class, 'destroy']);
});*/
