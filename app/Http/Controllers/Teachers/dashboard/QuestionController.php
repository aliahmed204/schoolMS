<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\teacherDashboard\question\questionRepositoryInterface;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected questionRepositoryInterface $questionRepository;

    public function __construct(questionRepositoryInterface $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function index($id)
    {
        return $this->questionRepository->index($id);
    }

    public function create($id)
    {
        return $this->questionRepository->create($id);
    }

    public function store(Request $request , $id)
    {
        return $this->questionRepository->store($request , $id);
    }

    public function edit(Question $question )
    {
        return $this->questionRepository->edit($question);
    }

    public function update(Question $question, Request $request)
    {
        return $this->questionRepository->update($question, $request);
    }

    public function destroy(Question $question)
    {
        return $this->questionRepository->destroy($question);
    }
}
