<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionControler extends Controller
{
    public function index()
    {
        $promotions = Promotion::get();
        return view('admin.promotion.index',compact('promotions'));
    }
}
