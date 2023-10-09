<div class="modal fade" id="edit{{ $class->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('classRooms.edit_Grade') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--form -->
                <form action="{{ route('classRooms.update', [ 'classRoom' => $class->id] ) }}" method="post">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="Name" class="mr-sm-2">{{ trans('classRooms.stage_name_ar') }}:</label>
                            <input id="Name" type="text" name="name_ar" class="form-control"
                                   value="{{ $class->getTranslation('name','ar') }}" required>
                        </div>
                        <div class="col">
                            <label for="Name_en" class="mr-sm-2">{{ trans('classRooms.stage_name_en') }}:</label>
                            <input type="text" class="form-control"
                                   value="{{$class->getTranslation('name' ,'en')}}" name="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Name_en" class="mr-sm-2">{{ trans('classRooms.Name_Grade') }}:</label>
                        <div class="box">
                            <select class="fancyselect" name="grade_id">
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}" @selected($class->grade_id == $grade->id) >
                                        {{ $grade->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <br><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('classRooms.Close') }}</button>
                        <button type="submit" class="btn btn-success">{{ trans('classRooms.submit') }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
