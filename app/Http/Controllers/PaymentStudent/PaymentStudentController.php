<?php

namespace App\Http\Controllers\PaymentStudent;

use App\Http\Controllers\Controller;
use App\Interfaces\PaymentStudentRepositoryInterface;
use App\Models\PaymentStudent;
use Illuminate\Http\Request;

class PaymentStudentController extends Controller
{
    protected PaymentStudentRepositoryInterface $paymentStudentRepository;
    public function __construct(PaymentStudentRepositoryInterface $paymentStudentRepository){
        $this->paymentStudentRepository = $paymentStudentRepository;
    }
    public function index()
    {
        return $this->paymentStudentRepository->index();
    }

    public function create($id)
    {
        return $this->paymentStudentRepository->create($id);
    }

    public function store(Request $request)
    {
        return $this->paymentStudentRepository->store($request);
    }

    public function edit(PaymentStudent $paymentStudent)
    {
        return $this->paymentStudentRepository->edit($paymentStudent);
    }

    public function update(PaymentStudent $paymentStudent , Request $request)
    {
        return $this->paymentStudentRepository->update($paymentStudent ,$request);
    }

    public function destroy(PaymentStudent $paymentStudent)
    {
        return $this->paymentStudentRepository->destroy($paymentStudent);
    }
}
