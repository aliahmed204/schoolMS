<?php

namespace App\Repositories\onlineClass;

use App\Interfaces\onlineClass\OnlineClassRepositoryInterface;
use App\Models\Grade;
use App\Models\OnlineClass;
use Illuminate\Http\Request;

class OnlineClassRepository implements OnlineClassRepositoryInterface
{
    public function index()
    {
        $onlineClasses = OnlineClass::createdBy()->with('class','grade','section')->paginate();
        return view('pages.onlineClasses.index', compact('onlineClasses'));
    }

    public function create()
    {
        $grades = Grade::get();
        return view('pages.onlineClasses.create', compact('grades'));
    }

    public function store($request)
    {
        try {
            OnlineClass::create([
                'grade_id'   => $request->grade_id,
                'class_id' => $request->class_id,
                'section_id' => $request->section_id,
                'created_by' => auth()->user()->email,
                'meeting_id' => $request->meeting_id,
                'topic'      => $request->topic,
                'start_at'   => $request->start_at,
                'duration'   => $request->duration,
                'password'   => $request->password ?? '',
                'start_url'  => $request->start_url,
                'join_url'   => $request->join_url,
            ]);
            return redirect()->route('onlineClasses.index')->with(['success1' => trans('messages.success')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy(OnlineClass $onlineClass)
    {
        try {
            $onlineClass->delete();
            return redirect()->route('onlineClasses.index')->with(['deleted' => trans('messages.Delete')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
