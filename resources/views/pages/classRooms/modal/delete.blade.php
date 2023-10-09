<div class="modal fade" id="delete{{ $class->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('classRooms.delete_Grade') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('classRooms.destroy', [ 'classRoom' => $class->id] ) }}" method="post">
                    @method('delete')
                    @csrf
                    {{ trans('classRooms.Warning_Grade') }}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('classRooms.Close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('classRooms.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
