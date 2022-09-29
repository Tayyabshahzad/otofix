<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Nexmo\Laravel\Facade\Nexmo;

class loginPhoneController extends Controller
{
    public function register()
    {
       return view('auth.phone');
    }

    public function login()
    {
       return view('auth.phone_login');
    }

    public function registerProcess(Request $request)
    {
        $request->validate([
            'phone' => 'required|unique:users,phone',
            'cc'=>'required',
            'registered_type'=>'required'
        ]);
        $token =  mt_rand(1000,9999);
        $timeNow = Carbon::now()->format('Y-m-d H:i:s');
        DB::table('password_resets')
            ->updateOrInsert(
                ['phone' => $request->phone],
                ['token' => $token],
                ['created_at' => $timeNow]
            );
        DB::beginTransaction();
        try{
            $user = new User;
            $user->phone = $request->phone;
            $user->registered_type = $request->registered_type;
            $user->save();
            Nexmo::message()->send([
                'to'=>$request->cc.$request->phone,
                'from'=>'3734',
                'text'=>$token.' is your OTP'
            ]);
            DB::commit();
            return view('auth.verify-phone',compact('user'));
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error','Error while creating user');
        }



    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);
        $user = User::where('cc',$request->cc)->where('phone',$request->phone)->first();
        if($user){
            if($user->email_verified_at == null){
                return view('auth.verify-phone',compact('user'));
            }
            auth()->login($user);
            return redirect()->route('admin.dashboard')->with('error','Error while login');

        }else{
            return redirect()->back()->with('error','Error while login');
        }


    }

    public function varifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required',
            'user'=> 'required'
        ]);
        $user = User::findorfail($request->user);
        $token = DB::table('password_resets')->where(['token' => $request->otp,'phone' => $user->cc.$user->phone])->first();
        if($token){
            $user->email_verified_at =   Carbon::now()->format('Y-m-d H:i:s');
            $user->save();
        }
        $deleteToken = DB::table('password_resets')->where(['token' => $request->otp])->delete();
        return view('auth.phone_login');
        //$user;
    }

    public function resendOTP($id)
    {
        $user = User::findorfail($id);
        return view('auth.verify-phone',compact('user'));
    }



}
