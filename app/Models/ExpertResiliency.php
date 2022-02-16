<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ExpertResiliency extends Pivot
{
    use HasFactory;
    protected $table = 'expert_resiliencies';
    protected $casts = [
             'data' => 'array',
         ];
}
