<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Livro extends Model
{
    protected $table = 'livros';

    protected $fillable = ['titulo', 'ano_publicacao', 'isbn', 'categoria_id'];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function autores(): BelongsToMany
    {
        return $this->belongsToMany(Autor::class, 'autor_livro', 'livro_id', 'autor_id');
    }
}
