<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Str;
use App\Models\Statement;
class StatementCard extends Component
{
  public $model;
  public $parent_type;
  public function __construct($model)
  {
      $this->model=$model;
      $this->parent_type=Str::lower(Str::replace('App\\Models\\','', $model->stateable_type));
      //
  }
  public function render()
  {
      return view('components.statement-card');
  }
}