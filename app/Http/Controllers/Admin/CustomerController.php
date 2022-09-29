<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role as ModelsRole;

class CustomerController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->get();
        return view('admin.customer.index',compact('users'));
    }
    public function edit($id)
    {
        $user = User::findorFail($id);
        return view('admin.customer.edit',compact('user'));
    }
    public function update(Request $request)
    {

        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'cc' => 'required',
            'email_status' => 'required',
            'status' => 'required'
        ]);

        $user = User::findorFail($request->id);
        $user->name = $request->name;
        $user->cc = $request->cc;
        $user->phone = $request->phone;
        $user->status = $request->status;
        if($request->email_status == 'verified'){
            if($user->email_status == null){
                $user->email_verified_at = Carbon::now()->format('Y-M-d h:i:s');
            }
        }else{
            $user->email_verified_at = null;
        }
        if ($request->password != '') {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        if($request->has('photo')){
            $photo = 'photo-'.$user->id.'.'.$request->photo->extension();
            $user->addMediaFromRequest('photo')->usingName($photo)->toMediaCollection('profile_photo');
        }
        return redirect()->route('admin.customers')->with('success','User has been updated');
    }

    public function create()
    {
        $roles = DB::table('roles')->get();
        return view('admin.customer.create',compact('roles'));
    }

    public function save(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'role'=> 'required',
            'photo'=> 'required',
            'email_status' => 'required',
            'status' => 'required',
            'password' => 'required'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->status = $request->status;
        $user->password = Hash::make($request->password);
        if($request->email_status == 'verified'){
            if($user->email_status == null){
                $user->email_verified_at = Carbon::now()->format('Y-M-d h:i:s');
            }
        }else{
            $user->email_verified_at = null;
        }

        $user->save();
        $user->assignRole($request->role);
        if($request->has('photo')){
            $photo = 'photo-'.$user->id.'.'.$request->photo->extension();
            $user->addMediaFromRequest('photo')->usingName($photo)->toMediaCollection('profile_photo');
        }
        return redirect()->route('admin.customers')->with('success','User has been updated');
    }


}
