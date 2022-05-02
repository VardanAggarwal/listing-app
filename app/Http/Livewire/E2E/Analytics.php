<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;
use App\Models;
class Analytics extends Component
{
    public function render()
    {
        $trades=Models\Trade::selectRaw('item_id, count(distinct(profile_id)), min(price),max(price),sum(quantity::DECIMAL), max(id) as id')->where('created_at','>=',now()->subDays(30))->groupBy('item_id')->orderByRaw('count(distinct(profile_id)) DESC')->get();
        return view('livewire.e2-e.analytics',['trades'=>$trades])->layout('layouts.e2e');
    }
}
