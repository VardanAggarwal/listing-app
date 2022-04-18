<?php

namespace App\Http\Livewire\E2E\Screens;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models;
use Illuminate\Support\Facades\Validator;
class BidForm extends Component
{
    use WithFileUploads;
    public Models\Trade $trade;
    public $data;
    public $media;
    public $old_media;
    protected $rules=[
        'trade.price'=>'numeric|nullable',
        'trade.quantity'=>'numeric|nullable',
        'trade.description'=>'string|nullable',
        'trade.additional_info.location'=>'string|nullable|sometimes',
        'trade.additional_info.details'=>'string|nullable|sometimes'
    ];
    public function mount(){
        if($this->trade->media){
            $this->old_media=explode(',',$this->trade->media);
        }
    }
    public function removeFile($index){
        $this->media=array_diff( $this->media, [$this->media[$index]] );
    }
    public function removeMedia($index){
        $this->old_media=array_diff( $this->old_media, [$this->old_media[$index]] );
    }
    public function save(){
        $this->validate();
        $media=collect([]);
        if($this->media){
            $img=null;
            foreach ($this->media as $file) {
                $image=Validator::make(['file'=>$file],['file' => 'image|max:10240'])->passes();
                $video=Validator::make(['file'=>$file],['file' => 'mimetypes:video/avi,video/mp4,video/3gpp,video/3gpp2,video/ogg,video/webm,video/x-msvideo,video/mpeg,video/quicktime|max:10240'])->passes();
                $pdf=Validator::make(['file'=>$file],['file' => 'mimetypes:application/pdf|max:10240'])->passes();
                $audio=Validator::make(['file'=>$file],['file' => 'mimetypes:application/octet-stream,audio/ogg,audio/mp4,audio/mpeg,audio/basic,audio/webm,audio/x-aac,audio/x-wav|max:10240'])->passes();
                if($image||$video||$pdf||$audio){
                $url=Storage::url($file->storePublicly('user/trade','s3'));
                $media->push($url);
                }else{
                    $this->addError('media', __('e2e.bid-form.media.error'));
                    return;
                }
                if($image && !$img){
                    $img=$url;
                }
            }
            $this->trade->media=trim($media->reduce(function($string,$url){
                return $string.",".$url;
            },""),',').','.implode(',',$this->old_media);
            $this->trade->additional_info->image_url=$img;
        }
        $this->trade->save();
    }
    public function render()
    {
        return view('livewire.e2-e.screens.bid-form')->layout('layouts.e2e');
    }
}
