<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Services\LivroService;
use App\Http\Requests\StoreLivroRequest;
use App\Http\Requests\UpdateLivroRequest;
use App\Http\Resources\LivroResource;
use App\Http\Resources\ReviewResource;

use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LivroController extends Controller
{

    private LivroService $livroService;


    public function __construct(LivroService $livroService)
    {
        $this->livroService = $livroService;
    }

    public function index()
    {
        $livros = $this->livroService->getAllLivros();
        return LivroResource::collection($livros);
    }

    public function store(StoreLivroRequest $request)
    {
        $data = $request->validated();
        $livro = $this->livroService->createLivro($data);

        return new LivroResource($livro);
    }

    public function show($id)
    {
        try {
            $livro = $this->livroService->findLivroById($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "Livro não encontrado"], Response::HTTP_NOT_FOUND);
        }
        return new LivroResource($livro);
    }

    public function update(UpdateLivroRequest $request, $id)
    {
        $data = $request->validated();
        try {
            $livro = $this->livroService->updateLivro($id, $data);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "Livro não encontrado"], Response::HTTP_NOT_FOUND);
        }
        return new LivroResource($livro);
    }

    public function destroy($id)
    {
        try {
            $livro = $this->livroService->findLivroById($id);
            $this->livroService->deleteLivro($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "Livro não encontrado"], Response::HTTP_NOT_FOUND);
        }
    
        return response()->json(["message" => "Livro deletado com sucesso!"], Response::HTTP_OK);
    }
    

    public function reviews($id)
    {
        try {

            $reviews = $this->livroService->getReviewsPorLivro($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(["message" => "Livro não encontrado"], Response::HTTP_NOT_FOUND);
        }
        return ReviewResource::collection($reviews);
    }

    public function indexWithDetails()
    {
        $livros = $this->livroService->getLivrosComDetalhes();
        return LivroResource::collection($livros);
    }
}

