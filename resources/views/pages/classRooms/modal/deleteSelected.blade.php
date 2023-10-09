<div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('classRooms.delete_class') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('classRooms.delete_all') }}" method="POST">
                @csrf
                <div class="modal-body">
                    {{ trans('classRooms.Warning_Grade') }}
                    <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" >
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('classRooms.Close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ trans('classRooms.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
