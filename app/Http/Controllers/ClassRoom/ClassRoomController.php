<?php

namespace App\Http\Controllers\ClassRoom;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRooms\StoreClassesRequest;
use App\Interfaces\Class\ClassRoomRepositoryInterface;
use App\Models\ClassRoom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    private ClassRoomRepositoryInterface $classRoomRepository;
    public function __construct(ClassRoomRepositoryInterface $classRoomRepository)
    {
        $this->classRoomRepository = $classRoomRepository;
    }
    public function index( )
    {
        return $this->classRoomRepository->index();
    }

    public function store(StoreClassesRequest $request)
    {
        return $this->classRoomRepository->store($request);
    }

    public function update(ClassRoom $classRoom , Request $request)
    {
        return $this->classRoomRepository->update($classRoom ,$request);
    }

    public function destroy(ClassRoom $classRoom)
    {
        return $this->classRoomRepository->destroy($classRoom);
    }

    public function delete_all(Request $request)
    {
        return $this->classRoomRepository->delete_all($request);
    }

    public function filterClasses(Request $request)
    {
        return $this->classRoomRepository->filterClasses($request);
    }

}
