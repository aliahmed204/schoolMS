<?php

namespace App\Http\Controllers\sections;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sectoins\StoreSectionRequest;
use App\Http\Requests\Sectoins\UpdateSectionRequest;
use App\Interfaces\Section\SectionRepositoryInterface;
use App\Models\ClassRoom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    private SectionRepositoryInterface $sectionRepository;
    public function __construct(SectionRepositoryInterface $sectionRepository)
    {
        $this->sectionRepository = $sectionRepository;
    }

    public function index()
    {
        return $this->sectionRepository->index();
    }

    public function store(StoreSectionRequest $request)
    {
        return $this->sectionRepository->store($request);
    }

    public function update(Section $section , UpdateSectionRequest $request)
    {
        return $this->sectionRepository->update($section ,$request);
    }

    public function destroy(Section $section)
    {
        return $this->sectionRepository->destroy($section);
    }

}



