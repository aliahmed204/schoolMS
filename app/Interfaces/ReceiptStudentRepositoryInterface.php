<?php

namespace App\Interfaces;

use App\Models\ReceiptStudent;

interface ReceiptStudentRepositoryInterface
{
    public function index();
    public function create($id);
    public function edit(ReceiptStudent $receiptStudent);
    public function update(ReceiptStudent $receiptStudent ,$request);
    public function destroy(ReceiptStudent $receiptStudent);


}
