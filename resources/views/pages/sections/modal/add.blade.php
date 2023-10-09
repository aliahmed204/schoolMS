<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                    {{ trans('sections.add_class') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('sections.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <input type="text" name="name_ar" class="form-control" placeholder="{{ trans('sections.Section_name_ar') }}" />
                        </div>
                        <div class="col">
                            <input type="text" name="name" class="form-control" placeholder="{{ trans('sections.Section_name_en') }}">
                        </div>
                    </div>
                    <br>
                    <div class="col">
                        <label for="inputName" class="control-label">
                            {{ trans('sections.Name_Grade') }}
                        </label>
                        <select name="grade_id" class="custom-select" onchange="console.log($(this).val())">
                            <option  selected disabled>{{ trans('sections.Select_Grade') }}</option>
                            @foreach ($allGrades as $grade)
                                <option value="{{ $grade->id }}">
                                    {{ $grade->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="col">
                        <label for="inputName" class="control-label">{{ trans('sections.Name_Class') }}</label>
                        <select name="class_id" class="custom-select">
                            {{--would complete By ajax --}}
                        </select>
                    </div>

                    <div class="col">
                        <label for="inputName" class="control-label">
                            {{ trans('sections.Name_Teacher') }}
                        </label>
                        <select id="exampleFormControlSelect2" name="teacher_id[]" class="custom-select" multiple>
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}"> {{$teacher->name}}</option>
                            @endforeach
                        </select>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('sections.Close') }}</button>
                <button type="submit" class="btn btn-danger">{{ trans('sections.submit') }}</button>
            </div>
            </form>
        </div>
    </div>
</div>
