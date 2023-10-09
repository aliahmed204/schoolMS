@extends('layouts.master')

@section('title')
    {{ __('exam.edit_exam') }}
@stop
@section('PageTitle')
    {{__('exam.edit_exam')}} :<span class="text-danger"> {{$question->quiz->name}}</span>
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
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('teacher.questions.update',['question'=>$question->id ])}}" method="post" autocomplete="off">
                                @csrf
                                @method('patch')
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('exam.question_title')}}</label>
                                        <input type="text" name="title" id="input-name"
                                               class="form-control form-control-alternative"
                                               value="{{$question->title}}"
                                               autofocus>
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="answers">{{trans('exam.answers')}}</label>
                                        <textarea name="answers" class="form-control" id="exampleFormControlTextarea1" rows="4">{{$question->answers}}</textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title"> {{trans('exam.right_answer')}}</label>
                                        <input type="text" name="right_answer" id="input-name"
                                               class="form-control form-control-alternative"
                                               value="{{$question->right_answer}}"
                                               autofocus>
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="score">{{trans('exam.score')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="score">
                                                <option value="{{$question->score}}">{{$question->score}}</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{__('subject.submit')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection


