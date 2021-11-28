<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Reliable extends MorphPivot
{
    protected $table = 'reliables';
    protected static function booted(){
        static::saved(function($reliable){
            $feed= new Feed;
            $feed->event_data=$reliable->toJson();
            $feed->type='reliable';
            $feed->save();
        });
    }
    //
}
