<div class="modal fade" id="Delete_Fee_invoice{{$invoice->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel"> {{trans('invoice.Delete_invoice')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('feeInvoices.destroy',['feeInvoice'=>$invoice->id])}}" method="post">
                    @csrf
                    @method('delete')
                    <h5 style="font-family: 'Cairo', sans-serif;">{{trans('invoice.Warning')}}</h5>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('invoice.Close')}}</button>
                        <button  class="btn btn-danger">{{trans('invoice.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
