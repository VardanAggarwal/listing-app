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

    public function resiliencies(){
        return $this->morphToMany(Resiliency::class,'reliable')->using(Reliable::class);
    }
    public function profile(){
        return $this->belongsTo(Profile::class);
    }
    public function interested_profiles(){
        return $this->morphToMany(Profile::class,'interestable')->using(Interestable::class)->withPivot('interest');
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
