<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Categoria;
use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LivroController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $livros = Livro::query()
            ->join('categorias', 'categorias.id', '=', 'livros.categoria_id')
            ->leftJoin('autor_livro', 'autor_livro.livro_id', '=', 'livros.id')
            ->leftJoin('autores', 'autores.id', '=', 'autor_livro.autor_id')
            ->select('livros.*')
            ->when($busca, function ($q) use ($busca) {
                $q->where(function ($w) use ($busca) {
                    $w->where('livros.titulo', 'like', "%{$busca}%")
                        ->orWhere('categorias.nome', 'like', "%{$busca}%")
                        ->orWhere('autores.nome', 'like', "%{$busca}%");
                });
            })
            ->groupBy('livros.id')
            ->orderBy('livros.titulo')
            ->with(['categoria', 'autores'])
            ->paginate(10)
            ->withQueryString();

        return view('livros.index', compact('livros', 'busca'));
    }

    public function create()
    {
        return view('livros.create', [
            'livro' => new Livro(),
            'categorias' => Categoria::orderBy('nome')->get(),
            'autores' => Autor::orderBy('nome')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'ano_publicacao' => ['nullable', 'integer', 'min:1000', 'max:' . date('Y')],
            'isbn' => ['nullable', 'string', 'max:20', 'unique:livros,isbn'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'autores' => ['required', 'array', 'min:1'],
            'autores.*' => ['exists:autores,id'],
        ]);

        $livro = Livro::create($request->only('titulo', 'ano_publicacao', 'isbn', 'categoria_id'));
        $livro->autores()->sync($dados['autores']);

        return redirect()->route('livros.index')->with('sucesso', 'Livro cadastrado com sucesso.');
    }

    public function edit(Livro $livro)
    {
        return view('livros.edit', [
            'livro' => $livro,
            'categorias' => Categoria::orderBy('nome')->get(),
            'autores' => Autor::orderBy('nome')->get(),
        ]);
    }

    public function update(Request $request, Livro $livro)
    {
        $dados = $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'ano_publicacao' => ['nullable', 'integer', 'min:1000', 'max:' . date('Y')],
            'isbn' => ['nullable', 'string', 'max:20', Rule::unique('livros', 'isbn')->ignore($livro->id)],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'autores' => ['required', 'array', 'min:1'],
            'autores.*' => ['exists:autores,id'],
        ]);

        $livro->update($request->only('titulo', 'ano_publicacao', 'isbn', 'categoria_id'));
        $livro->autores()->sync($dados['autores']);

        return redirect()->route('livros.index')->with('sucesso', 'Livro atualizado com sucesso.');
    }

    public function destroy(Livro $livro)
    {
        $livro->autores()->detach();
        $livro->delete();

        return redirect()->route('livros.index')->with('sucesso', 'Livro excluído com sucesso.');
    }
}
