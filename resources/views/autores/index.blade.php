@extends('layouts.app')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Autores</h2>
    <a href="{{ route('autores.create') }}" class="btn btn-primary">Novo autor</a>
</div>

<form method="GET" action="{{ route('autores.index') }}" class="input-group mb-3">
    <input type="text" name="busca" value="{{ $busca }}" class="form-control" placeholder="Pesquisar por nome ou nacionalidade">
    <button type="submit" class="btn btn-outline-secondary">Pesquisar</button>
    <a href="{{ route('autores.index') }}" class="btn btn-outline-dark">Limpar</a>
</form>

<table class="table table-striped table-bordered bg-white">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Nacionalidade</th>
            <th>Livros</th>
            <th style="width: 180px">Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($autores as $autor)
            <tr>
                <td>{{ $autor->nome }}</td>
                <td>{{ $autor->nacionalidade }}</td>
                <td>{{ $autor->livros_count }}</td>
                <td>
                    <a href="{{ route('autores.edit', $autor) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form method="POST" action="{{ route('autores.destroy', $autor) }}" class="d-inline" onsubmit="return confirm('Excluir este autor?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center">Nenhum autor encontrado.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $autores->links('pagination::bootstrap-5') }}
@endsection
