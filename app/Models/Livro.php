<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $table = 'livros';

    protected $fillable = [
        'titulo',
        'sinopse',
        'autor_id',
        'genero_id',
    ];

    protected $casts = [
        'ano_publicacao' => 'integer',
    ];

    public function autor()
    {
        return $this->belongsTo(Autor::class);
    }

    public function genero()
    {

        return $this->belongsTo(Genero::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}

