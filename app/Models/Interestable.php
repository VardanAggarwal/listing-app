<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class Interestable extends MorphPivot
{
    protected $table = 'interestables';
    protected $casts = [
             'interest' => 'array',
         ];
}
