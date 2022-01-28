<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
class Resiliency extends Model
{
    use HasFactory;
    use Searchable;
    protected $guarded=[];

    protected $casts = [
             'additional_info' => 'array',
         ];
    protected static function booted(){
        static::created(function($resiliency){
            $feed= new Feed;
            $feed->feedable_id=$resiliency->id;
            $feed->feedable_type="App\\Models\\Resiliency";
            $feed->save();
        });
        static::updated(function($resiliency){
            $feed= Feed::where('feedable_id',$resiliency->id)->where('feedable_type',"App\\Models\\Resiliency")->first();
            if($feed){
                $feed->touch();
            }
        });
    }


    public function categories(){
        return $this->morphedByMany(Category::class, 'reliable');
    }
    public function listings(){
        return $this->morphedByMany(Listing::class, 'reliable');
    }
    public function stories(){
        return $this->morphedByMany(Story::class, 'reliable');
    }
    public function interested_profiles(){
        return $this->morphToMany(Profile::class,'interestable')->using(Interestable::class)->withPivot('interest')->withTimestamps();
    }
    public function statements()
        {
            return $this->morphMany(Statement::class, 'stateable');
        }
    public function attached_to(){
        return $this->morphToMany(Statement::class,'attachable')->using(Attachable::class)->withPivot('attachement_type');
    }
    public function items(){
        return $this->hasMany(Item::class);
    }
    public function keyword()
        {
            return $this->morphOne(Keyword::class, 'taggable');
        }
    public function toSearchableArray()
       {
           $array = $this->toArray();
           $array['categories']=$this->categories;
           // Customize the data array...

           return $array;
       }
}
