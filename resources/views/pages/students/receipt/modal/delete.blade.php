<div class="modal fade" id="Delete_receipt{{$receipt->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel"> {{trans('receipt.Delete')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('receiptStudents.destroy',['receiptStudent'=>$receipt->id])}}" method="post">
                    @csrf
                    @method('delete')
                    <h5 style="font-family: 'Cairo', sans-serif;">{{trans('receipt.Warning')}}</h5>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('receipt.Close')}}</button>
                        <button  class="btn btn-danger">{{trans('receipt.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
