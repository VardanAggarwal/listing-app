<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Reliable extends MorphPivot
{
    protected $table = 'reliables';
    protected static function booted(){
        static::created(function($reliable){
            $feed= new Feed;
            $feed->feedable_id=$reliable->reliable_id;
            $feed->feedable_type=$reliable->reliable_type;
            $feed->resiliency_id=$reliable->resiliency_id;
            $feed->save();
        });
    }
    //
}