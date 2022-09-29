<?php

namespace App\Http\Controllers\Workshop;

use App\Http\Controllers\Controller;
use App\Models\AcceptedQuote;
use App\Models\Booking;
use App\Models\Quote;
use App\Models\QuotesWorkshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    public function index(){

         $user = Auth::user();
         $quotes = QuotesWorkshop::with('quote','workshop','quote.user','quote.services','quote.car')->where('workshop_id',$user->workshop->id)->where('status','pending')->get();
        //return $quotes = Quote::with('services','car','quotesWorkshop','quotesWorkshop.workshop')->where('status','pending')->get();
       // return $quotes = QuotesWorkshop::with('user')->where('workshop_id',$user->workshop->id)->where('status','pending')->get();
        //$quotes = Quote::with('user','services','services.service','car')->where('workshop_id',$user->workshop->id)->where('status','pending')->get();
        $workshop_id = $user->workshop->id;
        return view('workshop.quotes.index',compact('quotes','workshop_id'));

    }

    public function submit(Request $request){

        $request->validate([
            'date' => 'required',
            'totalcharges' => 'required',
            'discount' => 'required',
            'workshop_id'=> 'required',
            'grandTotal' => 'required',
            'quote_workshop_id'=> 'required',
            'user_id'=> 'required',
            'tax'=> 'required'
        ]);
        $quoteWorkshop = QuotesWorkshop::findorfail($request->quote_workshop_id);
        $quoteWorkshop->status = 'workshop_submit';
        $quoteWorkshop->save();
        $accepted_quote = new AcceptedQuote;
        $accepted_quote->workshop_id = $request->workshop_id;
        $accepted_quote->quote_id = $quoteWorkshop->quote_id;
        $accepted_quote->user_id = $request->user_id;
        $accepted_quote->service_date = $request->date;
        $accepted_quote->total = $request->totalcharges;
        $accepted_quote->discount = $request->discount;
        $accepted_quote->tax = $request->tax;
        $accepted_quote->grand_total = $request->grandTotal;
        $accepted_quote->status = 'pending';
        $accepted_quote->save();
        return redirect()->back()->with('success','Quote has been submited');

    }

    public function submitedQuotes()
    {
        $user = Auth::user();
        $acceptedQuotes = AcceptedQuote::with('workshop','workshop.user','quote','quote.services','quote.services.service')->where('workshop_id',$user->workshop->id)->get();
        $workshop_id = $user->workshop->id;
        return view('workshop.quotes.submited',compact('acceptedQuotes','workshop_id'));
    }




}
