<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Services\UsuarioService;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Http\Resources\UsuarioResource;
use App\Http\Resources\ReviewResource;

use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsuarioController extends Controller
{

    private UsuarioService $usuarioService;
    


    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    public function index()
    {
        $usuarios = $this->usuarioService->getAllUsuarios();
        return UsuarioResource::collection($usuarios);
    }

    public function store(StoreUsuarioRequest $request)
    {

        $data = $request->validated();
        $usuario = $this->usuarioService->createUsuario($data);

        return new UsuarioResource($usuario);
    }

    public function show($id)
    {
        try {
            $usuario = $this->usuarioService->findUsuarioById($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Usuário não encontrado'], Response::HTTP_NOT_FOUND);
        }
        return new UsuarioResource($usuario);
    }

    public function update(UpdateUsuarioRequest $request, $id)
    {
        $data = $request->validated();
        try {
            $usuario = $this->usuarioService->updateUsuario($id, $data);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Usuário não encontrado'], Response::HTTP_NOT_FOUND);
        }
        return new UsuarioResource($usuario);
    }

    public function destroy($id)
    {
        try {
            $this->usuarioService->findUsuarioById($id);
            $this->usuarioService->deleteUsuario($id);
    
            return response()->json(['message' => 'Usuário deletado com sucesso!'], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Usuário não encontrado'], Response::HTTP_NOT_FOUND);
        }
    }
    

    public function reviews($id)
    {
        try {
            $reviews = $this->usuarioService->getReviewsPorUsuario($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Usuário não encontrado'], Response::HTTP_NOT_FOUND);
        }


        return ReviewResource::collection($reviews);
    }
}

