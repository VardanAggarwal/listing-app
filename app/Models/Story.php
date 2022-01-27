<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Story extends Model
{
    use HasFactory;
    use Searchable;
    protected $guarded=[];

    protected static function booted(){
        static::created(function($story){
            $feed= new Feed;
            $feed->feedable_id=$story->id;
            $feed->feedable_type="App\\Models\\Story";
            $feed->save();
        });
        static::updated(function($story){
            $feed= Feed::where('feedable_id',$story->id)->where('feedable_type',"App\\Models\\Story")->first();
            if($feed){
                $feed->touch();
            }
        });
    }
    public function resiliencies(){
        return $this->morphToMany(Resiliency::class,'reliable')->using(Reliable::class);
    }
    public function profile(){
        return $this->belongsTo(Profile::class);
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
    public function toSearchableArray()
       {
           $array = $this->toArray();
           $array['resiliencies']=$this->resiliencies;
           $array['profile']=$this->profile;
           // Customize the data array...

           return $array;
       }
}
