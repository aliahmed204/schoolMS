@extends('layouts.master')
@section('title')
    {{trans('main.manage_promotion')}}
@stop

@section('PageTitle')
    {{trans('main.manage_promotion')}}
@stop

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                @if (Session::has('error_promotion'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{Session::get('error_promotion')}}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#destroy_all">
                                   تراجع الكل
                                </button>
                                <br><br>


                                <div class="table-responsive">
                                    <table id="datatable1" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th class="alert-info">#</th>
                                            <th class="alert-info">{{trans('Students_trans.name')}}</th>
                                            <th class="alert-danger">المرحلة السابقة</th>
                                            <th class="alert-danger">السنة الدراسية</th>
                                            <th class="alert-danger">الصف السابق</th>
                                            <th class="alert-danger">القسم السابق</th>
                                            <th class="alert-success">المرحلة الحالي</th>
                                            <th class="alert-success">السنة الحالية</th>
                                            <th class="alert-success">الصف الحالي</th>
                                            <th class="alert-success">القسم الحالي</th>
                                            <th>{{trans('Students_trans.processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($promotions as $promotion)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$promotion->student->name}}</td>
                                                {{--Old--}}
                                                <td class="alert-danger" >{{$promotion->fromGrade->name}}</td>
                                                <td>{{$promotion->from_academic_year}}</td>
                                                <td>{{$promotion->fromClass->name}}</td>
                                                <td>{{$promotion->fromSection->name}}</td>
                                                {{--New--}}
                                                <td class="alert-success">{{$promotion->toGrade->name}}</td>
                                                <td>{{$promotion->to_academic_year}}</td>
                                                <td>{{$promotion->toClass->name}}</td>
                                                <td>{{$promotion->toSection->name}}</td>
                                                <td>
                                                    {{--delete promotion for one student --}}
                                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                                            data-target="#Delete_one{{$promotion->id}}">ارجاع الطالب</button>

                                                    {{--Graduate--}}
                                                    <button type="button" class="btn btn-outline-success" data-toggle="modal"
                                                            data-target="#Graduate_Student{{ $promotion->student_id }}" title="{{ trans('grades.graduate') }}">
                                                        تخرج الطالب
                                                    </button>
                                                </td>
                                            </tr>
                                        {{--retunrn back to last year--}}
                                        @include('pages.students.promotion.modal.destroy_all')
                                        {{--retunrn back only one student to last year--}}
                                        @include('pages.students.promotion.modal.delete_one')
                                        {{--Gradate one student--}}
                                        @include('pages.students.promotion.modal.graduate')

                                        @endforeach
                                    </table>
                                    <div class="{{ app()->getLocale() == 'ar' ? 'pull-left' : 'pull-right'}}">
                                        {{$promotions->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

    {{--success_rollback--}}
    @if(session()->has('success1'))
        <script>
            toastr.options = {
                "progressBar": true ,
                'closeButton': true,
            };
            toastr.success("{{ __('messages.success')}}");
        </script>
    @endif
    <script>
        $(document).ready(function () {
            $('select[name="new_grade"]').on('change', function () {
                var Grade_id = $(this).val();
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('students/getClasses') }}/"+Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            var classSelect = $('select[name="new_class"]');
                            classSelect.empty().append( '<option selected disabled>{{ trans("Parent_trans.Choose") }}...</option>');
                            $.each(data, function (key, value) {
                                classSelect.append('<option value="' + key + '">' + value + '</option>');
                            });
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
            $('select[name="new_class"]').on('change', function () {
                let Class_id = $(this).val();
                if (Class_id) {
                    $.ajax({
                        url: "{{ URL::to('students/getSections')}}/"+Class_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="new_section"]').empty().append('<option selected disabled >{{trans("Parent_trans.Choose")}}...</option>');
                            $.each(data, function (key, value) {
                                $('select[name="new_section"]').append('<option value="' + key + '">' + value + '</option>');
                            });
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
