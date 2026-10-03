@extends('layouts.app')

@section('conteudo')
<h2 class="mb-3">Nova categoria</h2>
@include('categorias._form', ['action' => route('categorias.store'), 'metodo' => 'POST'])
@endsection
