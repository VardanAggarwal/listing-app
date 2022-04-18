<?php

namespace App\Http\Livewire\E2E\Screens;

use Livewire\Component;
use App\Models\Trade;
use Illuminate\Support\Facades\Auth;
class SupplierList extends Component
{
    public Trade $trade;
    public $perPage=10;

    public function render()
    {
        $type=$this->trade->type=="sell"?"buy":"sell";
        $suppliers=Trade::selectRaw("distinct on(profile_id) *")->where("item_id",$this->trade->item_id)->where("type",$type)->where("profile_id","<>",Auth::user()->profile->id)->orderByDesc('profile_id')->orderByDesc('created_at')->cursorPaginate($this->perPage);
        return view('livewire.e2-e.screens.supplier-list',["suppliers"=>$suppliers])->layout('layouts.e2e');
    }
}
