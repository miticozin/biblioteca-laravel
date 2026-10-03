<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $categorias = Categoria::withCount('livros')
            ->when($busca, fn ($q) => $q->where('nome', 'like', "%{$busca}%"))
            ->orderBy('nome')
            ->paginate(10)
            ->withQueryString();

        return view('categorias.index', compact('categorias', 'busca'));
    }

    public function create()
    {
        return view('categorias.create', ['categoria' => new Categoria()]);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255', 'unique:categorias,nome'],
            'descricao' => ['nullable', 'string', 'max:255'],
        ]);

        Categoria::create($dados);

        return redirect()->route('categorias.index')->with('sucesso', 'Categoria cadastrada com sucesso.');
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255', Rule::unique('categorias', 'nome')->ignore($categoria->id)],
            'descricao' => ['nullable', 'string', 'max:255'],
        ]);

        $categoria->update($dados);

        return redirect()->route('categorias.index')->with('sucesso', 'Categoria atualizada com sucesso.');
    }

    public function destroy(Categoria $categoria)
    {
        if ($categoria->livros()->exists()) {
            return redirect()->route('categorias.index')->with('erro', 'Não é possível excluir uma categoria que possui livros.');
        }

        $categoria->delete();

        return redirect()->route('categorias.index')->with('sucesso', 'Categoria excluída com sucesso.');
    }
}
