<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = ['nome', 'descricao'];

    public function livros(): HasMany
    {
        return $this->hasMany(Livro::class);
    }
}
