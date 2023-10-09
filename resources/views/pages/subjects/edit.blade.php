@extends('layouts.master')

@section('title')
    {{ __('subject.edit_subject') }}
@stop
@section('PageTitle')
    {{__('subject.edit_subject')}}
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
                            <form action="{{route('subjects.update',['subject'=>$subject->id])}}" method="post" autocomplete="off">
                                @csrf
                                @method('patch')
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{__('subject.subject_name_ar')}}</label>
                                        <input type="text" name="name_ar" value="{{ $subject->getTranslation('name', 'ar') }}" class="form-control">
                                    </div>
                                    <div class="col">
                                        <label for="title">{{__('subject.subject_name_en')}}</label>
                                        <input type="text" name="name_en" value="{{ $subject->getTranslation('name', 'en') }}" class="form-control">
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputState">{{__('subject.grade')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="grade_id">
                                            <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                            @foreach($grades as $grade)
                                                <option value="{{$grade->id}}" @selected( $grade->id == $subject->grade_id ) >
                                                    {{$grade->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>
                                    <div class="form-group col mt-1">
                                        <label for="inputState"> {{__('subject.class')}}</label>
                                        <select name="class_id" class="custom-select">
                                            <option value="{{ $subject->class->id }}">
                                                {{ $subject->class->name }}
                                            </option>
                                        </select>
                                    </div>

                                    <br>
                                    <div class="form-group col">
                                        <label for="inputState"> {{__('subject.teacher')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="teacher_id">
                                            <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{$teacher->id}}" @selected( $teacher->id == $subject->teacher_id )>
                                                    {{$teacher->name}}
                                                </option>
                                            @endforeach
                                        </select>
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


