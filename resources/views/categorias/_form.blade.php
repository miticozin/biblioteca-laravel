<form method="POST" action="{{ $action }}">
    @csrf
    @if ($metodo === 'PUT')
        @method('PUT')
    @endif

    <div class="mb-3">
        <label class="form-label" for="nome">Nome</label>
        <input type="text" id="nome" name="nome" class="form-control" value="{{ old('nome', $categoria->nome) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label" for="descricao">Descrição</label>
        <input type="text" id="descricao" name="descricao" class="form-control" value="{{ old('descricao', $categoria->descricao) }}">
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
