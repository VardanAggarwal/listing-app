<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\AsCollection;
class Profile extends Model
{
    use HasFactory;
    use Searchable;
    use Notifiable;
    protected $guarded=[];
    protected $with = ['user'];
    protected $casts = [
             'additional_info' => AsCollection::class,
         ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function listings(){
        return $this->hasMany(Listing::class);
    }
    public function stories(){
        return $this->hasMany(Story::class);
    }
    public function statements(){
        return $this->hasMany(Statement::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function trades(){
        return $this->hasMany(Trade::class);
    }
    public function interest_categories(){
        return $this->morphedByMany(Category::class, 'interestable')->using(Interestable::class)->withPivot('interest')->withTimestamps();
    }
    public function interest_resiliencies(){
        return $this->morphedByMany(Resiliency::class,'interestable')->using(Interestable::class)->withPivot('interest')->withTimestamps();
    }
    public function expert_resiliencies(){
        return $this->belongsToMany(Resiliency::class,'expert_resiliencies')->using(ExpertResiliency::class)->withPivot('data')->withTimestamps();
    }
    public function interest_listings(){
        return $this->morphedByMany(Listing::class, 'interestable')->using(Interestable::class)->withPivot('interest')->withTimestamps();
    }
    public function interest_stories(){
        return $this->morphedByMany(Story::class, 'interestable')->using(Interestable::class)->withPivot('interest')->withTimestamps();
    }
    public function interest_statements(){
        return $this->morphedByMany(Statement::class, 'interestable')->using(Interestable::class)->withPivot('interest')->withTimestamps();
    }
    public function interest_items(){
        return $this->morphedByMany(Item::class, 'interestable')->using(Interestable::class)->withPivot('interest')->withTimestamps();   
    }
    public function interest_profiles(){
        return $this->morphedByMany(Profile::class, 'interestable')->using(Interestable::class)->withPivot('interest')->withTimestamps();
    }
    public function interested_profiles(){
        return $this->morphToMany(Profile::class,'interestable')->using(Interestable::class)->withTimestamps();
    }
    public function routeNotificationForFcm()
        {
            return $this->fcmtoken;
        }
}
