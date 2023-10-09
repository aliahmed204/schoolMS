@extends('layouts.master')

@section('title')
    {{trans('exam.exam_list')}}
@stop

@section('PageTitle')
    {{trans('exam.exam_list')}} here
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
                                <div class="table-responsive">
                                    <table id="data" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>المادة الدراسية</th>
                                            <th>اسم الاختبار</th>
                                            <th>دخول / درجة الاختبار</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quizzes as $quiz)
                                            <tr>
                                                {{--<td>{{ $loop->iteration}}</td>--}}
                                                <td>{{ $quiz->id}}</td>
                                                <td>{{$quiz->subject->name}}</td>
                                                <td>{{$quiz->name}}</td>
                                                <td>
                                                        @php $count = $quiz->degree->count() @endphp

                                                    @if(($count > 0) && ($quiz->id == $quiz->degree[$count-1]->quiz_id )&& ($quiz->degree[$count-1]->student_id == auth()->user()->id) )
                                                       <span class="badge badge-success">  {{$quiz->degree[$count-1]->score}} </span>
                                                    @else
                                                        <a href="{{route('student.exams.show',['id'=>$quiz->id])}}"
                                                           class="btn btn-outline-success btn-sm" role="button"
                                                           aria-pressed="true" onclick="alertAbuse()">
                                                            <i class="fa fa-check"></i></a>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
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

        <script>
            function alertAbuse() {
                alert("برجاء عدم إعادة تحميل الصفحة بعد دخول الاختبار - في حال تم تنفيذ ذلك سيتم الغاء الاختبار بشكل اوتوماتيك ");
            }
        </script>

@endsection
