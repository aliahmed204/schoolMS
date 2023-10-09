<?php

namespace App\Http\Controllers\Receipt;

use App\Http\Controllers\Controller;
use App\Http\Requests\receipt\ManageReceiptRequest;
use App\Http\Requests\receipt\UpdateReceiptRequest;
use App\Interfaces\ReceiptStudentRepositoryInterface;
use App\Models\ReceiptStudent;
use App\Models\Student;
use Illuminate\Http\Request;

class ReceiptStudentController extends Controller
{
    protected ReceiptStudentRepositoryInterface $receiptStudentRepository;
    public function __construct(ReceiptStudentRepositoryInterface $receiptStudentRepository){
        $this->receiptStudentRepository = $receiptStudentRepository;
    }
    public function index()
    {
        return $this->receiptStudentRepository->index();
    }

    public function create($id)
    {
        return $this->receiptStudentRepository->create($id);
    }

    public function store(ManageReceiptRequest $request)
    {
        return $this->receiptStudentRepository->store($request);
    }

    public function edit(ReceiptStudent $receiptStudent)
    {
        return $this->receiptStudentRepository->edit($receiptStudent);
    }

    public function update(ReceiptStudent $receiptStudent , ManageReceiptRequest $request)
    {
        return $this->receiptStudentRepository->update($receiptStudent ,$request);
    }

    public function destroy(ReceiptStudent $receiptStudent)
    {
        return $this->receiptStudentRepository->destroy($receiptStudent);
    }
}
