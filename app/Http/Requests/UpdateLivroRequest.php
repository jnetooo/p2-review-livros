<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLivroRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $livroId = $this->route("livro");

        return [
            "titulo" => "sometimes|required|string|max:255",
            "isbn" => [
                "sometimes",
                "nullable",
                "string",
                "max:20",
                Rule::unique("livros", "isbn")->ignore($livroId),
            ],
            "ano_publicacao" => "sometimes|nullable|integer|digits:4",
            "sinopse" => "sometimes|nullable|string",
            "autor_id" => "sometimes|required|integer|exists:autores,id",
            "genero_id" => "sometimes|nullable|integer|exists:generos,id",
        ];
    }
}

