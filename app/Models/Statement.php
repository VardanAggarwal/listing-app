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
    public function profile(){
        return $this->belongsTo(Profile::class);
    }
}
