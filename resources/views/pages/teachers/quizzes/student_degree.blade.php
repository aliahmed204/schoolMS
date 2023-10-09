@extends('layouts.master')

@section('title')
    {{ __('main.Exams') }}
@stop
@section('PageTitle')
    {{__('main.Exams')}}
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
                                            <th>اسم الطالب</th>
                                            <th>اخر سؤال</th>
                                            <th>الدرجة</th>
                                            <th>تلاعب</th>
                                            <th>تاريخ اجراء الاختبار</th>
                                            <th>العمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($degrees as $degree)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$degree->student->name}}</td>
                                                <td>{{$degree->question->title}}</td>
                                                <td>{{$degree->score}}</td>
                                                @if($degree->abuse == 0)
                                                    <td>
                                                        <span class="badge badge-success"> لا يوجد تلاعب </span>
                                                    </td>
                                                @else
                                                    <td>
                                                        <span class="badge badge-danger"> يوجد تلاعب </span>
                                                    </td><
                                                @endif
                                                <td>{{$degree->date}}</td>
                                                <td>

                                                    {{--show students--}}
                                                    <a href="{{route('teacher.quizzes.student_answers', [$degree->quiz_id ,$degree->student_id] )}}" class="btn btn-primary btn-sm"
                                                       title="{{ __('quiz.qustion') }}" role="button" aria-pressed="true">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    @if($degree->abuse != 0)
                                                      <button type="button" class="btn btn-warning btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#repeat_quizze{{ $degree->quiz_id }}" title="إعادة">
                                                        <i class="fa fa-repeat"></i>
                                                      </button>
                                                    @endif
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="repeat_quizze{{$degree->quiz_id}}" tabindex="-1"
                                                 role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('teacher.quizzes.repeat_quiz', [$degree->quiz_id ,$degree->student_id])}} method" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;"
                                                                    class="modal-title" id="exampleModalLabel">فتح إعادة الاختبار للطالب</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h6>{{$degree->student->name}}</h6>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                                                                    <button type="submit"
                                                                            class="btn btn-info">{{ trans('My_Classes_trans.submit') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </table>
                                    <div class="{{ app()->getLocale() == 'ar' ? 'pull-left' : 'pull-right'}}">
                                        {{$degrees->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- row closed  -->
@endsection

@section('js')
    @if(session()->has('repeat'))
        <script>
            toastr.options = {
                "progressBar": true ,
                'closeButton': true,
            };
            toastr.success("{{ __('messages.repeat')}}");
        </script>
    @endif
@endsection

