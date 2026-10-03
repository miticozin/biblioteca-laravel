@extends('layouts.app')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Categorias</h2>
    <a href="{{ route('categorias.create') }}" class="btn btn-primary">Nova categoria</a>
</div>

<form method="GET" action="{{ route('categorias.index') }}" class="input-group mb-3">
    <input type="text" name="busca" value="{{ $busca }}" class="form-control" placeholder="Pesquisar por nome">
    <button type="submit" class="btn btn-outline-secondary">Pesquisar</button>
    <a href="{{ route('categorias.index') }}" class="btn btn-outline-dark">Limpar</a>
</form>

<table class="table table-striped table-bordered bg-white">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Livros</th>
            <th style="width: 180px">Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($categorias as $categoria)
            <tr>
                <td>{{ $categoria->nome }}</td>
                <td>{{ $categoria->descricao }}</td>
                <td>{{ $categoria->livros_count }}</td>
                <td>
                    <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form method="POST" action="{{ route('categorias.destroy', $categoria) }}" class="d-inline" onsubmit="return confirm('Excluir esta categoria?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center">Nenhuma categoria encontrada.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $categorias->links('pagination::bootstrap-5') }}
@endsection
