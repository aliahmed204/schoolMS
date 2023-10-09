<?php

namespace App\Interfaces\Class;

use App\Http\Requests\ClassRooms\StoreClassesRequest;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

interface ClassRoomRepositoryInterface
{
    public function index();

    public function store(StoreClassesRequest $request);

    public function update(ClassRoom $classRoom , Request $request);

    public function destroy(ClassRoom $classRoom);

    public function delete_all(Request $request);

    public function filterClasses(Request $request);

}
