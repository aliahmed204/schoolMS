<?php

namespace App\Http\Controllers\FeeInvoices;

use App\Http\Controllers\Controller;
use App\Http\Requests\Invoices\StoreFeesInvoicesRequest;
use App\Interfaces\invoiceFeesRepositoryInterface;
use App\Models\FeeInvoice;
use Illuminate\Http\Request;


class FeeInvoiceController extends Controller
{
    protected invoiceFeesRepositoryInterface $invoiceFeesRepository;
    public function __construct(invoiceFeesRepositoryInterface $invoiceFeesRepository){
        $this->invoiceFeesRepository = $invoiceFeesRepository;
    }

    public function index(){
        return $this->invoiceFeesRepository->index();
    }
    public function invoice_create($id)
    {
        return $this->invoiceFeesRepository->create($id) ;
    }
    public function store(StoreFeesInvoicesRequest $request)
    {

        return $this->invoiceFeesRepository->store($request) ;
    }

    public function edit(FeeInvoice $feeInvoice)
    {
        return $this->invoiceFeesRepository->edit($feeInvoice);
    }

    public function update( FeeInvoice $feeInvoice , Request $request)
    {
        return $this->invoiceFeesRepository->update($feeInvoice , $request);
    }

    public function destroy(FeeInvoice $feeInvoice)
    {
        return $this->invoiceFeesRepository->destroy($feeInvoice);
    }


}
