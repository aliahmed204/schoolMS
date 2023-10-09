<?php

namespace App\Interfaces;

use App\Models\PaymentStudent;



interface PaymentStudentRepositoryInterface
{
    public function index();
    public function create($id);
    public function edit(PaymentStudent $paymentStudent);
    public function store($request);
    public function update(PaymentStudent $paymentStudent ,$request);
    public function destroy(PaymentStudent $paymentStudent);
}
