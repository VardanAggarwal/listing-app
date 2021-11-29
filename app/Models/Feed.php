<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;


class Feed extends Model
{
    use HasFactory;
    use Prunable;

    public function prunable()
       {
           return static::where('created_at', '<', now());
       }

    public function resiliency(){
        return $this->belongsTo(Resiliency::class);
    }
    public function feedable(){
        return $this->morphTo();
    }
}
