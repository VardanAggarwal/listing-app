<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Statement extends Model
{
    use HasFactory;
    use Searchable;
    protected $guarded=[];
    protected static function booted(){
        static::created(function($statement){
                $feed= new Feed;
                $feed->feedable_id=$statement->id;
                $feed->feedable_type="App\\Models\\Statement";
                $feed->save();
        });
        static::updated(function($statement){
            $feed= Feed::where('feedable_id',$statement->id)->where('feedable_type',"App\\Models\\Statement")->first();
            if($feed){
                $feed->touch();
            }
        });
    }
    public function profile(){
        return $this->belongsTo(Profile::class);
    }
    public function stateable()
        {
            return $this->morphTo();
        }
    public function statements()
        {
            return $this->morphMany(Statement::class, 'stateable');
        }
    public function interested_profiles(){
        return $this->morphToMany(Profile::class,'interestable')->using(Interestable::class)->withPivot('interest')->withTimestamps();
    }
    public function attached_categories(){
        return $this->morphedByMany(Category::class, 'attachable')->using(Attachable::class)->withPivot('attachement_type');
    }
    public function attached_listings(){
        return $this->morphedByMany(Listing::class, 'attachable')->using(Attachable::class)->withPivot('attachement_type');
    }
    public function attached_resiliencies(){
        return $this->morphedByMany(Resiliency::class, 'attachable')->using(Attachable::class)->withPivot('attachement_type');
    }
    public function attached_stories(){
        return $this->morphedByMany(Story::class, 'attachable')->using(Attachable::class)->withPivot('attachement_type');
    }
}
