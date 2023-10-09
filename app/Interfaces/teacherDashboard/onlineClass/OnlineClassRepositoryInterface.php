<?php

namespace App\Interfaces\teacherDashboard\onlineClass;

use App\Models\OnlineClass;
use Illuminate\Http\Request;

interface OnlineClassRepositoryInterface
{
    public function index();
    public function create();
    public function store(Request $request);
    public function destroy(OnlineClass $onlineClass);

}
