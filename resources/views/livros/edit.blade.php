@extends('layouts.app')

@section('conteudo')
<h2 class="mb-3">Editar livro</h2>
@include('livros._form', ['action' => route('livros.update', $livro), 'metodo' => 'PUT'])
@endsection
