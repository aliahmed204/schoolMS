<?php

namespace App\Http\Controllers\ProcessingFee;

use App\Http\Controllers\Controller;
use App\Interfaces\ProcessingFeeRepositoryInterface;
use App\Models\ProcessingFee;
use Illuminate\Http\Request;

class ProcessingFeeController extends Controller
{
    protected ProcessingFeeRepositoryInterface $processingFeeRepository;
    public function __construct(ProcessingFeeRepositoryInterface $processingFeeRepository){
        $this->processingFeeRepository = $processingFeeRepository;
    }
    public function index()
    {
        return $this->processingFeeRepository->index();
    }

    public function create($id)
    {
        return $this->processingFeeRepository->create($id);
    }

    public function store(Request $request)
    {
        return $this->processingFeeRepository->store($request);
    }

    public function edit(ProcessingFee $processingFee)
    {
        return $this->processingFeeRepository->edit($processingFee);
    }

    public function update(ProcessingFee $processingFee , Request $request)
    {
        return $this->processingFeeRepository->update($processingFee ,$request);
    }

    public function destroy(ProcessingFee $processingFee)
    {
        return $this->processingFeeRepository->destroy($processingFee);
    }
}
