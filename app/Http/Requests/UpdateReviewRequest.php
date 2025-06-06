<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
{

    public function authorize(): bool
    {

        return true;
    }

    public function rules(): array
    {

        return [
            "texto" => "sometimes|required|string",
            "nota" => "sometimes|required|integer|min:0|max:5",



        ];
    }
}

