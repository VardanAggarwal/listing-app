<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agriservice extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function resiliencies(){
        return $this->morphToMany(Resiliency::class,'reliable')->using(Reliable::class);
    }
    public function profile(){
        return $this->belongsTo(Profile::class);
    }
}
