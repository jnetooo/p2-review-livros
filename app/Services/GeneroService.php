<?php

namespace App\Services;

use App\Repositories\GeneroRepository;
use App\Repositories\LivroRepository;


class GeneroService
{
    protected $generoRepository;
    protected $livroRepository;


    public function __construct(GeneroRepository $generoRepository, LivroRepository $livroRepository)
    {
        $this->generoRepository = $generoRepository;
        $this->livroRepository = $livroRepository;
    }

    public function getAllGeneros()
    {
        return $this->generoRepository->getAll();
    }

    public function findGeneroById($id)
    {

        return $this->generoRepository->findById($id);
    }

    public function createGenero(array $data)
    {
        return $this->generoRepository->create($data);
    }

    public function updateGenero($id, array $data)
    {

        return $this->generoRepository->update($id, $data);
    }

    public function deleteGenero($id)
    {
        return $this->generoRepository->delete($id);
    }


    public function getLivrosPorGenero($generoId)
    {

        $this->generoRepository->findById($generoId);

        return $this->livroRepository->findByGenero($generoId);
    }

    public function getGenerosComLivros()
    {
        return $this->generoRepository->getAllWithLivros();
    }
}

