<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AjaxController extends Controller
{
    public function getClasses($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:grades,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid input'], 400);
        }
        return ClassRoom::where('grade_id', $id)->pluck('name','id');
    }

    public function getSections($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:class_rooms,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid input'], 400);
        }

        return Section::where('class_id', $id)->pluck('name','id');
    }
}
