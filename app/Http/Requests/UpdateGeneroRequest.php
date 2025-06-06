<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGeneroRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $generoId = $this->route("genero");

        return [
            "nome" => [
                "sometimes",
                "required",
                "string",
                "max:255",
                Rule::unique("generos", "nome")->ignore($generoId),
            ],
            "descricao" => "sometimes|nullable|string",
        ];
    }
}

