<?php

namespace App\Http\traits;

use App\Models\Student;
use Illuminate\Support\Facades\Storage;

trait UploadFile
{
    private function UploadFile($file ,$path , $new_folder_name,$disk ='upload_attachments'){
        $file_name =  $file->getClientOriginalName();
        $file->storeAs($path.$new_folder_name, $file_name,$disk);
        return $file_name ;
    }
    private function DeleteFile($folder_name , $file_name , $path = Student::Path ,$disk ='upload_attachments' ){
        if (Storage::disk($disk)->exists($path.$folder_name.'/'.$file_name)) {
            Storage::disk($disk)->delete($path.$folder_name.'/'.$file_name);
        }
    }

}
