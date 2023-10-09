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

                                @if($errors->any())
                                    <div class="alert alert-danger font-bold col-6">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                        {{--Create--}}
                                <a href="{{route('teacher.quizzes.create')}}" class="btn btn-success btn-sm mb-2" role="button"
                                   aria-pressed="true">{{ trans('exam.add_exam') }}
                                </a>

                                <div class="table-responsive">
                                    <table  class="table table-hover table-sm table-bordered p-1" data-page-length="50" style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('exam.Exam')}}</th>
                                            <th>{{trans('exam.teacher')}}</th>
                                            <th>{{trans('Students_trans.Grade')}}</th>
                                            <th>{{trans('Students_trans.classrooms')}}</th>
                                            <th>{{trans('Students_trans.section')}}</th>
                                            <th>{{trans('exam.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($quizzes as $quiz)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$quiz->name}}</td>
                                                <td>{{$quiz->teacher->name}}</td>
                                                <td>{{$quiz->grade->name}}</td>
                                                <td>{{$quiz->class->name}}</td>
                                                <td>{{$quiz->section->name}}</td>
                                                <td>

                                                    {{--Edit--}}
                                                    <a href="{{route('teacher.quizzes.edit',['quiz'=>$quiz->id])}}" class="btn btn-info btn-sm" role="button" aria-pressed="true">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    {{--Delete--}}
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#delete_quiz{{ $quiz->id }}" title="{{ __('quiz.Delete') }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                    {{--show Qustions--}}
                                                    <a href="{{route('teacher.questions.index',$quiz->id)}}" class="btn btn-warning btn-sm" title="{{ __('quiz.qustion') }}" role="button" aria-pressed="true">
                                                        <i class="fa fa-binoculars"></i>
                                                    </a>
                                                    {{--show students--}}
                                                    <a href="{{route('teacher.quizzes.student_finished',$quiz->id)}}" class="btn btn-primary btn-sm" title="{{ __('quiz.qustion') }}" role="button" aria-pressed="true">
                                                        <i class="fa fa-street-view"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                            {{--Delete-modal--}}
                                            @include('pages.teachers.quizzes.modal.delete')

                                        @empty
                                            <td colspan="7"> <div class="alert alert-info" > {{ __('exam.empty')}} </div></td>
                                        @endforelse
                                    </table>
                                    <div class="{{ app()->getLocale() == 'ar' ? 'pull-left' : 'pull-right'}}">
                                        {{$quizzes->links()}}
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
        @if(session()->has('success1'))
            <script>
                toastr.options = {
                "progressBar": true ,
                'closeButton': true,
                 };
                toastr.success("{{ __('messages.success')}}");
            </script>
        @endif
@endsection
