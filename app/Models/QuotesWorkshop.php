<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotesWorkshop extends Model
{
    use HasFactory;

    public function quote(){
        return $this->belongsTo(Quote::class);
    }

    public function workshop(){
        return $this->belongsTo(Workshop::class);
    }

}
