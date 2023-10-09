<?php

namespace App\Http\Controllers\students;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitPromotionRequest;
use App\Interfaces\StudentPromotionRepositoryInterface;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    private StudentPromotionRepositoryInterface $studentPromotionRepository;
    public function __construct(StudentPromotionRepositoryInterface $studentPromotionRepository)
    {
        $this->studentPromotionRepository = $studentPromotionRepository;
    }
    public function index()
    {
       return $this->studentPromotionRepository->promotionIndex();
    }
    public function store(SubmitPromotionRequest $request)
    {
        return $this->studentPromotionRepository->submitPromotion($request);
    }
    public function showAll()
    {
        return $this->studentPromotionRepository->showPromotions();
    }
    public function rollbackPromotion(Request $request)
    {
        return $this->studentPromotionRepository->rollbackPromotion($request);
    }
    public function rollbackStudentPromotion(Promotion $promotion)
    {
        return $this->studentPromotionRepository->rollbackStudentPromotion($promotion);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
