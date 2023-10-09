<?php

namespace App\Http\Controllers\library;

use App\Http\Controllers\Controller;
use App\Http\Requests\library\LibraryStoreRequest;
use App\Interfaces\library\LibraryRepositoryInterface;
use App\Models\library;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    protected LibraryRepositoryInterface $libraryRepository;

    public function __construct( LibraryRepositoryInterface $libraryRepository)
    {
        $this->libraryRepository = $libraryRepository;
    }

    public function index()
    {
        return $this->libraryRepository->index();
    }

    public function create()
    {
        return $this->libraryRepository->create();
    }

    public function store(LibraryStoreRequest $request)
    {
        return $this->libraryRepository->store( $request);
    }

    public function edit(library $library)
    {
        return $this->libraryRepository->edit($library);
    }

    public function update(LibraryStoreRequest $request, library $library)
    {
        return $this->libraryRepository->update($request,  $library);
    }

    public function destroy(library $library)
    {
        return $this->libraryRepository->destroy($library);
    }
    public function downloadAttachment($file_title , $file_name)
    {
        return $this->libraryRepository->downloadAttachment($file_title,$file_name);
    }

}
