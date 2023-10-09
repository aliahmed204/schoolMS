<?php

namespace App\Interfaces;

use App\Models\ProcessingFee;


interface ProcessingFeeRepositoryInterface
{
    public function index();
    public function create($id);
    public function edit(ProcessingFee $processingFee);
    public function store($request);
    public function update(ProcessingFee $processingFee ,$request);
    public function destroy(ProcessingFee $processingFee);
}
