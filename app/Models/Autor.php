<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $table = 'autores';

    protected $fillable = [
        'nome',
        'biografia',
        'data_nascimento',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    public function livros()
    {
        return $this->hasMany(Livro::class);
    }
}

