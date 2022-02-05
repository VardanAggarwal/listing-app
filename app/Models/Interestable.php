<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Interestable extends MorphPivot
{
    protected $table = 'interestables';
    protected $casts = [
             'interest' => 'array',
         ];
    public function interestable(){
        return $this->morphTo();
    }
}
