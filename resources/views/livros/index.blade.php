@extends('layouts.app')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Livros</h2>
    <a href="{{ route('livros.create') }}" class="btn btn-primary">Novo livro</a>
</div>

<form method="GET" action="{{ route('livros.index') }}" class="input-group mb-3">
    <input type="text" name="busca" value="{{ $busca }}" class="form-control" placeholder="Pesquisar por título, autor ou categoria">
    <button type="submit" class="btn btn-outline-secondary">Pesquisar</button>
    <a href="{{ route('livros.index') }}" class="btn btn-outline-dark">Limpar</a>
</form>

<table class="table table-striped table-bordered bg-white">
    <thead>
        <tr>
            <th>Título</th>
            <th>Autores</th>
            <th>Categoria</th>
            <th>Ano</th>
            <th>ISBN</th>
            <th style="width: 180px">Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($livros as $livro)
            <tr>
                <td>{{ $livro->titulo }}</td>
                <td>{{ $livro->autores->pluck('nome')->join(', ') }}</td>
                <td>{{ $livro->categoria->nome }}</td>
                <td>{{ $livro->ano_publicacao }}</td>
                <td>{{ $livro->isbn }}</td>
                <td>
                    <a href="{{ route('livros.edit', $livro) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form method="POST" action="{{ route('livros.destroy', $livro) }}" class="d-inline" onsubmit="return confirm('Excluir este livro?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center">Nenhum livro encontrado.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $livros->links('pagination::bootstrap-5') }}
@endsection
