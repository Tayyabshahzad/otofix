<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkshopLocation;
use App\Models\Workshop;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{

    public function locations()
    {
        $workshops = Workshop::select('id','lat','lng')->get();
        return response([
            'status' => true,
            'data' =>  WorkshopLocation::collection($workshops),
        ]);
    }

}
