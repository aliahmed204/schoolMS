@extends('layouts.master')

@section('title')
    {{ __('library.add_file') }}
@stop
@section('PageTitle')
    {{__('library.add_file')}}
@stop
@section('content')

    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                        @if($errors->any())
                            <div class="alert alert-danger font-bold ">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('library.store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                @csrf

                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="title">{{trans('library.title')}}</label>
                                        <input type="text" name="title" id="input-name" class="form-control form-control-alternative" autofocus>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label for="grade_id">{{__('exam.teacher')}} :<span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="teacher_id">
                                                <option selected disabled>{{__('exam.choose_teacher')}}</option>
                                                @foreach($teachers as $teacher)
                                                    <option  value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4 ">
                                        <div class="form-group">
                                            <label for="grade_id">{{trans('Students_trans.Grade')}} : <span class="text-danger">*</span></label>
                                            <select name="grade_id" class="custom-select" onchange="console.log($(this).val())">
                                                <option  selected disabled>{{ trans('sections.Select_Grade') }}</option>
                                                @foreach ($grades as $grade)
                                                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="class_id">{{trans('Students_trans.classrooms')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="class_id" >
                                                {{--<option>Ajax</option>--}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                            <select class="custom-select mr-sm-2" name="section_id">
                                                {{--<option>Ajax</option>--}}
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="file_name">{{trans('library.attach')}} : <span class="text-danger">*</span></label>
                                            <input type="file" accept="application/pdf" name="file_name" required>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{__('exam.submit')}}</button>
                            </form>
                        </div>
                    </div>
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


@endsection
