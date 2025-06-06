<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Services\AutorService;
use App\Http\Requests\StoreAutorRequest;
use App\Http\Requests\UpdateAutorRequest;
use App\Http\Resources\AutorResource;
use App\Http\Resources\LivroResource;

use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AutorController extends Controller
{

    private AutorService $autorService;


    public function __construct(AutorService $autorService)
    {
        $this->autorService = $autorService;
    }

    public function index()
    {
        $autores = $this->autorService->getAllAutores();
        return AutorResource::collection($autores);
    }

    public function store(StoreAutorRequest $request)
    {
        $data = $request->validated();
        $autor = $this->autorService->createAutor($data);

        return new AutorResource($autor);
    }

    public function show($id)
    {
        try {
            $autor = $this->autorService->findAutorById($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "Autor não encontrado"], Response::HTTP_NOT_FOUND);
        }
        return new AutorResource($autor);
    }

    public function update(UpdateAutorRequest $request, $id)
    {
        $data = $request->validated();
        try {
            $autor = $this->autorService->updateAutor($id, $data);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "Autor não encontrado"], Response::HTTP_NOT_FOUND);
        }
        return new AutorResource($autor);
    }

    public function destroy($id)
    {
        try {
            $autor = $this->autorService->findAutorById($id);
            $this->autorService->deleteAutor($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "Autor não encontrado"], Response::HTTP_NOT_FOUND);
        }
    
        return response()->json(["message" => "Autor deletado com sucesso!"], Response::HTTP_OK);
    }
    

    public function livros($id)
    {
        try {

            $livros = $this->autorService->getLivrosPorAutor($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(["message" => "Autor não encontrado"], Response::HTTP_NOT_FOUND);
        }
        return LivroResource::collection($livros);
    }

    public function indexWithLivros()
    {
        $autores = $this->autorService->getAutoresComLivros();
        return AutorResource::collection($autores);
    }
}

