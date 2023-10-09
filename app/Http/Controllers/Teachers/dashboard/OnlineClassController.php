<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\OnlineClass\CreateMeetingRequest;

use App\Interfaces\teacherDashboard\onlineClass\OnlineClassRepositoryInterface;
use App\Models\OnlineClass;


class OnlineClassController extends Controller
{
    protected OnlineClassRepositoryInterface $onlineClassRepository;

    public function __construct(OnlineClassRepositoryInterface $onlineClassRepository){
        $this->onlineClassRepository = $onlineClassRepository;
    }
    public function index()
    {
        return $this->onlineClassRepository->index();
    }

    public function create()
    {
        return $this->onlineClassRepository->create();
    }

    public function store(CreateMeetingRequest $request)
    {
        return $this->onlineClassRepository->store($request);
    }

    public function destroy(OnlineClass $onlineClass)
    {
        return $this->onlineClassRepository->destroy($onlineClass);
    }
}
