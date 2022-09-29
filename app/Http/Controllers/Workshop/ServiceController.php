<?php

namespace App\Http\Controllers\Workshop;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userDetail =    User::with('workshop')->findOrFail($user->id);
        $workshop = Workshop::with('user','reviews')->findorFail($user->workshop->id);
        $services = Service::get();
        $assign_services = $workshop->services->pluck('id')->toArray();
        return view('workshop.services.index',compact('services','assign_services','workshop'));
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
