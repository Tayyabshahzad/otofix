<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Notifications\Notification_ResetPassword;
use Carbon\Carbon;
use Exception;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Nexmo\Laravel\Facade\Nexmo;

class UserController extends Controller
{
    // User Status API

    public function loginEmail(Request $request)
    {
        $login =  $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if(Auth::attempt(['email' => $request->email,'password' => $request->password])){
            $user = Auth::user();
            if($user->email_verified_at == null){
                Auth::logout();
                return response()->json([
                    'status' => false,
                    'message' => "email address not verified",
                    'user' => UserResource::make($user),
                ], 404);
            }

            $token = Auth::user()->createToken('authToken')->accessToken;
            return [
                'user' => UserResource::make($user),
                'token' => $token,
                'status' =>true,
            ];
       }else{
            return response()->json([
                'status' => false,
                'message' => "user email or password incorrect",
            ], 404);
        }
    }
    public function loginMobile(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);
        $user = User::where('phone',$request->phone)->first();
        if($user){
            if($user->email_verified_at == null){
                return response()->json([
                    'status' => false,
                    'message' => "phone number is not verified",
                    'user' => UserResource::make($user),
                ]);
            }
            Auth::login($user);
            $token = Auth::user()->createToken('authToken')->accessToken;
            return [
                'user' => UserResource::make($user),
                'token' => $token,
                'status' =>true
            ];

        }else{
            return response()->json([
                'status' => false,
                'message' => "invalid phone number",
            ]);
        }
    }
    public function registerEmail(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'phone' => 'required',
            'password' => 'required',
        ]);
        if($request->registered_type == 'facebook' || $request->registered_type == 'google'){
                $user  = User::where('email', $request->email)->first();
                if($user){
                    Auth::login($user);
                    $token = Auth::user()->createToken('authToken')->accessToken;
                    return [
                        'user' => UserResource::make($user),
                        'token' => $token
                    ];
                }else{
                    DB::beginTransaction();
                    try{
                        $user = new User;
                        $user->name = $request->name;
                        $user->email = $request->email;
                        $user->phone = $request->phone;
                        $user->cc = $request->cc;
                        $user->registered_type = $request->registered_type;
                        $user->password = Hash::make($request->password);
                        $user->facebook_id = $request->facebook_id;
                        $user->google_id = $request->google_id;
                        $user->notification_token = $request->notification_token;
                        $user->status = 'active';
                        $user->save();
                        Auth::login($user);
                        $token = Auth::user()->createToken('authToken')->accessToken;
                        $user->assignRole('customer');
                        if($request->has('photo')){
                            $photo = 'photo-'.$user->id.'.'.$request->photo->extension();
                            $user->addMediaFromRequest('photo')->usingName($photo)->toMediaCollection('profile_photo');
                        }
                        DB::commit();
                        return [
                            'user' => UserResource::make($user),
                            'token' => $token
                        ];
                    }catch(Exception $error){
                        DB::rollBack();
                        return [
                            'message' => 'User email or phone already exists',
                            'success'=>false,
                        ];
                    }
                }

        }else{
            DB::beginTransaction();
            try{
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->registered_type = $request->registered_type;
                $user->password = Hash::make($request->password);
                $user->phone = $request->phone;
                $user->status = 'pending';
                $user->registered_type = 'email';
                $user->save();
                $user->assignRole('customer');
                if($request->has('photo')){
                    $photo = 'photo-'.$user->id.'.'.$request->photo->extension();
                    $user->addMediaFromRequest('photo')->usingName($photo)->toMediaCollection('profile_photo');
                }
                Auth::login($user);
                $token = Auth::user()->createToken('authToken')->accessToken;
                DB::commit();
                return [
                    'user' => UserResource::make($user),
                    'token' => $token,
                    'status' =>true,
                ];

            }catch(Exception $e){
                DB::rollBack();
                Log::info($e);
                return response()->json([
                    'status' => false,
                    'message' => "User email or phone already exists",
                ]);
            }
        }


    }
    public function registerMobile(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);
        $user = User::where('phone',$request->phone)->first();
        if($user){
            return response()->json([
                'status' => false,
                'message' => "user already exists",
            ]);
        }
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
            $user->registered_type = 'mobile';
            $user->save();
            // Nexmo::message()->send([
            //     'to'=>$request->phone,
            //     'from'=>'3734',
            //     'text'=>$token.' is your OTP'
            // ]);
            DB::commit();
            return response()->json([
                'status' => false,
                'message' => "please verify phone number",
            ]);
        }catch(Exception $e){
            DB::rollBack();
            return $e;
            return response()->json([
                'status' => false,
                'message' => "error while creating user",
            ]);
        }


    }
    public function otpVerify(Request $request)
    {
        $request->validate([
            'otp' => 'required',
            'phone'=> 'required'
        ]);
        $token = DB::table('password_resets')->where(['token' => $request->otp,'phone' => $request->phone])->first();
        if($token){
            $user = User::where('phone',$request->phone)->first();
            $user->email_verified_at =   Carbon::now()->format('Y-m-d H:i:s');
            $user->save();
            DB::table('password_resets')->where(['token' => $request->otp])->delete();
            return response()->json([
                'status' => true,
                'message' => "user verified please login",
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => "invalid OTP",
            ]);
        }



    }

    public function forgotPasswordbyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $user = User::where('email', $request->email)->first();
        $token =  mt_rand(1000,9999);
        DB::table('password_resets')
        ->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token,'created_at' => Carbon::now()]
        );
        $user = User::where('email', $request->email)->first();
        $userDetail = [
            'body' => 'below is the password reset token please copy the token',
            'userDetailText' => $token,
            'url' => url('/'),
            'message' => 'this token will only user one time',
        ];
        if($user){
            $user->notify(new Notification_ResetPassword($userDetail));
            return response([
                'status' => true,
                'message' => 'we have emailed you password reset link'
            ]);
        }else{
            return response([
                'status' => false,
                'message' => 'error while creating user'
            ]);
        }

    }

    public function validateToken(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users',
        ]);
        $updatePassword = DB::table('password_resets')->where(['email' => $request->email,'token' => $request->token])->first();
        if(!$updatePassword){
            return response([
                'status' => false,
                'message' => 'invalid token'
            ]);
        }else{
            return response([
                'status' => true,
            ]);
        }

    }
    public function setNewPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        $deleteToken = DB::table('password_resets')->where(['email' => $request->email])->delete();
        return response([
            'status' => true,
            'message' => 'password has been changed',
        ]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
        ]);

        $user = User::findOrFail($request->user_id);
        if($request->name){
            $user->name = $request->name;
        }
        if($request->phone){
            $user->phone = $request->phone;
        }
        if($request->address){
            $user->address = $request->address;
        }
        if($request->password != '' or $request->password != null ){
            $user->password =  Hash::make($request->password);
        }
        if($user->save()){
            if($request->has('profile_photo')){
                $photo = 'user-'.$user->id.'-profile.'.$request->profile_photo->extension();
                $user->clearMediaCollection('profile_photo');
                $user->addMediaFromRequest('profile_photo')->usingName($photo)->toMediaCollection('profile_photo');
             }

            return response([
                    'status' => true,
                    'url'=> $user->getFirstMediaUrl('profile_photo','thumb'),
                    'message' => 'user has been updated successfully',
                ]);
        }else{
            return response(['status' => false,'message' => 'user not updated']);
        }

    }
     public function userProfile($id){
        $user = User::findOrFail($id);
        return response([
            'status'=>true,
            'data'=> UserResource::make($user),
        ]);
     }

    public function tokenUpdate(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'notification_token' => 'required',
        ]);
        $user = User::where('id',$request->user_id)->first();
        if($user){
            $user->notification_token = $request->notification_token;
            $user->save();
            return response(['status' => true,'message' => 'Notification token updated']);
        }else{
            return response(['error' => true,'message' => 'User not exists']);
        }


    }
    public function phoneVerify(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);
        $user = User::where('phone',$request->phone)->first();
        if($user){
            $user->email_verified_at = Carbon::now();
            $user->save();
            return response([
                'status'=>true,
                'data' => UserResource::make($user),
            ]);
        }else{
            return response([
                'status'=>false,
                'message' => 'no user found',
            ]);
        }





    }


}
