<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PromotionResource;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionControler extends Controller
{
    public function listing()
    {
        $promotions = Promotion::with('workshop')->get();
        return response([
            'status' => true,
            'data' =>  PromotionResource::collection($promotions),
        ]);

    }
}
