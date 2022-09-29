<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('user')->get();
        return view('admin.car.index',compact('cars'));
    }


    public function create()
    {
        $users = User::get();
        return view('admin.car.create',compact('users'));
    }


    public function store(Request $request){

        $request->validate([
            'make' => 'required',
            'model'=> 'required',
            'year' => 'required',
            'status' => 'required',
         //   'photo' => 'required',
            'user' => 'required',
            'number_plate' => 'required'
        ]);
        $car = new Car;
        $car->make = $request->make;
        $car->model = $request->model;
        $car->year = $request->year;
        $car->user_id = $request->user;
        $car->number_plate = $request->number_plate;
        $car->status = 'active';
        $car->save();
        if($request->has('photo')){
            $photo = 'photo-'.$car->id.'.'.$request->photo->extension();
            $car->addMediaFromRequest('photo')->usingName($photo)->toMediaCollection('car_photo');
        }
        return redirect()->route('admin.car')->with('success','Car has been added successfuly');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $car =  Car::findOrFail($request->id);
        if($car->delete()){
            return response(['success' => true,'message' => 'car has been deleted successfully']);
        }else{
            return response(['success' => false,'message' => 'car not deleted']);

        }
    }


    public function edit($id)
    {
        $car = Car::findorFail($id);
        $users = User::get();
        return view('admin.car.edit',compact('car','users'));
    }


    public function update(Request $request){

        $request->validate([
            'make' => 'required',
            'model'=> 'required',
            'year' => 'required',
            'status' => 'required',
         //   'photo' => 'required',
            'user' => 'required',
            'number_plate' => 'required',
            'car' => 'required'
        ]);
        $car =  Car::findOrFail($request->car);
        $car->make = $request->make;
        $car->model = $request->model;
        $car->year = $request->year;
        $car->user_id = $request->user;
        $car->number_plate = $request->number_plate;
        $car->status = $request->status;
        $car->save();
        if($request->has('photo')){
            $photo = 'photo-'.$car->id.'.'.$request->photo->extension();
            $car->addMediaFromRequest('photo')->usingName($photo)->toMediaCollection('car_photo');
        }
        return redirect()->route('admin.car')->with('success','Car has been updated successfuly');
    }
}
