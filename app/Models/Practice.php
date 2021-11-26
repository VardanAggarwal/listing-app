<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function resiliency(){
        return $this->morphOne(Resiliency::class,'resilient');
    }
}
