<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "texto" => "required|string",
            "nota" => "required|integer|min:0|max:5",
            "livro_id" => "required|integer|exists:livros,id",
            "usuario_id" => "required|integer|exists:usuarios,id",
        ];
    }
}

