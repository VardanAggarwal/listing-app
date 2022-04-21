<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsCollection;


class Trade extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $casts = [
             'additional_info' => AsCollection::class,
         ];
    protected $with = ['item'];
    public function item(){
        return $this->belongsTo(Item::class);
    }
    public function profile(){
        return $this->belongsTo(Profile::class);
    }
}
