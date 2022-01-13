<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\Statement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class PostStatement extends Component
{
    use WithFileUploads;
    public $saved=false;
    public $form=true;
    public $statement="";
    public $media=[];
    public $selected=[];
    public $parent;
    protected $listeners = ['updateSelected'];
    protected $rules=[
        'statement'=>'string|required'
    ];
    public function updateSelected($selected){
        $this->selected=$selected;
    }
    public function removeFile($index){
        $this->media=array_diff( $this->media, [$this->media[$index]] );
    }
    public function resetForm(){
        $this->resetErrorBag();
        $this->form=true;
        $this->statement="";
        $this->selected=[];
        $this->media=[];
        if(Auth::guest()){
            return redirect()->guest('login')->with('status', 'Please login to perform this action');
        }
    }
    public function save_statement(){
        if(Auth::user()){
            $this->validate();
            $statement=New Statement;
            $statement->statement=$this->statement;
            $statement->profile()->associate(Auth::user()->profile);
            $media=collect([]);
            $img=null;
            foreach ($this->media as $file) {
                $image=Validator::make(['file'=>$file],['file' => 'image|max:1024'])->passes();
                $video=Validator::make(['file'=>$file],['file' => 'mimetypes:video/avi,video/mp4,video/3gpp,video/3gpp2,video/ogg,video/webm,video/x-msvideo,video/mpeg,video/quicktime|max:10240'])->passes();
                $pdf=Validator::make(['file'=>$file],['file' => 'mimetypes:application/pdf|max:10240'])->passes();
                $audio=Validator::make(['file'=>$file],['file' => 'mimetypes:application/octet-stream,audio/ogg,audio/mp4,audio/mpeg,audio/basic,audio/webm,audio/x-aac,audio/x-wav|max:10240'])->passes();
                if($image||$video||$pdf||$audio){
                $url=Storage::url($file->storePublicly('user/statement','s3'));
                $media->push($url);
                }else{
                    $this->addError('media', __('One of the files is too large or invalid. Just add photo, audio, video or pdf'));
                    return;
                }
                if($image && !$img){
                    $img=$url;
                }
            }
            $statement->media=trim($media->reduce(function($string,$url){
                return $string.",".$url;
            },""),',');
            if($this->parent){
                $statement->stateable()->associate($this->parent);
            }
            $statement->image=$img;
            $statement->save();
            $statement->attached_resiliencies()->sync($this->selected);
            $this->saved=true;
            $this->form=false;
            $this->emit('refreshStatement');
            $this->statement="";
            $this->selected=[];
            $this->media=[];

        }else{
            return redirect()->guest('login')->with('status', 'Please login to perform this action');
        }
    }
    public function render()
    {
        return view('livewire.post-statement');
    }
}
