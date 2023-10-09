<?php

namespace App\Interfaces\question;


use App\Models\Question;




interface questionRepositoryInterface
{
    public function index();
    public function create();
    public function store($request);
    public function edit(Question $question);
    public function update(Question $question ,$request);
    public function destroy(Question $question);
}
