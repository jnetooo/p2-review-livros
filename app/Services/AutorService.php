<?php

namespace App\Services;

use App\Repositories\AutorRepository;
use App\Repositories\LivroRepository;


class AutorService
{
    protected $autorRepository;
    protected $livroRepository;


    public function __construct(AutorRepository $autorRepository, LivroRepository $livroRepository)
    {
        $this->autorRepository = $autorRepository;
        $this->livroRepository = $livroRepository;
    }

    public function getAllAutores()
    {
        return $this->autorRepository->getAll();
    }

    public function findAutorById($id)
    {
        return $this->autorRepository->findById($id);
    }

    public function createAutor(array $data)
    {
        return $this->autorRepository->create($data);
    }

    public function updateAutor($id, array $data)
    {
        return $this->autorRepository->update($id, $data);
    }

    public function deleteAutor($id)
    {
        return $this->autorRepository->delete($id);
    }


    public function getLivrosPorAutor($autorId)
    {

        $this->autorRepository->findById($autorId);

        return $this->livroRepository->findByAutor($autorId);
    }

    public function getAutoresComLivros()
    {
        return $this->autorRepository->getAllWithLivros();
    }
}

