<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resiliency extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected static function booted(){
        static::created(function($resiliency){
            $feed= new Feed;
            $feed->feedable_id=$resiliency->resilient_id;
            $feed->feedable_type=$resiliency->resilient_type;
            $feed->resiliency_id=$resiliency->id;
            $feed->save();
        });
    }

    public function resilient(){
        return $this->morphTo();
    }
    public function agriservices(){
        return $this->morphedByMany(Agriservice::class, 'reliable');
    }
    public function categories(){
        return $this->morphedByMany(Category::class, 'reliable');
    }
    public function listings(){
        return $this->morphedByMany(Listing::class, 'reliable');
    }
    public function profiles(){
        return $this->morphedByMany(Profile::class, 'reliable');
    }
    public function stories(){
        return $this->morphedByMany(Story::class, 'reliable');
    }
}
