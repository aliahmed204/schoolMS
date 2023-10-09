<?php

namespace App\Http\Controllers\question;

use App\Http\Controllers\Controller;
use App\Interfaces\question\questionRepositoryInterface;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected questionRepositoryInterface $questionRepository;

    public function __construct(questionRepositoryInterface $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function index()
    {
        return $this->questionRepository->index();
    }

    public function create()
    {
        return $this->questionRepository->create();
    }

    public function store(Request $request)
    {
        return $this->questionRepository->store($request);
    }

    public function edit(Question $question)
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
