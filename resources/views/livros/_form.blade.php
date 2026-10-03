@php
    $autoresSelecionados = old('autores', $livro->exists ? $livro->autores->pluck('id')->all() : []);
@endphp

<form method="POST" action="{{ $action }}">
    @csrf
    @if ($metodo === 'PUT')
        @method('PUT')
    @endif

    <div class="mb-3">
        <label class="form-label" for="titulo">Título</label>
        <input type="text" id="titulo" name="titulo" class="form-control" value="{{ old('titulo', $livro->titulo) }}" required>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label class="form-label" for="ano_publicacao">Ano de publicação</label>
            <input type="number" id="ano_publicacao" name="ano_publicacao" class="form-control" value="{{ old('ano_publicacao', $livro->ano_publicacao) }}">
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label" for="isbn">ISBN</label>
            <input type="text" id="isbn" name="isbn" class="form-control" value="{{ old('isbn', $livro->isbn) }}">
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label" for="categoria_id">Categoria</label>
            <select id="categoria_id" name="categoria_id" class="form-select" required>
                <option value="">Selecione</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" @selected(old('categoria_id', $livro->categoria_id) == $categoria->id)>{{ $categoria->nome }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Autores</label>
        <div class="border rounded bg-white p-3">
            @forelse ($autores as $autor)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="autores[]" id="autor{{ $autor->id }}" value="{{ $autor->id }}" @checked(in_array($autor->id, $autoresSelecionados))>
                    <label class="form-check-label" for="autor{{ $autor->id }}">{{ $autor->nome }}</label>
                </div>
            @empty
                <span class="text-muted">Cadastre um autor antes de cadastrar livros.</span>
            @endforelse
        </div>
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{ route('livros.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
