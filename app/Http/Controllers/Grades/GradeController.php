<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Requests\Grades\StoreGradesRequest;
use App\Http\Requests\Grades\UpdateGradesRequest;
use App\Interfaces\Grade\GradeRepositoryInterface;
use App\Models\ClassRoom;
use App\Models\Grade;
use Illuminate\Http\Request;


class GradeController extends Controller
{
    private GradeRepositoryInterface $gradeRepository;
    public function __construct(GradeRepositoryInterface $gradeRepository)
    {
        $this->gradeRepository = $gradeRepository;
    }

  public function index()
  {
      return $this->gradeRepository->index();
  }

  public function store(StoreGradesRequest $request)
  {
      return $this->gradeRepository->store( $request);
  }

  public function update(Grade $grade , UpdateGradesRequest $request)
  {
      return $this->gradeRepository->update( $grade, $request);
  }

  public function destroy(Grade $grade)
  {
      return $this->gradeRepository->destroy($grade);
  }



}

