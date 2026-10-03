@extends('layouts.app')

@section('conteudo')
<h2 class="mb-3">Novo autor</h2>
@include('autores._form', ['action' => route('autores.store'), 'metodo' => 'POST'])
@endsection
