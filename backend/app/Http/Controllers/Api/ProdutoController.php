<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    /**
     * GET /api/produtos
     * Alimenta a 'ListaProdutos.vue'
     */
    public function index()
    {
        // Retorna todos os produtos ordenados pelos mais recentes
        return response()->json(Produto::orderBy('created_at', 'desc')->get());
    }

    /**
     * POST /api/produtos
     * Recebe os dados do 'FormProduto.vue' (Novo)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome'      => 'required|string|max:255',
            'preco'     => 'required|numeric',
            'descricao' => 'required|string',
            'imagem'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $dados = $request->all();

        if ($request->hasFile('imagem')) {
            // Salva na pasta 'public/produtos' e guarda o caminho no banco
            $path = $request->file('imagem')->store('produtos', 'public');
            $dados['imagem'] = $path;
        }

        $produto = Produto::create($dados);
        return response()->json($produto, 201);
    }

    /**
     * GET /api/produtos/{id}
     * Alimenta o formulário de edição (Modo Editar)
     */
    public function show($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        return response()->json($produto);
    }

    /**
     * PUT /api/produtos/{id} (via Method Spoofing POST)
     * Salva as alterações do 'FormProduto.vue' (Editar)
     */
    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);

        $request->validate([
            'nome'  => 'required|string|max:255',
            'preco' => 'required|numeric',
        ]);

        $dados = $request->all();

        if ($request->hasFile('imagem')) {
            // 1. Deleta a imagem antiga para não entulhar o servidor
            if ($produto->imagem) {
                Storage::disk('public')->delete($produto->imagem);
            }
            // 2. Salva a nova
            $path = $request->file('imagem')->store('produtos', 'public');
            $dados['imagem'] = $path;
        }

        $produto->update($dados);
        return response()->json($produto);
    }

    /**
     * DELETE /api/produtos/{id}
     */
    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);

        if ($produto->imagem) {
            Storage::disk('public')->delete($produto->imagem);
        }

        $produto->delete();
        return response()->json(['message' => 'Removido com sucesso']);
    }
}
