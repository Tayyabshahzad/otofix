<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Http\Resources\ReviewResource;
use App\Models\AcceptedQuote;
use App\Models\Booking;
use App\Models\Quote;
use App\Models\Review;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function submit(Request $request){

        $request->validate([
            'user_id' => 'required',
            'workshop_id' => 'required',
            'quote_id' => 'required',
            'discount' => 'required',
            'accepted_id'=> 'required',
            'total' => 'required',
            'tax' => 'required'
        ]);

        $checkBooking = Booking::where('quote_id',$request->quote_id)->first();
        if($checkBooking){
            return response([
                'status' => false,
                'message'   => 'Booking already exists for selected quote'
            ]);
        }

        $acceptedQuote = AcceptedQuote::find($request->accepted_id);
        $acceptedQuote->status = 'accepted';
        $acceptedQuote->save();
        $acceptedQuotes = AcceptedQuote::where('id','!=',$request->accepted_id)->where('quote_id',$request->quote_id)->update(['status' => 'rejected']);

        $booking = new Booking;
        $latestOrder = Booking::select('id','booking_number')->orderBy('id','desc')->first();
        if($latestOrder){
            $booking->booking_number = str_pad($latestOrder->booking_number + 1, 8, "0", STR_PAD_LEFT);
        }else{
            $booking->booking_number = str_pad(1 + 1, 8, "0", STR_PAD_LEFT);
        }
        $booking->user_id = $request->user_id;
        $booking->workshop_id = $request->workshop_id;
        $booking->quote_id = $request->quote_id;
        $booking->accepted_quotes_id = $request->accepted_id;
        $booking->discount = $request->discount;
        $booking->tax = $request->tax;
        $booking->total = $request->total;
        $booking->payment_method = 'stripe';
        $booking->payment_clear = true;
        $booking->admin_commission = 5;
        $booking->status = 'pending';
        if($booking->save()){
            // Update Quote Status
            $quote =  Quote::where('id',$request->quote_id)->first();
            $quote->status = 'approved';
            $quote->save();
        }

        return response([
            'status' => true,
            'data'   => $booking
        ]);
    }

    public function review(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'workshop_id' => 'required',
            'booking_id' => 'required',
            'rating' => 'required'
        ]);
        $review = new Review;
        $review->user_id = $request->user_id;
        $review->workshop_id = $request->user_id;
        $review->booking_id = $request->user_id;
        $review->rating = $request->rating;
        $review->comments = $request->comments;
        $review->save();
        return response([
            'status' => true,
            'data'   => ReviewResource::make($review),
        ]);
    }

    public function complete($id)
    {

         $booking = Booking::findorfail($id);
         $booking->status = 'completed';
         $booking->save();
        return response([
            'status' => true,
            'data'   => BookingResource::make($booking),
        ]);
    }

    public function completed($id)
    {

        $booking = Booking::where('user_id',$id)->where('status','completed')->get();
        return response([
            'status' => true,
            'data'   => BookingResource::collection($booking),
        ]);
}





}
