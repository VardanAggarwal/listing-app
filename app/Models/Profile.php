<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function resiliencies(){
        return $this->morphToMany(Resiliency::class,'reliable');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function roles(){
        return $this->belongsToMany(Role::class);
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
