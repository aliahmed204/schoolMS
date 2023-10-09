<?php

namespace App\Http\Controllers\subject;

use App\Http\Controllers\Controller;
use App\Http\Requests\subject\SubjectRequest;
use App\Interfaces\subjects\subjectRepositoryInterface;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected subjectRepositoryInterface $subjectRepository;

    public function __construct(subjectRepositoryInterface $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function index()
    {
        return $this->subjectRepository->index();
    }

    public function create()
    {
        return $this->subjectRepository->create();
    }

    public function store(SubjectRequest $request)
    {
        return $this->subjectRepository->store($request);
    }

    public function edit(Subject $subject)
    {
        return $this->subjectRepository->edit($subject);
    }

    public function update(Subject $subject, SubjectRequest $request)
    {
        return $this->subjectRepository->update($subject, $request);
    }

    public function destroy(Subject $subject)
    {
        return $this->subjectRepository->destroy($subject);
    }
}
