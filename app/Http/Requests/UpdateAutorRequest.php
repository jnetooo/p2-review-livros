<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAutorRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            "nome" => "sometimes|required|string|max:255",
            "biografia" => "sometimes|nullable|string",
            "data_nascimento" => "sometimes|nullable|date",
        ];
    }
}

