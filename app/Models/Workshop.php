<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Workshop extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function services(){
        return $this->belongsToMany(Service::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
