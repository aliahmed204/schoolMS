<?php

namespace App\Http\Controllers\students\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\OnlineClass\CreateMeetingRequest;
use App\Interfaces\onlineClass\OnlineClassRepositoryInterface;
use App\Models\Grade;
use App\Models\OnlineClass;
use Illuminate\Http\Request;

class OnlineClassController extends Controller
{

    public function index()
    {
        $onlineClasses = OnlineClass::where('grade_id', auth()->user()->grade_id)
            ->where('class_id', auth()->user()->class_id)
            ->where('section_id', auth()->user()->section_id)
            ->with('class','grade','section')
            ->paginate();
        return view('pages.students.dashboard.onlineClasses.index', compact('onlineClasses'));
    }

}
