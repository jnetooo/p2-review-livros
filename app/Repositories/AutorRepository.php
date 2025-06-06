<?php

namespace App\Repositories;

use App\Models\Autor;



class AutorRepository
{


    public function getAll()
    {
        return Autor::all();
    }

    public function findById($id)
    {

        return Autor::findOrFail($id);
    }

    public function create(array $data)
    {
        return Autor::create($data);
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


        return Autor::with("livros")->get();
    }
}

