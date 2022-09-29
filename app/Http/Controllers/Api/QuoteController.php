<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AcceptedQuotesByWorkshops;
use App\Http\Resources\BookingResource;
use App\Http\Resources\OffersResource;
use App\Models\AcceptedQuote;
use App\Models\Booking;
use App\Models\Quote;
use App\Models\QuoteService;
use App\Models\QuotesWorkshop;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'workshop_id'=> 'required',
            'services'=>'required',
            'car_id'=>'required'
        ]);
        $quote = new Quote;
        $quote->user_id = $request->user_id;
        $quote->status = 'pending';
        $quote->comments = $request->comments;
        $quote->quote_date = Carbon::now()->format('Y-m-d');
        $quote->car_id = $request->car_id;
        $quote->save();
        $workshops = json_decode($request->workshop_id, true);
        foreach($workshops as $workshop){
            $quote_workshop = new QuotesWorkshop;
            $quote_workshop->user_id = $request->user_id;
            $quote_workshop->quote_id = $quote->id;
            $quote_workshop->workshop_id = $workshop;
            $quote_workshop->status = 'pending';

            $quote_workshop->comments = $request->comments;
            $quote_workshop->quote_date = Carbon::now()->format('Y-m-d');
            $quote_workshop->save();
            $services = json_decode($request->services, true);
        }
        foreach($services as $service){
            $quoteservice = new QuoteService;
            $quoteservice->quote_id = $quote->id;
            $quoteservice->service_id = $service;
            $quoteservice->save();
        }
        return response([
            'status'=>true,
        ]);

    }


    public function pendingQuotes($id){

        return $quotes = Quote::with('services','services.service')->where('user_id',$id)->get();
        return response([
          'status'=> true,
          'data'=> AcceptedQuotesByWorkshops::collection($quotes),
       ]);

  }
  public function pending($id){
    // Pending Offers
    $pendingOffers = Quote::with('services')->where('status','pending')->where('user_id',$id)->get();
    return response([
      'status'=> true,
      'data'=> AcceptedQuotesByWorkshops::collection($pendingOffers),
   ]);
 }

 public function offers($id){

   $offers = AcceptedQuote::with('workshop')->where('quote_id',$id)->where('status','pending')->get();
    return response([
      'status'=> true,
      'data'=> OffersResource::collection($offers),
   ]);
 }
 public function ongoing($id){

       $bookings = Booking::with('workshop','quote','quote.services','quote.services.service')->where('user_id',$id)->where('status','pending')->get();
     return response([
       'status'=> true,
       'data'=> BookingResource::collection($bookings),
    ]);
  }




}
