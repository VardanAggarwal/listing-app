<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $with = ['user'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function listings(){
        return $this->hasMany(Listing::class);
    }
    public function stories(){
        return $this->hasMany(Story::class);
    }
    public function interest_categories(){
        return $this->morphedByMany(Category::class, 'interestable');
    }
    public function interest_resiliencies(){
        return $this->morphedByMany(Resiliency::class, 'interestable');
    }
    public function interest_listings(){
        return $this->morphedByMany(Listing::class, 'interestable');
    }
    public function interest_stories(){
        return $this->morphedByMany(Story::class, 'interestable');
    }
    public function interest_profiles(){
        return $this->morphedByMany(Profile::class, 'interestable');
    }
    public function interested_profiles(){
        return $this->morphToMany(Profile::class,'interestable')->using(Interestable::class);
    }
}
