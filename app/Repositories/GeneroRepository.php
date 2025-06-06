<?php

namespace App\Repositories;

use App\Models\Genero;



class GeneroRepository
{


    public function getAll()
    {
        return Genero::all();
    }

    public function findById($id)
    {

        return Genero::findOrFail($id);
    }

    public function create(array $data)
    {
        return Genero::create($data);
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


    public function getAllWithLivros()
    {


        return Genero::with("livros")->get();
    }
}

