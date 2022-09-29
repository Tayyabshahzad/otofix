<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Policy;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function about()
    {
        $about = About::first();
        return response([
            'status' => true,
            'data' =>  $about,
        ]);
    }

    public function policy()
    {
        $policy = Policy::first();
        return response([
            'status' => true,
            'data' =>  $policy,
        ]);
    }
}
