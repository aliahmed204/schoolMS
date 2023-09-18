<?php

namespace App\Livewire;

use App\Models\BloodType;
use App\Models\Nationality;
use App\Models\Religion;
use Livewire\Component;

class AddParent extends Component
{
    public $currentStep = 1 ,

        $Email, $Password,
        // Father_INPUTS
        $Father_Name, $Father_Name_en,
        $Father_National_ID, $Father_Passport_ID,
        $Father_Phone, $Father_Job, $Father_Job_en,
        $Father_Nationality, $Father_Blood_Type,
        $Father_Address, $Father_Religion,

        // Mother_INPUTS
        $Mother_Name, $Mother_Name_en,
        $Mother_National_ID, $Mother_Passport_ID,
        $Mother_Phone, $Mother_Job, $Mother_Job_en,
        $Mother_Nationality, $Mother_Blood_Type,
        $Mother_Address, $Mother_Religion ;



    public function render()
    {
        $Nationalities  = Nationality::get();
        $Type_Bloods = BloodType::get();
        $Religions = Religion::get();
        return view('livewire.add-parent' ,[

          'Nationalities'=> $Nationalities,
          'Type_Bloods'  => $Type_Bloods,
          'Religions'    => $Religions,

        ]);
    }

    public function firstStepSubmit(){
        $this->currentStep = 2 ;
    }

    public function secondStepSubmit(){
        $this->currentStep = 3 ;
    }
    public function back($back){
        $this->currentStep = $back ;
    }
}
