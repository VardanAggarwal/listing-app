<?php

namespace App\Http\Livewire\Leads;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class Form extends Component
{
    public $resiliencies=[
        ['id'=>25,'image_url'=>'https://listing-app.s3.ap-south-1.amazonaws.com/user/listing/QTTbHQaD2ZnvXLZm1ApqPodFmZUDmYbAo66HfzBJ.jpg','name'=>'वर्मी-कम्पोस्ट के लिए केंचुए'],
        ['id'=>41,'image_url'=>'https://listing-app.s3.ap-south-1.amazonaws.com/user/listing/Rxl7RAPjaXog2Q5rA7ZjvRs7ZEdc5JACVbTPzTHg.jpg','name'=>'मशरुम के स्पॉन (बीज)'],
        ['id'=>46,'image_url'=>'https://listing-app.s3.ap-south-1.amazonaws.com/user/resiliency/7hpyfUWFEYNJSVLVZCijfncAYaWTwAl5prB0YISp.jpg','name'=>'सब्जियों के बीज'],
        ['id'=>1,'image_url'=>'https://app.seedsaversclub.com/storage/photos/R3kFCJkfnelKotxcl1VsbH5u3DeDtJTJ7eHHOndV.jpg','name'=>'औषधीय फसलों के बीज'],
        ['id'=>113,'image_url'=>'https://listing-app.s3.ap-south-1.amazonaws.com/user/listing/v12EP0Ujajte8raYv3PjM0c1ge9n1cw6YNiG2YEQ.jpg','name'=>'डेयरी फार्मिंग के लिए पशु'],
        ['id'=>115,'image_url'=>'https://listing-app.s3.ap-south-1.amazonaws.com/user/listing/MwW57hgyEd1fWcdBzB92rcj0fuMyzphvYCPty4mc.jpg','name'=>'बकरी'],
        ['id'=>33,'image_url'=>'https://listing-app.s3.ap-south-1.amazonaws.com/user/resiliency/tcxNLPwGmwUuSPnSoSXBr8TQZAsq0MmzHfe0zjpu.jpg','name'=>'फलों के बीज एवं पौधे'],
        ['id'=>43,'image_url'=>'https://listing-app.s3.ap-south-1.amazonaws.com/user/resiliency/H2Vtxa5lJRJxmvkOqzrd4YLYR0ldx8qBLIENttoE.jpg','name'=>'फूलों के बीज एवं पौधे'],
        ['id'=>50,'image_url'=>'https://listing-app.s3.ap-south-1.amazonaws.com/user/listing/qj1awRxklDubXFqzwBKYzCOihHJuGaPod2g66G0M.jpg','name'=>'मधुमक्खी पेटी'],
        ['id'=>114,'image_url'=>'https://listing-app.s3.ap-south-1.amazonaws.com/user/listing/jQsdBcH5A1lrorz5UyUCO7cYkI8RJlXZAqZ0puhD.jpg','name'=>'मुर्गी के चूजे'],
        ['id'=>116,'image_url'=>'https://listing-app.s3.ap-south-1.amazonaws.com/user/listing/rCto38NLV3aSNkus0kpJ5hRyDOetenhBPz9O6jB8.jpg','name'=>'मछली के बीज/स्पॉन/जीरा']
    ];
    public $selected=[];
    public $form=false;
    public $success=false;
    public $profile;
    public function mount(){
        $user=Auth::user();
        if($user){
            if($user->profile){
                $profile=$user->profile->contact_number?false:true;
            }else{
                $profile=true;
            }
        }else{
            $profile=true;
        }
        $this->profile=$profile;
    }
    public function submit(){
        $this->form=false;
        $this->success=true;
    }
    public function toggleSelected($item){
        if(in_array($item,$this->selected)){
            $this->selected=array_diff( $this->selected, [$item] );
        }else{
        array_push($this->selected,$item);
        }
    }
    public function render()
    {
        $resiliencies=collect($this->resiliencies);
        return view('livewire.leads.form',['resiliencies'=>$resiliencies])->layout('layouts.guest');
    }
}
