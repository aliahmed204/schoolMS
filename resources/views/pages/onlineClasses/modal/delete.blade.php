<div class="modal fade" id="delete_metting{{ $onlineClass->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('onlineClasses.destroy',['onlineClass'=>$onlineClass->id])}}" method="post">
            @method('delete')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ __('subject.Delete') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> {{ __('subject.Warning') }}</p>
                </div>
                <div class="modal-footer">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('subject.Close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('subject.submit') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

