<?php

namespace App\Livewire;

use App\Models\BloodType;
use App\Models\Nationality;
use App\Models\ParentAttachments;
use App\Models\Religion;

use App\Models\StudentParent;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AddParent extends Component
{
    use WithFileUploads ,  WithPagination;
    #[Rule(['photos.*' => 'nullable|image|max:1024'])]
    public $photos = [] ;
    public $show_table = true ; // show student_parents in DB
    public $updateMode = false ; // for update process

    public $currentStep = 1 ;

    public $parent_id ,$Email, $Password,
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

    public $success , $update ,$catchError  = '';

    //real time validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'Email' => 'required|email',
            'Password' => 'required|string|min:8|max:25',

            'Father_National_ID' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Father_Passport_ID' => 'min:10|max:10',
            'Father_Phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',

            'Mother_National_ID' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Mother_Passport_ID' => 'min:10|max:10',
            'Mother_Phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);
    }

    public function render()
    {
        $Nationalities  = Nationality::get();
        $Type_Bloods = BloodType::get();
        $Religions   = Religion::get();
        $parents     = StudentParent::paginate(3);
        return view('livewire.add-parent' ,[

          'Nationalities'=> $Nationalities,
          'Type_Bloods'  => $Type_Bloods,
          'Religions'    => $Religions,
          'parents'    => $parents,

        ]);
    }

    /*
     *  Show Add Parent Form
     */
    public function addForm(){
        $this->show_table = false;
    }

    // first step [ father inputs ]
    public function firstStepSubmit(){
        $this->validate([
            'Email' => 'required|unique:student_parents,Email,',
            'Password' => 'required|string|min:8|max:25',
            'Father_Name' => 'required|string',
            'Father_Name_en' => 'required|string',
            'Father_Job' => 'required|string',
            'Father_Job_en' => 'required|string',
            'Father_National_ID' => 'required|string|min:10|max:10|regex:/[0-9]{9}/|unique:student_parents,Father_National_ID,',
            'Father_Passport_ID' => 'required|min:10|max:10|unique:student_parents,Father_Passport_ID,',
            'Father_Phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Father_Nationality' => 'required|string',
            'Father_Blood_Type' => 'required|string',
            'Father_Religion' => 'required|string',
            'Father_Address' => 'required|string',
        ]);
        // to move to next step should pass from validation
        $this->currentStep = 2 ;
    }

    public function secondStepSubmit(){
       $this->validate([
            'Mother_Name' => 'required|string',
            'Mother_Name_en' => 'required|string',
            'Mother_Job' => 'required|string',
            'Mother_Job_en' => 'required|string',
            'Mother_National_ID' => 'required|string|min:10|max:10|regex:/[0-9]{9}/|unique:student_parents,Mother_National_ID,',
            'Mother_Passport_ID' => 'required|min:10|max:10|unique:student_parents,Mother_Passport_ID,',
            'Mother_Phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Mother_Nationality' => 'required|string',
            'Mother_Blood_Type' => 'required|string',
            'Mother_Religion' => 'required|string',
            'Mother_Address' => 'required|string',
        ]);
        // to move to next step should pass from validation
        $this->currentStep = 3 ;
    }
    public function back($back){
        $this->currentStep = $back ;
    }
    public function submitForm()
    {
    try{
        // store at student_parents table
        $parent = StudentParent::create([
            'email' => $this->Email,
            'password' => Hash::make($this->Password),
            'Father_Name' => [
                'en' => $this->Father_Name_en,
                'ar' => $this->Father_Name
            ],
            'Father_job' => [
                'en' => $this->Father_Job_en,
                'ar' => $this->Father_Job
            ],
            'Father_National_ID' => $this->Father_National_ID,
            'Father_Passport_ID' => $this->Father_Passport_ID,
            'Father_Phone' => $this->Father_Phone,
            'Father_Address' => $this->Father_Address,
            'Father_Nationality' => $this->Father_Nationality,
            'Father_Blood_Type' => $this->Father_Blood_Type,
            'Father_Religion' => $this->Father_Religion,

            'Mother_Name' => [
                'en' => $this->Mother_Name_en,
                'ar' => $this->Mother_Name,
            ],
            'Mother_Job' => [
                'en' => $this->Mother_Job_en,
                'ar' => $this->Mother_Job
            ],
            'Mother_National_ID' => $this->Mother_National_ID,
            'Mother_Passport_ID' => $this->Mother_Passport_ID,
            'Mother_Phone' => $this->Mother_Phone,
            'Mother_Address' => $this->Mother_Address,
            'Mother_Nationality' => $this->Mother_Nationality,
            'Mother_Blood_Type' => $this->Mother_Blood_Type,
            'Mother_Religion' => $this->Mother_Religion,

        ]);
        // store at parent_attachments table
        if(!empty($this->photos)){
            foreach ($this->photos as $photo) {
                $photo_name = $this->StoreImage($photo , $this->Father_National_ID , 'parent_attachment');
                ParentAttachments::create([
                    'file_name' => $photo_name,
                    'parent_id' => $parent->id
                    ]);
            }
        }
        $this->success = trans('messages.success');
        $this->clearForm();
        $this->currentStep = 1;
    }catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        };
    }

    /*
     *   Edit Student_Parent Methods
     */
    public function edit(StudentParent $parent)
    {
        $this->show_table = false; // hide student_parents table and get edit form

        $this->updateMode = true;  // for validate edit form and move to next step

        $this->parent_id          = $parent->id;
        $this->Email              = $parent->Email;
        $this->Password           = $parent->Password;
        $this->Father_Name        = $parent->getTranslation('Father_Name', 'ar');
        $this->Father_Name_en     = $parent->getTranslation('Father_Name', 'en');
        $this->Father_National_ID = $parent->Father_National_ID;
        $this->Father_Passport_ID = $parent->Father_Passport_ID;
        $this->Father_Phone       = $parent->Father_Phone;
        $this->Father_Job         = $parent->getTranslation('Father_job', 'ar');
        $this->Father_Job_en      = $parent->getTranslation('Father_job', 'en');
        $this->Father_Nationality = $parent->Father_Nationality;
        $this->Father_Blood_Type  = $parent->Father_Blood_Type;
        $this->Father_Address     = $parent->Father_Address;
        $this->Father_Religion    = $parent->Father_Religion;

        $this->Mother_Name        = $parent->getTranslation('Mother_Name', 'ar');
        $this->Mother_Name_en     = $parent->getTranslation('Mother_Name', 'en');
        $this->Mother_National_ID = $parent->Mother_National_ID;
        $this->Mother_Passport_ID = $parent->Mother_Passport_ID;
        $this->Mother_Phone       = $parent->Mother_Phone;
        $this->Mother_Job         = $parent->getTranslation('Mother_Job', 'ar');
        $this->Mother_Job_en      = $parent->getTranslation('Mother_Job', 'en');
        $this->Mother_Nationality = $parent->Mother_Nationality;
        $this->Mother_Blood_Type  = $parent->Mother_Blood_Type;
        $this->Mother_Address     = $parent->Mother_Address;
        $this->Mother_Religion    = $parent->Mother_Religion;


    }

    public function firstStepSubmit_edit(){
        $this->validate([
            'Email' => 'required|unique:student_parents,Email,'.$this->parent_id,
            'Password' => 'nullable|string',
            'Father_Name' => 'required|string',
            'Father_Name_en' => 'required|string',
            'Father_Job' => 'required|string',
            'Father_Job_en' => 'required|string',
            'Father_National_ID' => 'required|string|min:10|max:10|regex:/[0-9]{9}/|unique:student_parents,Father_National_ID,'.$this->parent_id,
            'Father_Passport_ID' => 'required|min:10|max:10|unique:student_parents,Father_Passport_ID,'.$this->parent_id,
            'Father_Phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Father_Nationality' => 'required|numeric',
            'Father_Blood_Type' => 'required|numeric',
            'Father_Religion' => 'required|numeric',
            'Father_Address' => 'required|string',
        ]);
        // to move to next step should pass from validation
        $this->currentStep = 2 ;
    }

    public function secondStepSubmit_edit(){
        $this->validate([
            'Mother_Name' => 'required|string',
            'Mother_Name_en' => 'required|string',
            'Mother_Job' => 'required|string',
            'Mother_Job_en' => 'required|string',
            'Mother_National_ID' => 'required|string|min:10|max:10|regex:/[0-9]{9}/|unique:student_parents,Mother_National_ID,'.$this->parent_id,
            'Mother_Passport_ID' => 'required|min:10|max:10|unique:student_parents,Mother_Passport_ID,'.$this->parent_id,
            'Mother_Phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Mother_Nationality' => 'required|numeric',
            'Mother_Blood_Type' => 'required|numeric',
            'Mother_Religion' => 'required|numeric',
            'Mother_Address' => 'required|string',
        ]);
        // to move to next step should pass from validation
        $this->currentStep = 3 ;
    }

    public function submitForm_update()
    {
        $parent = StudentParent::FindOrFail($this->parent_id);
        try{
            // store at student_parents table
            $parent->update([
                'Email' => $this->Email,
                'Password' => Hash::make($this->Password) ?? $parent->Password,
                'Father_Name' => [
                    'en' => $this->Father_Name_en,
                    'ar' => $this->Father_Name
                ],
                'Father_job' => [
                    'en' => $this->Father_Job_en,
                    'ar' => $this->Father_Job
                ],
                'Father_National_ID' => $this->Father_National_ID,
                'Father_Passport_ID' => $this->Father_Passport_ID,
                'Father_Phone' => $this->Father_Phone,
                'Father_Address' => $this->Father_Address,
                'Father_Nationality' => $this->Father_Nationality,
                'Father_Blood_Type' => $this->Father_Blood_Type,
                'Father_Religion' => $this->Father_Religion,

                'Mother_Name' => [
                    'en' => $this->Mother_Name_en,
                    'ar' => $this->Mother_Name,
                ],
                'Mother_Job' => [
                    'en' => $this->Mother_Job_en,
                    'ar' => $this->Mother_Job
                ],
                'Mother_National_ID' => $this->Mother_National_ID,
                'Mother_Passport_ID' => $this->Mother_Passport_ID,
                'Mother_Phone' => $this->Mother_Phone,
                'Mother_Address' => $this->Mother_Address,
                'Mother_Nationality' => $this->Mother_Nationality,
                'Mother_Blood_Type' => $this->Mother_Blood_Type,
                'Mother_Religion' => $this->Mother_Religion,

            ]);
            // store at parent_attachments table
            if(!empty($this->photos)){
                foreach ($this->photos as $photo) {
                    $photo_name = $this->StoreImage($photo , $this->Father_National_ID , 'parent_attachment');
                    ParentAttachments::create([
                        'file_name' => $photo_name,
                        'parent_id' => $this->parent_id
                    ]);
                }
            }
            $this->update = trans('messages.Update');
            $this->clearForm();
            $this->currentStep = 1;
            $this->show_table = true;
        }catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        };
    }

    /*
     *   Destroy Student_Parent Methods
     */
    public function destroy(StudentParent $parent){
        $attach = ParentAttachments::where('parent_id',$parent->id)->first();
        if($attach->count() > 0){
            if (Storage::disk('parent_attachment')->exists($parent->Father_National_ID)) {
                Storage::disk('parent_attachment')->deleteDirectory($parent->Father_National_ID);
            }
        }
        $parent->delete() ;
        return to_route('AddParent_Form')->with(['deleted'=>trans('messages.Delete')]);
    }



    private function StoreImage($photo , $directory , $disk){
        $photo_name = time().$photo->getClientOriginalName();
        $photo->storeAs($directory,$photo_name,$disk);
        return $photo_name;
    }
    private function clearForm()
    {
        $initialValues = [
            'Email',
            'Password',
            'Father_Name',
            'Father_Name_en',
            'Father_National_ID',
            'Father_Passport_ID',
            'Father_Phone',
            'Father_Job',
            'Father_Job_en',
            'Father_Nationality',
            'Father_Blood_Type',
            'Father_Address',
            'Father_Religion',
            'Mother_Name',
            'Mother_Name_en',
            'Mother_National_ID',
            'Mother_Passport_ID',
            'Mother_Phone',
            'Mother_Job',
            'Mother_Job_en',
            'Mother_Nationality',
            'Mother_Blood_Type',
            'Mother_Address',
            'Mother_Religion'
        ];
        foreach ($initialValues as $property) {
            $this->$property = '';
        }
    }
}
