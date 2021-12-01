<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $with = ['user','userTypes'];

    public function resiliencies(){
        return $this->morphToMany(Resiliency::class,'reliable');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function userTypes(){
        return $this->belongsToMany(UserType::class);
    }
    public function listings(){
        return $this->hasMany(Listing::class);
    }
    public function agriservices(){
        return $this->hasMany(Agriservice::class);
    }
    public function stories(){
        return $this->hasMany(Story::class);
    }
}
