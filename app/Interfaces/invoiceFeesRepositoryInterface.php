<?php

namespace App\Interfaces;

use App\Models\Fee;
use App\Models\FeeInvoice;

interface invoiceFeesRepositoryInterface
{
    public function index();
    public function create($id);
    public function edit(FeeInvoice $feeInvoice);
    public function update(FeeInvoice $feeInvoice , $request);
    public function destroy(FeeInvoice $feeInvoice );


}
