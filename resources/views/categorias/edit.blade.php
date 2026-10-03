@extends('layouts.app')

@section('conteudo')
<h2 class="mb-3">Editar categoria</h2>
@include('categorias._form', ['action' => route('categorias.update', $categoria), 'metodo' => 'PUT'])
@endsection
