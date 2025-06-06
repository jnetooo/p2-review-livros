<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneroResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "nome" => $this->nome,
            "descricao" => $this->whenNotNull($this->descricao),
            "data_criacao" => $this->created_at->format("d/m/Y H:i:s"),
            "data_atualizacao" => $this->updated_at->format("d/m/Y H:i:s"),

            "livros" => LivroResource::collection($this->whenLoaded("livros")),
        ];
    }
}

