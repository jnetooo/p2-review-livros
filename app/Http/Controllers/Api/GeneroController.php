<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Services\GeneroService;
use App\Http\Requests\StoreGeneroRequest;
use App\Http\Requests\UpdateGeneroRequest;
use App\Http\Resources\GeneroResource;
use App\Http\Resources\LivroResource;

use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GeneroController extends Controller
{

    private GeneroService $generoService;


    public function __construct(GeneroService $generoService)
    {
        $this->generoService = $generoService;
    }

    public function index()
    {
        $generos = $this->generoService->getAllGeneros();
        return GeneroResource::collection($generos);
    }

    public function store(StoreGeneroRequest $request)
    {
        $data = $request->validated();
        $genero = $this->generoService->createGenero($data);

        return new GeneroResource($genero);
    }

    public function show($id)
    {
        try {
            $genero = $this->generoService->findGeneroById($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "Gênero não encontrado"], Response::HTTP_NOT_FOUND);
        }
        return new GeneroResource($genero);
    }

    public function update(UpdateGeneroRequest $request, $id)
    {
        $data = $request->validated();
        try {
            $genero = $this->generoService->updateGenero($id, $data);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "Gênero não encontrado"], Response::HTTP_NOT_FOUND);
        }
        return new GeneroResource($genero);
    }

    public function destroy($id)
    {
        try {
            $genero = $this->generoService->findGeneroById($id);
            $this->generoService->deleteGenero($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "Gênero não encontrado"], Response::HTTP_NOT_FOUND);
        }
    
        return response()->json(["message" => "Gênero deletado com sucesso!"], Response::HTTP_OK);
    }
    

    public function livros($id)
    {
        try {

            $livros = $this->generoService->getLivrosPorGenero($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(["message" => "Gênero não encontrado"], Response::HTTP_NOT_FOUND);
        }
        return LivroResource::collection($livros);
    }

    public function indexWithLivros()
    {
        $generos = $this->generoService->getGenerosComLivros();
        return GeneroResource::collection($generos);
    }
}

