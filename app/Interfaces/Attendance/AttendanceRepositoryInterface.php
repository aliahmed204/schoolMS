<?php

namespace App\Interfaces\Attendance;

interface AttendanceRepositoryInterface
{
    public function index();
    public function show($id);
    public function store($section_id ,$request);

}
