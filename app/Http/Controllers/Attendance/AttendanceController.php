<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Interfaces\Attendance\AttendanceRepositoryInterface;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    protected AttendanceRepositoryInterface $attendanceRepository;

    public function __construct(AttendanceRepositoryInterface $attendanceRepository)
    {
        $this->attendanceRepository = $attendanceRepository;
    }

    public function index()
    {
        return $this->attendanceRepository->index();
    }

    public function store(Request $request , $section_id)
    {
        return $this->attendanceRepository->store($section_id, $request);
    }

    public function show($id)
    {
        return $this->attendanceRepository->show($id);
    }

}
