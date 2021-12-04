<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function resiliencies(){
        return $this->morphToMany(Resiliency::class,'reliable')->using(Reliable::class);
    }
    public function profile(){
        return $this->belongsTo(Profile::class);
    }
    public function interested_profiles(){
        return $this->morphToMany(Profile::class,'interestable')->using(Interestable::class);
    }
}
