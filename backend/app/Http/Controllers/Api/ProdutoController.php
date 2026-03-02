<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    // Listar todos os produtos (GET)
    public function index()
    {
        return response()->json(Produto::all());
    }

    // Criar um novo produto (POST)
    public function store(Request $request)
    {
        // 1. Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco' => 'required|numeric',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB Max
        ]);

        $data = $request->all();

        // 2. Upload de Imagem
        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('produtos', 'public');
            $data['imagem'] = $path; // Salva o caminho no banco
        }

        $produto = Produto::create($data);

        return response()->json($produto, 201); // 201 = Created
    }

    // Mostrar um único produto (GET)
    public function show(Produto $produto)
    {
        return response()->json($produto);
    }

    // Atualizar um produto (PUT/PATCH)
    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco' => 'required|numeric',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Upload de nova imagem se houver
        if ($request->hasFile('imagem')) {
            // Apaga a imagem antiga
            if ($produto->imagem) {
                Storage::disk('public')->delete($produto->imagem);
            }
            $path = $request->file('imagem')->store('produtos', 'public');
            $data['imagem'] = $path;
        }

        $produto->update($data);

        return response()->json($produto);
    }

    // Deletar um produto (DELETE)
    public function destroy(Produto $produto)
    {
        // Apaga a imagem do storage
        if ($produto->imagem) {
            Storage::disk('public')->delete($produto->imagem);
        }

        $produto->delete();

        return response()->json(null, 204); // 204 = No Content
    }
}
