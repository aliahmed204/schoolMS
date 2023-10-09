<?php

namespace App\Interfaces\Grade;

use App\Http\Requests\Grades\StoreGradesRequest;
use App\Http\Requests\Grades\UpdateGradesRequest;
use App\Models\Grade;

interface GradeRepositoryInterface
{
    public function index();

  public function store(StoreGradesRequest $request);

  public function update(Grade $grade , UpdateGradesRequest $request);

  public function destroy(Grade $grade);

}
