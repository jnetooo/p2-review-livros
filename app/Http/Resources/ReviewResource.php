<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "texto" => $this->texto,
            "nota" => $this->nota,
            "data_criacao" => $this->created_at->format("d/m/Y H:i:s"),
            "data_atualizacao" => $this->updated_at->format("d/m/Y H:i:s"),

            "livro" => new LivroResource($this->whenLoaded("livro")),
            "usuario" => new UsuarioResource($this->whenLoaded("usuario")),
        ];
    }
}

