<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Http\traits\UploadFile;
use App\Models\Setting;
use Illuminate\Http\Request;


class SettingController extends Controller
{
    use UploadFile;
    public function index(){
        $collection = Setting::get();

        $setting = $collection->flatMap(function ($collection){
            return [ $collection->key => $collection->value];
        });
        /*foreach (array_keys($setting->toArray()) as $key){
            $keies [] = $key;
        }*/
       return view('pages.setting.index',compact('setting' ));

    }

    public function update(Request $request){
        $settings = $request->except('_token','_method','logo');

        try{
            if($request->hasFile('logo')){
                $logo = Setting::select('value')->where('key','logo')->first();
                $old_logo = $logo->value;
                $this->DeleteFile('setting',$old_logo,'attachments/');
                $file_name = $this->UploadFile($request->file('logo'), 'attachments/','setting' );
                Setting::where('key','logo')->update(['value' =>  $file_name]);
            }
            foreach($settings as $key=> $value){
             Setting::where('key',$key)->update(['value' =>  $value]);
            }
             return redirect()->route('settings.index')->with(['updated' => trans('messages.success')]);
        }catch (\Exception $e){
            return back()->with(['error' => $e->getMessage()]);
        }
    }



}
