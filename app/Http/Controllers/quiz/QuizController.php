<?php

namespace App\Http\Controllers\quiz;

use App\Http\Controllers\Controller;
use App\Interfaces\Quiz\quizRepositoryInterface;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    protected quizRepositoryInterface $quizRepository;

    public function __construct(quizRepositoryInterface $quizRepository)
    {
        $this->quizRepository = $quizRepository;
    }

    public function index()
    {
        return $this->quizRepository->index();
    }

    public function create()
    {
        return $this->quizRepository->create();
    }

    public function store(Request $request)
    {
        return $this->quizRepository->store($request);
    }

    public function edit(Quiz $quiz)
    {
        return $this->quizRepository->edit($quiz);
    }

    public function update(Quiz $quiz, Request $request)
    {
        return $this->quizRepository->update($quiz, $request);
    }

    public function destroy(Quiz $quiz)
    {
        return $this->quizRepository->destroy($quiz);
    }
}
