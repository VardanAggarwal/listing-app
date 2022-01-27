<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Attachable extends MorphPivot
{
  protected $table = 'attachables';
}
