<?php

namespace App\Interfaces\subjects;


use App\Models\Subject;


interface subjectRepositoryInterface
{
    public function index();
    public function create();
    public function store($request);
    public function edit(Subject $subject);
    public function update(Subject $subject ,$request);
    public function destroy(Subject $subject);
}
