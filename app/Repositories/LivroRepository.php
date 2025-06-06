<?php

namespace App\Repositories;

use App\Models\Livro;



class LivroRepository
{


    public function getAll()
    {
        return Livro::all();
    }

    public function findById($id)
    {

        return Livro::findOrFail($id);
    }

    public function create(array $data)
    {
        return Livro::create($data);
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



    public function findByAutor($autorId)
    {
        return Livro::where("autor_id", $autorId)->get();
    }

    public function findByGenero($generoId)
    {
        return Livro::where("genero_id", $generoId)->get();
    }

    public function getAllWithDetails()
    {


        return Livro::with(["autor", "genero", "reviews"])->get();
    }
}

