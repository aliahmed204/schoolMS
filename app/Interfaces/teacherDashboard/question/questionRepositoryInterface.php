<?php

namespace App\Interfaces\teacherDashboard\question;
use App\Models\Question;
interface questionRepositoryInterface
{
    public function index($id);
    public function create($id);
    public function store($request , $id);
    public function edit(Question $question);
    public function update(Question $question ,$request);
    public function destroy(Question $question);
}
