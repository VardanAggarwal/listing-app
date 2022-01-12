<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function resiliencies(){
        return $this->belongsToMany(Resiliency::class);
    }
    public function keyword()
        {
            return $this->morphOne(Keyword::class, 'taggable');
        }
}
