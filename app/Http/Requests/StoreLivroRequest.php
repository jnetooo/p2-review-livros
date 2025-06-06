<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLivroRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:20|unique:livros,isbn',
            'ano_publicacao' => 'nullable|integer|digits:4',
            'sinopse' => 'nullable|string',
            'autor_id' => 'required|integer|exists:autores,id',
            'genero_id' => 'nullable|integer|exists:generos,id',
        ];
    }
}

