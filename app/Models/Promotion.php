<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Promotion extends Model  implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    public function workshop(){
        return $this->belongsTo(Workshop::class);
    }
}
