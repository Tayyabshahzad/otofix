<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }

    public function acceptedquote()
    {
        return $this->belongsTo(AcceptedQuote::class,'accepted_quotes_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

}
