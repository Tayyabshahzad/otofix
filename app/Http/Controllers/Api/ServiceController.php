<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServicesResource;
use App\Http\Resources\WorkshopResource;
use App\Models\Category;
use App\Models\Service;
use App\Models\Workshop;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function listing()
    {
        $services = Service::get();
        return response([
            'status' => true,
            'data' =>  ServicesResource::collection($services),
        ]);

    }

    public function byWorkshop($id)
    {
        $workshop = Workshop::with('services')->findOrFail($id);
        return response([
            'status' => true,
            'data' =>  WorkshopResource::make($workshop),
        ]);
    }

}
