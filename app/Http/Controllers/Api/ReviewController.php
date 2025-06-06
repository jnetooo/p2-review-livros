<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Services\ReviewService;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Resources\ReviewResource;

use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReviewController extends Controller
{

    private ReviewService $reviewService;


    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function index()
    {
        $reviews = $this->reviewService->getAllReviews();
        return ReviewResource::collection($reviews);
    }

    public function store(StoreReviewRequest $request)
    {
        $data = $request->validated();
        $review = $this->reviewService->createReview($data);

        return new ReviewResource($review);
    }

    public function show($id)
    {
        try {
            $review = $this->reviewService->findReviewById($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "Review não encontrada"], Response::HTTP_NOT_FOUND);
        }
        return new ReviewResource($review);
    }

    public function update(UpdateReviewRequest $request, $id)
    {
        $data = $request->validated();
        try {
            $review = $this->reviewService->updateReview($id, $data);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "Review não encontrada"], Response::HTTP_NOT_FOUND);
        }
        return new ReviewResource($review);
    }

    public function destroy($id)
    {
        try {
            $review = $this->reviewService->findReviewById($id);
            $this->reviewService->deleteReview($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "Review não encontrada"], Response::HTTP_NOT_FOUND);
        }
    
        return response()->json(["message" => "Review deletada com sucesso!"], Response::HTTP_OK);
    }
    
}

