<?php

namespace App\Services;

use App\Repositories\LivroRepository;
use App\Repositories\ReviewRepository;


class LivroService
{
    protected $livroRepository;
    protected $reviewRepository;

    public function __construct(LivroRepository $livroRepository, ReviewRepository $reviewRepository)
    {
        $this->livroRepository = $livroRepository;
        $this->reviewRepository = $reviewRepository;
    }

    public function getAllLivros()
    {
        return $this->livroRepository->getAll();
    }

    public function findLivroById($id)
    {
        return $this->livroRepository->findById($id);
    }

    public function createLivro(array $data)
    {
        return $this->livroRepository->create($data);
    }

    public function updateLivro($id, array $data)
    {

        return $this->livroRepository->update($id, $data);
    }

    public function deleteLivro($id)
    {
        return $this->livroRepository->delete($id);
    }


    public function getLivrosComDetalhes()
    {
        return $this->livroRepository->getAllWithDetails();
    }

    public function getReviewsPorLivro($livroId)
    {
        $this->livroRepository->findById($livroId);
        return $this->reviewRepository->findByLivro($livroId);
    }
}

