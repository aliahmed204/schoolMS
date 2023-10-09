<?php

namespace App\Http\Controllers\Fee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fee\FeeRequest;
use App\Http\Requests\Fee\UpdateFeeRequest;
use App\Interfaces\feesRepositoryInterface;
use App\Models\Fee;
use Illuminate\Http\Request;

class FeeController extends Controller
{
   public feesRepositoryInterface $feesRepository;

   public function __construct(feesRepositoryInterface $feesRepository)
   {
       return $this->feesRepository = $feesRepository;
   }
    public function index()
    {
        return $this->feesRepository->index();
    }

    public function create()
    {
        return $this->feesRepository->create();
    }
    public function store(FeeRequest $request)
    {
        return $this->feesRepository->store($request);
    }

    public function edit(Fee $fee)
    {
        return $this->feesRepository->edit($fee);
    }

    public function update( Fee $fee , UpdateFeeRequest $request)
    {
        return $this->feesRepository->update($fee , $request);
    }

    public function destroy(Fee $fee)
    {
        return $this->feesRepository->destroy($fee);
    }
}
