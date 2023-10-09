<?php

namespace App\Interfaces;

use App\Models\Promotion;
use Illuminate\Http\Request;

interface StudentPromotionRepositoryInterface
{

    public function promotionIndex();
    public function submitPromotion($request);
    public function showPromotions();
    public function rollbackPromotion(Request $request);
    public function rollbackStudentPromotion(Promotion $promotion);


}
