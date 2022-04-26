<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trade extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];
    protected $casts = [
             'additional_info' => AsCollection::class,
         ];
    protected $with = ['item'];
    protected static function booted(){
        static::created(function($trade){
            if(!$trade->expires_at){
                $trade->expires_at=now()->addDays(30);
                $trade->save();
            }
        });
        static::updated(function($trade){
            if(!$trade->expires_at){
                $trade->expires_at=now()->addDays(30);
                $trade->save();
            }
        });
    }
    public function item(){
        return $this->belongsTo(Item::class);
    }
    public function profile(){
        return $this->belongsTo(Profile::class);
    }
}
