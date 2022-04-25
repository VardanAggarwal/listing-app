<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    use Searchable;
    protected $guarded=[];
    protected $casts = [
             'additional_info' => AsCollection::class,
         ];
    protected static function booted(){
        static::created(function($item){
            if(!$item->image_url){
                $item->image_url="https://via.placeholder.com/300x200.jpg/".dechex(mt_rand(0, 0xFFFFFF))."?text=".urlencode($item->name);
                $item->save();
            }
        });
        static::updated(function($item){
            if(!$item->image_url){
                $item->image_url="https://via.placeholder.com/300x200.jpg/".dechex(mt_rand(0, 0xFFFFFF))."?text=".urlencode($item->name);
                $item->save();
            }
        });
    }
    public function resiliencies(){
        return $this->morphToMany(Resiliency::class,'reliable')->using(Reliable::class);
    }
    public function keyword()
        {
            return $this->morphOne(Keyword::class, 'taggable');
        }
    public function trades(){
        return $this->hasMany(Trade::class);
    }
    public function interested_profiles(){
        return $this->morphToMany(Profile::class,'interestable')->using(Interestable::class)->withPivot('interest')->withTimestamps();
    }
}
