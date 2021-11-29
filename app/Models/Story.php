<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $with = ['linkages','finances'];

    public function resiliencies(){
        return $this->morphToMany(Resiliency::class,'reliable')->using(Reliable::class);
    }
    public function linkages(){
        return $this->hasMany(Linkage::class);
    }
    public function finances(){
        return $this->hasMany(Finance::class);
    }
    public function profile(){
        return $this->belongsTo(Profile::class);
    }
}
