<div class="modal fade" id="edit{{ $section->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                    {{ trans('sections.edit_Section') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sections.update', ['section'=>$section->id ]) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col">
                            <input type="text" name="name_ar" class="form-control" value="{{ $section->getTranslation('name', 'ar') }}" />
                        </div>
                        <div class="col">
                            <input type="text" name="name" class="form-control" value="{{ $section->getTranslation('name', 'en') }}" />
                        </div>
                    </div>
                    <br>
                    <div class="col">
                        <label for="inputName" class="control-label">{{ trans('sections.Name_Grade') }}</label>
                        <select name="grade_id" class="custom-select" >
                            <option disabled>
                                {{ __('sections.Select_Grade') }}
                            </option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}"  @selected($grade->id == $section->grade_id)>
                                    {{ $grade->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <br>

                    <div class="col">
                        <label for="inputName" class="control-label">{{ trans('sections.name') }}</label>
                        <select name="class_id" class="custom-select">
                            <option value="{{ $section->class->id }}">
                                {{ $section->class->name }} {{-- And Other Options Are Related to Ajax --}}
                            </option>
                        </select>
                    </div>
                    <br>

                    <div class="col">
                        <div class="form-check">
                            @if ($section->status === '1')
                                <input type="checkbox"  checked class="form-check-input" name="status" id="exampleCheck1">
                            @else
                                <input type="checkbox"  class="form-check-input" name="status" id="exampleCheck1">
                            @endif
                            <label class="form-check-label" for="exampleCheck1">{{ trans('sections.Status') }}</label>
                        </div>
                    </div>
                    <div class="col">
                        <label for="inputName" class="control-label">
                            {{ trans('sections.Name_Teacher') }}
                        </label>
                        <select id="exampleFormControlSelect2" name="teacher_id[]" class="custom-select" multiple>
                            {{--Section Teachers--}}
                            @foreach($section->teachers as $teacher)
                                <option selected value="{{$teacher->id}}" > {{$teacher->name}}</option>
                            @endforeach
                            {{--All Teachers--}}
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}"> {{$teacher->name}}</option>
                            @endforeach
                        </select>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{ trans('sections.Close') }}
                </button>
                <button type="submit" class="btn btn-danger">
                    {{ trans('sections.submit') }}
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
