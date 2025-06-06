<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LivroResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "titulo" => $this->titulo,
            "isbn" => $this->whenNotNull($this->isbn),
            "ano_publicacao" => $this->whenNotNull($this->ano_publicacao),
            "sinopse" => $this->whenNotNull($this->sinopse),
            "data_criacao" => $this->created_at->format("d/m/Y H:i:s"),
            "data_atualizacao" => $this->updated_at->format("d/m/Y H:i:s"),

            "autor" => new AutorResource($this->whenLoaded("autor")),
            "genero" => new GeneroResource($this->whenLoaded("genero")),
            "reviews" => ReviewResource::collection($this->whenLoaded("reviews")),
        ];
    }
}

