<?php

namespace App\Repositories;

use App\Models\Review;



class ReviewRepository
{


    public function getAll()
    {
        return Review::all();
    }

    public function findById($id)
    {

        return Review::findOrFail($id);
    }

    public function create(array $data)
    {
        return Review::create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->findById($id);
        $record->update($data);
        return $record;
    }

    public function delete($id)
    {
        $record = $this->findById($id);
        return $record->delete();
    }



    public function findByLivro($livroId)
    {
        return Review::where("livro_id", $livroId)->get();
    }

    public function findByUsuario($usuarioId)
    {
        return Review::where("usuario_id", $usuarioId)->get();
    }
}

