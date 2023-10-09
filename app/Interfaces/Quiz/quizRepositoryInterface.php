<?php

namespace App\Interfaces\Quiz;


use App\Models\Quiz;



interface quizRepositoryInterface
{
    public function index();
    public function create();
    public function store($request);
    public function edit(Quiz $quiz);
    public function update(Quiz $quiz ,$request);
    public function destroy(Quiz $quiz);
}
