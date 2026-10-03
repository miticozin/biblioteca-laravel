@extends('layouts.app')

@section('conteudo')
<h2 class="mb-3">Editar autor</h2>
@include('autores._form', ['action' => route('autores.update', $autor), 'metodo' => 'PUT'])
@endsection
