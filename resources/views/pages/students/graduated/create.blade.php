@extends('layouts.master')

@section('title')
    {{ __('main.add_Graduate') }}
@stop

@section('PageTitle')
    {{trans('main.add_Graduate')}}
@stop


@section('content')

    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">


                    @if (Session::has('error_Graduated'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{Session::get('error_Graduated')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @error('error')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @enderror


                    <form method="POST" action="{{ route('graduated.softDelete') }}" autocomplete="off">
                        @csrf
                        @method('delete')
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{trans('Students_trans.Grade')}}</label>
                                <select class="custom-select mr-sm-2" name="grade_id" required>
                                    <option selected disabled>{{trans('Students_trans.Grade')}}...</option>
                                    @foreach($grades as $grade)
                                        <option  value="{{ $grade->id }}">{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                                @error('grade_id')
                                <span class="badge text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{trans('Students_trans.classrooms')}} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="class_id" >
                                    {{--<option>Ajax</option>--}}
                                </select>
                                @error('class_id')
                                <span class="badge text-danger">*{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col">
                                <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                <select class="custom-select mr-sm-2" name="section_id">
                                    {{--<option>Ajax</option>--}}
                                </select>
                                @error('section_id')
                                <span class="badge text-danger">*{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col">
                                <label for="academic_year">{{trans('Students_trans.academic_year')}} : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="academic_year">
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @for($year = date("Y")-1; $year <= date("Y") +1 ; $year++)
                                        <option value="{{ $year}}">{{ $year }}</option>
                                    @endfor
                                </select>
                                @error('academic_year')
                                <span class="badge text-danger">*{{ $message }}</span>
                                @enderror
                            </div>


                        </div>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Students_trans.submit')}}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection

@section('js')

    <script>
        $(document).ready(function () {
            $('select[name="grade_id"]').on('change', function () {
                var Grade_id = $(this).val();
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('students/getClasses') }}/"+Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            var classSelect = $('select[name="class_id"]');
                            var classSelectContainer = $('#classSelectContainer');
                            classSelect.empty().append( '<option selected disabled>{{ trans("Parent_trans.Choose") }}...</option>');
                            $.each(data, function (key, value) {
                                classSelect.append('<option value="' + key + '">' + value + '</option>');
                            });
                            classSelectContainer.show();
                        },
                    });
                }
                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('select[name="class_id"]').on('change', function () {
                let Class_id = $(this).val();
                if (Class_id) {
                    $.ajax({
                        url: "{{ URL::to('students/getSections')}}/"+Class_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            var sectionSelectContainer = $('#sectionSelectContainer');
                            $('select[name="section_id"]').empty().append('<option selected disabled >{{trans("Parent_trans.Choose")}}...</option>');
                            $.each(data, function (key, value) {
                                $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                            sectionSelectContainer.show();
                        },
                    });
                }
                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

        @if(session()->has('success1'))
            <script>
            toastr.options = {
            "progressBar": true ,
            'closeButton': true,
        };
            toastr.success("{{ __('messages.success')}}");
            </script>
        @endif

        @if(session()->has('restore'))
            <script>
            toastr.options = {
            "progressBar": true ,
            'closeButton': true,
        };
            toastr.info("{{ __('messages.restore')}}" );
            </script>
        @endif

        @if(session()->has('deleted'))
            <script>
            toastr.options = {
            "progressBar": true ,
            'closeButton': true,
        };
        toastr.warning("{{ __('messages.Delete')}}" );
            </script>
        @endif
@endsection
