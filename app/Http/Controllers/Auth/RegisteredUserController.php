<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Workshop;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
       // $roles = DB::table('roles')->where('name','!=','workshop')->get();
        return view('auth.register');
    }
    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'email'=>'required|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required'],
        ]);
        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole('admin');
            // $workshop  = new Workshop;
            // $workshop->user_id = $user->id;
            // $workshop->name = $request->workshop_name;
            // $workshop->address = $request->address;
            // $workshop->lat = $request->lat;
            // $workshop->lng = $request->lng;
            // $workshop->status = 'active';
            // $workshop->save();
            event(new Registered($user));
            Auth::login($user);
        }catch(Exception $e){
            return redirect()->back();
        }



    }
}
