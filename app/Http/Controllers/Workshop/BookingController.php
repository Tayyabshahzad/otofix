<?php

namespace App\Http\Controllers\Workshop;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user->workshop){
             $bookings = Booking::with('user','workshop','acceptedquote','acceptedquote.quote','acceptedquote.quote.car')->where('workshop_id',$user->workshop->id)->get();
        }else{
            $bookings = Booking::with('user','workshop','acceptedquote','acceptedquote.quote','acceptedquote.quote.car')->get();
        }
        return view('workshop.booking.index',compact('bookings'));
    }

    public function view($id)
    {
             $booking = Booking::with('user','workshop','acceptedquote','acceptedquote.quote','acceptedquote.quote.services','acceptedquote.quote.services.service','acceptedquote.quote.car','review')->find($id);
              return view('workshop.booking.view',compact('booking'));
    }
    public function chnageStatus(Request $request)
    {
        $request->validate([
            'booking_id' => 'required',
            'status' => 'required',
        ]);
        $booking = Booking::findOrfail($request->booking_id);
        $booking->status = $request->status;
        $booking->save();
        return redirect()->back()->with('success','Booking Status has been updated');
    }
}
