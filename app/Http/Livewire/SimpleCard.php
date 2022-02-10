<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
class SimpleCard extends Component
{
    public $model;
    public $type;
    public $url;
    public $title;
    public $subtitle;
    public $index;
    public $group_index;
    public $image;
    public function mount($model,$type){
        $this->model=$model;
        switch($type){
            case 'Resiliency':
                $this->title=$model->name;
                $this->subtitle=$model->description;
                $this->image=$model->image_url;
            break;
            case 'Story':
                $this->title=$model->title;
                $this->subtitle=$model->review;
                if($model->image_url){
                    $this->image=$model->image_url;    
                }elseif(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $model->review, $match)){
                    $youtube_id = $match[1];
                    if(ctype_alnum($youtube_id)){
                        $this->image="https://img.youtube.com/vi_webp/".$youtube_id."/0.webp";
                    }
                }elseif($image_parent=$model->resiliencies->firstWhere('image_url','<>',null)){
                    $this->image=$image_parent->image_url;
                }
            break;
            case 'Listing':
                $this->title=$model->name;
                $this->subtitle=$model->description;
                if($model->image_url){
                    $this->image=$model->image_url;    
                }elseif(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $model->description, $match)){
                    $youtube_id = $match[1];
                    if(ctype_alnum($youtube_id)){
                        $this->image="https://img.youtube.com/vi_webp/".$youtube_id."/0.webp";
                    }
                }elseif($image_parent=$model->resiliencies->firstWhere('image_url','<>',null)){
                    $this->image=$image_parent->image_url;
                }
            break;
            case 'Statement':
                $this->subtitle=$model->statement;
                $this->image=$model->image;
            break;
            default:
        }
        $this->subtitle=Str::limit(Str::replace('&nbsp;','',strip_tags($this->subtitle)),500);
        $this->url="/".Str::lower(Str::plural($type))."/".$model->id;

    }
    public function render()
    {
        return view('livewire.simple-card');
    }
}
