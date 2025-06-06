<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AutorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "nome" => $this->nome,
            "biografia" => $this->whenNotNull($this->biografia),
            "data_nascimento" => $this->whenNotNull($this->data_nascimento?->format("d/m/Y")),
            "data_criacao" => $this->created_at->format("d/m/Y H:i:s"),
            "data_atualizacao" => $this->updated_at->format("d/m/Y H:i:s"),

            "livros" => LivroResource::collection($this->whenLoaded("livros")),
        ];
    }
}

