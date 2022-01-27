<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Str;
use App\Models\Statement;
class StatementCard extends Component
{
  public $model;
  public $parent_type;
  public $index;
  public function __construct($model,$index)
  {
      $this->index=$index;
      $this->model=$model;
      $this->parent_type=Str::lower(Str::replace('App\\Models\\','', $model->stateable_type));
      //
  }
  public function render()
  {
      return view('components.statement-card');
  }
}