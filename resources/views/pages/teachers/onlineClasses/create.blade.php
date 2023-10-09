@extends('layouts.master')

@section('title')
    {{ __('onlineClass.add_class') }}
@stop
@section('PageTitle')
    {{__('onlineClass.add_class')}}
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
                            <form action="{{route('teacher.onlineClasses.store')}}" method="post" autocomplete="off">
                                @csrf
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

                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>{{trans('onlineClass.meeting_id')}} :<span class="text-danger">*</span></label>
                                            <input class="form-control" name="meeting_id" type="number">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>{{trans('onlineClass.topic')}} : <span class="text-danger">*</span></label>
                                            <input class="form-control" name="topic" type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>{{trans('onlineClass.start_at')}} <span class="text-danger">*</span></label>
                                            <input class="form-control" type="datetime-local" name="start_at">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>{{trans('onlineClass.duration')}} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="duration" type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('onlineClass.start_url')}}<span class="text-danger">*</span></label>
                                            <input class="form-control" name="start_url" type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('onlineClass.join_url')}} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="join_url" type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('onlineClass.password')}} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="password" type="text">
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

