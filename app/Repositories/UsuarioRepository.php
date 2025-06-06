<?php

namespace App\Repositories;

use App\Models\Usuario;



class UsuarioRepository
{


    public function getAll()
    {
        return Usuario::all();
    }

    public function findById($id)
    {

        return Usuario::findOrFail($id);
    }

    public function create(array $data)
    {
        return Usuario::create($data);
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








}

