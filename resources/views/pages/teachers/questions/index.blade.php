@extends('layouts.master')

@section('title')
    {{ __('main.questions_list') }}
@stop
@section('PageTitle')
    {{__('main.questions_list')}} : <span class="text-danger">{{$quiz->name}}</span>
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
                                <a href="{{route('teacher.questions.create',['id'=> $quiz->id])}}" class="btn btn-success btn-sm mb-2" role="button"
                                   aria-pressed="true">{{ trans('exam.add_questions') }}
                                </a>

                                <div class="table-responsive">
                                    <table  class="table table-hover table-sm table-bordered p-1" data-page-length="50" style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('exam.question_title')}}</th>
                                            <th>{{trans('exam.answers')}}</th>
                                            <th>{{trans('exam.right_answer')}}</th>
                                            <th>{{trans('exam.score')}}</th>
                                            <th>{{trans('exam.Exam')}}</th>
                                            <th>{{trans('exam.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($questions as $question)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$question->title}}</td>
                                                <td>{{$question->answers}}</td>
                                                <td>{{$question->right_answer}}</td>
                                                <td>{{$question->score}}</td>
                                                <td>{{$question->quiz->name}}</td>
                                                <td>
                                                    {{--Edit--}}
                                                    <a href="{{route('teacher.questions.edit',['question'=>$question->id ])}}" class="btn btn-info btn-sm" role="button" aria-pressed="true">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    {{--Delete--}}
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#delete_question{{ $question->id }}" title="{{ __('quiz.Delete') }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                </td>
                                            </tr>
                                            {{--Delete-modal--}}
                                            @include('pages.teachers.questions.modal.delete')

                                        @empty
                                            <td colspan="7"> <div class="alert alert-info" > {{ __('exam.empty')}} </div></td>
                                        @endforelse
                                    </table>
                                    <div class="{{ app()->getLocale() == 'ar' ? 'pull-left' : 'pull-right'}}">
                                        {{$questions->links()}}
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

        @if(session()->has('deleted'))
            <script>
                toastr.options = {
                "progressBar": true ,
                'closeButton': true,
                 };
                 toastr.warning("{{ __('messages.Delete')}}" );
            </script>
        @endif

        @if(session()->has('updated'))
            <script>
                toastr.options = {
                    "progressBar": true ,
                    'closeButton': true,
                };
                toastr.info("{{ __('messages.Update')}}" );
            </script>
        @endif


@endsection
