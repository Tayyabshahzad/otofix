<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
class EmailVerification extends Controller
{
    public function index(EmailVerificationRequest $request)
    {
        return 12;
        $request->fulfill();
        return redirect()->route('login')->with('Thanks for email verification please login');
    }
}
