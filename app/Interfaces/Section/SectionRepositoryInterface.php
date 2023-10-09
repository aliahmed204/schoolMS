<?php

namespace App\Interfaces\Section;

use App\Http\Requests\Sectoins\StoreSectionRequest;
use App\Http\Requests\Sectoins\UpdateSectionRequest;
use App\Models\Section;

interface SectionRepositoryInterface
{
    public function index();

    public function store(StoreSectionRequest $request);

    public function update(Section $section , UpdateSectionRequest $request);

    public function destroy(Section $section);

}
