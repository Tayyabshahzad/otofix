<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Review;
use App\Models\User;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WorkshopController extends Controller
{
    public function index()
    {
         $workshops = Workshop::with('user')->get();
        return view('admin.workshop.index',compact('workshops'));
    }

    public function create()
    {
        return view('admin.workshop.create');
    }

    public function store(Request $request){

        $request->validate([
            'first_name' => 'required',
            'workshop_name'=> 'required',
            'email' => 'required',
            'phone' => 'required',
            'photo' => 'required',
            'status' => 'required',
            'address'=> 'required',
            'password'=> 'required',
            'lat'=> 'required',
            'lng'=> 'required',
        ]);

        $user = new User;
        $user->name = $request->first_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->status = 'active';
        $user->password = Hash::make($request->password);
        $user->save();
        $user->assignRole('workshop');
        $workshop  = new Workshop;
        $workshop->user_id = $user->id;
        $workshop->name = $request->workshop_name;
        $workshop->address = $request->address;
        $workshop->lat = $request->lat;
        $workshop->lng = $request->lng;
        $workshop->status = $request->status;
        $workshop->save();
        if($request->has('photo')){
            $photo = 'photo-'.$user->id.'.'.$request->photo->extension();
            $workshop->addMediaFromRequest('photo')->usingName($photo)->toMediaCollection('workshop_photo');
        }
        return redirect()->route('admin.workshop')->with('success','Workshop has been added successfuly');
    }

    public function edit($id)
    {
        $workshop = Workshop::with('user')->findorFail($id);
        return view('admin.workshop.edit',compact('workshop'));
    }
    public function view($id)
    {
     $workshop = Workshop::with('user','reviews')->findorFail($id);
        $services = Service::get();
          $assign_services = $workshop->services->pluck('id')->toArray();
        $avgRating = Review::where('workshop_id', $id)->avg('rating');
        $reviews = Review::where('workshop_id', $id)->with('user')->get();
        return view('admin.workshop.view',compact('workshop','services','assign_services','avgRating','reviews'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'workshop_name'=> 'required',
            'phone' => 'required',
            'status' => 'required',
            'address'=> 'required',
            'lat'=> 'required',
            'lng'=> 'required',
            'workshop_id'=> 'required',
            'user_id'=> 'required'
        ]);

        $user = User::findorFail($request->user_id);
        $user->name = $request->first_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->status = 'active';
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        $user->assignRole('workshop');
        $workshop = Workshop::with('user')->findorFail($request->workshop_id);
        $workshop->user_id = $user->id;
        $workshop->name = $request->workshop_name;
        $workshop->address = $request->address;
        $workshop->lat = $request->lat;
        $workshop->lng = $request->lng;
        $workshop->status = $request->status;
        $workshop->save();
        if($request->has('photo')){
            $photo = 'photo-'.$user->id.'.'.$request->photo->extension();
            $workshop->addMediaFromRequest('photo')->usingName($photo)->toMediaCollection('workshop_photo');
        }

        return view('admin.workshop.edit',compact('workshop'));
    }


    public function setservices(Request $request)
    {
        $request->validate([
            'workshop' => 'required',
            //'services'=> 'required',
        ]);
        if($request->has('services')){
            $workshop = Workshop::findorfail($request->workshop);
            $workshop->services()->sync($request->services);
            return redirect()->back()->with('success','Data Updated');
        }else{
           return redirect()->back()->with('error','Select atlest one service');
        }
    }

}
