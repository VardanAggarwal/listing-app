<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Str;
use App\Models\Story;
use App\Models\Profile;
class StoryCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $model;
    public function __construct($model)
    {
        $this->model=$model;
        //
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.story-card');
    }
}
