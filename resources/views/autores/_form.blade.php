<form method="POST" action="{{ $action }}">
    @csrf
    @if ($metodo === 'PUT')
        @method('PUT')
    @endif

    <div class="mb-3">
        <label class="form-label" for="nome">Nome</label>
        <input type="text" id="nome" name="nome" class="form-control" value="{{ old('nome', $autor->nome) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label" for="nacionalidade">Nacionalidade</label>
        <input type="text" id="nacionalidade" name="nacionalidade" class="form-control" value="{{ old('nacionalidade', $autor->nacionalidade) }}">
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{ route('autores.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
