<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;



class UpdateUsuarioRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {


        return [
            "nome" => "sometimes|required|string|max:255",

            "email" => [
                "sometimes",
                "required",
                "string",
                "max:255",

            ],

            "password" => ["sometimes", "required", "string", "confirmed"],
        ];
    }
}

