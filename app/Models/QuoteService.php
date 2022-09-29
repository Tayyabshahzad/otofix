<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteService extends Model
{
    use HasFactory;
    public function quote(){
        return $this->belongsTo(Quote::class);
    }
    public function service(){
        return $this->belongsTo(Service::class);
    }
}
