@extends('layouts.app')

@section('conteudo')
<h2 class="mb-3">Novo livro</h2>
@include('livros._form', ['action' => route('livros.store'), 'metodo' => 'POST'])
@endsection
