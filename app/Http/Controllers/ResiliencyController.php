<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crop;
use App\Models\Resiliency;
use App\Models\Practice;
use App\Models\Agrimodel;

class ResiliencyController extends Controller
{
    public function showCrop(Crop $crop){
        $resiliency=$crop->resiliency;
        $resiliency->loadCount(['listings','stories','agriservices']);
        return view('resiliency',['resiliency'=>$resiliency],);
    }
    public function showPractice(Practice $practice){
        $resiliency=$practice->resiliency;
        $resiliency->loadCount(['listings','stories','agriservices']);
        return view('resiliency',['resiliency'=>$resiliency],);
    }
    public function showAgrimodel(Agrimodel $agrimodel){
        $resiliency=$agrimodel->resiliency;
        $resiliency->loadCount(['listings','stories','agriservices']);
        return view('resiliency',['resiliency'=>$resiliency],);
    }
    //
}
