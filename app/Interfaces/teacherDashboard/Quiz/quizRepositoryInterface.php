<?php

namespace App\Interfaces\teacherDashboard\Quiz;


use App\Models\Quiz;
use App\Models\Student;


interface quizRepositoryInterface
{
    public function index();
    public function create();
    public function store($request);
    public function edit(Quiz $quiz);
    public function update(Quiz $quiz ,$request);
    public function destroy(Quiz $quiz);
    public function student_finished(Quiz $quiz);
    public function student_answers(Quiz $quiz ,Student $student);
}
