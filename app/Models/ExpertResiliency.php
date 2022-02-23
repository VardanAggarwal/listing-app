<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ExpertResiliency extends Pivot
{
    use HasFactory;
    protected $table = 'expert_resiliencies';
    protected $casts = [
             'data' => 'array',
         ];
    protected static function booted(){
        static::updated(function($item){
            Profile::find($item->profile_id)->searchable();
        });
    }
}
