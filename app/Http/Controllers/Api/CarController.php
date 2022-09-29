<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function listing($id)
    {
        $cars = Car::where('user_id',$id)->get();
        return response([
            'status' => true,
            'data' =>  CarResource::collection($cars),
        ]);

    }

    public function create(Request $request){

        $request->validate([
            'make' => 'required',
            'model'=> 'required',
            'year' => 'required',
           // 'photo' => 'required',
            'user' => 'required',
            'number_plate'=> 'required',
        ]);

        $car = new Car;
        $car->make = $request->make;
        $car->model = $request->model;
        $car->year = $request->year;
        $car->user_id = $request->user;
        $car->number_plate = $request->number_plate;
        $car->status = 'active';
        $car->save();
        // if($request->has('photo')){
        //     $photo = 'photo-'.$car->id.'.'.$request->photo->extension();
        //     $car->addMediaFromRequest('photo')->usingName($photo)->toMediaCollection('car_photo');
        // }
        return response([
            'status' => true,
            'data' =>  CarResource::make($car),
        ]);

    }

    public function update(Request $request){

        $request->validate([
            'id' => 'required',
        ]);

        $car = Car::findorfail($request->id);
        $car->make = $request->make;
        $car->model = $request->model;
        $car->year = $request->year;
        $car->user_id = $request->user;
        $car->number_plate = $request->number_plate;
        $car->status = 'active';
        $car->save();
        // if($request->has('photo')){
        //     $photo = 'photo-'.$car->id.'.'.$request->photo->extension();
        //     $car->addMediaFromRequest('photo')->usingName($photo)->toMediaCollection('car_photo');
        // }
        return response([
            'status' => true,
            'data' =>  CarResource::make($car),
        ]);

    }

}
