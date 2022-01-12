<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
class Category extends Model
{
    use HasFactory;
    use Searchable;
    protected $guarded=[];

    public function resiliencies(){
        return $this->morphToMany(Resiliency::class,'reliable');
    }
    public function statements()
        {
            return $this->morphMany(Statement::class, 'stateable');
        }
    public function interested_profiles(){
        return $this->morphToMany(Profile::class,'interestable')->using(Interestable::class)->withPivot('interest');
    }
    public function attached_to(){
        return $this->morphToMany(Statement::class,'attachable')->using(Attachable::class)->withPivot('attachement_type');
    }
    public function keyword()
        {
            return $this->morphOne(Keyword::class, 'taggable');
        }
}
