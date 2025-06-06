<?php

namespace App\Services;

use App\Repositories\UsuarioRepository;
use App\Repositories\ReviewRepository;


class UsuarioService
{
    protected $usuarioRepository;
    protected $reviewRepository;


    public function __construct(UsuarioRepository $usuarioRepository, ReviewRepository $reviewRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
        $this->reviewRepository = $reviewRepository;
    }

    public function getAllUsuarios()
    {
        return $this->usuarioRepository->getAll();
    }

    public function findUsuarioById($id)
    {
        return $this->usuarioRepository->findById($id);
    }

    public function createUsuario(array $data)
    {
        return $this->usuarioRepository->create($data);
    }

    public function updateUsuario($id, array $data)
    {
        return $this->usuarioRepository->update($id, $data);
    }

    public function deleteUsuario($id)
    {
        return $this->usuarioRepository->delete($id);
    }


    public function getReviewsPorUsuario($usuarioId)
    {
        $this->usuarioRepository->findById($usuarioId);
        return $this->reviewRepository->findByUsuario($usuarioId);
    }
}

