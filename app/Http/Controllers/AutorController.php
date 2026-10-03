<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $autores = Autor::withCount('livros')
            ->when($busca, fn ($q) => $q->where('nome', 'like', "%{$busca}%")->orWhere('nacionalidade', 'like', "%{$busca}%"))
            ->orderBy('nome')
            ->paginate(10)
            ->withQueryString();

        return view('autores.index', compact('autores', 'busca'));
    }

    public function create()
    {
        return view('autores.create', ['autor' => new Autor()]);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'nacionalidade' => ['nullable', 'string', 'max:255'],
        ]);

        Autor::create($dados);

        return redirect()->route('autores.index')->with('sucesso', 'Autor cadastrado com sucesso.');
    }

    public function edit(Autor $autor)
    {
        return view('autores.edit', compact('autor'));
    }

    public function update(Request $request, Autor $autor)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'nacionalidade' => ['nullable', 'string', 'max:255'],
        ]);

        $autor->update($dados);

        return redirect()->route('autores.index')->with('sucesso', 'Autor atualizado com sucesso.');
    }

    public function destroy(Autor $autor)
    {
        $autor->livros()->detach();
        $autor->delete();

        return redirect()->route('autores.index')->with('sucesso', 'Autor excluído com sucesso.');
    }
}
