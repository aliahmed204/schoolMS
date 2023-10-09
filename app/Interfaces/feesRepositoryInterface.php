<?php

namespace App\Interfaces;

use App\Models\Fee;

interface feesRepositoryInterface
{
    public function index();
    public function create();
    public function edit(Fee $fee);
    public function store($request);
    public function update(fee $fee,$request);
    public function destroy(Fee $fee);

}
