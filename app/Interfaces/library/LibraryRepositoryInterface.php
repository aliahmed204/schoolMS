<?php

namespace App\Interfaces\library;

use App\Models\library;
use Illuminate\Http\Request;

interface LibraryRepositoryInterface
{
    public function index();
    public function create();

    public function store(Request $request);

    public function edit(library $library);

    public function update(Request $request, library $library);

    public function destroy(library $library);
    public function downloadAttachment($file_title , $file_name);
}
