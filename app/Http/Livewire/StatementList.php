<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Statement;
class StatementList extends Component
{
    public $perPage = 10;
    public $loading=false;
    public $query='';
    protected $feed;

    public function loadMore()
       {
           $this->perPage += 10;
       }
    public function resetPage(){
        $this->reset('perPage');
    }   
    public function render()
    {   
        if($this->query){
        $this->feed=Statement::search($this->query)->paginate($this->perPage);
        }
        else{
            $this->feed=Statement::where('stateable_id',null)->orderByDesc('updated_at')->cursorPaginate($this->perPage);
        }
        return view('livewire.statement-list',['feed'=>$this->feed])->layout('layouts.guest');
    }
}
