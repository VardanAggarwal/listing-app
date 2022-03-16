<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function profile(){
        return $this->belongsTo(Profile::class);
    }

    public function item()
        {
            return $this->morphTo();
        }
}
