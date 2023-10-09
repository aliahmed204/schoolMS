@php
use App\Models\library;
@endphp
@extends('layouts.master')

@section('title')
    {{ __('exam.edit_exam') }}
@stop
@section('PageTitle')
    {{__('exam.edit_exam')}}
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
                            <form action="{{route('library.update',['library'=>$library->id])}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                @method('patch')
                                <div class="form-row">

                                    <div class="col-md-6">
                                        <label for="title">اسم الكتاب</label>
                                        <input type="text" name="title" value="{{$library->title}}" class="form-control">
                                        <input type="hidden" name="id" value="{{$library->id}}" class="form-control">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label for="Grade_id">{{__('exam.teacher')}} :<span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="teacher_id">
                                                <option selected disabled>{{__('exam.choose_teacher')}}</option>
                                                @foreach($teachers as $teacher)
                                                    <option  value="{{ $teacher->id }}" @selected($teacher->id == $library->teacher_id)>
                                                        {{ $teacher->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="grade_id">{{trans('Students_trans.Grade')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="grade_id">
                                                <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                                @foreach($grades as $grade)
                                                    <option  value="{{ $grade->id }}" {{$library->grade_id == $grade->id ?'selected':''}}>{{ $grade->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="class_id">{{trans('Students_trans.classrooms')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="class_id">
                                                <option value="{{$library->class_id}}">{{$library->class->name}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                            <select class="custom-select mr-sm-2" name="section_id">
                                                <option value="{{$library->section_id}}">{{$library->section->name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div><br>

                                <div class="form-row">
                                    <div class="col">

                                        <embed src="{{ URL::asset(library::Path.$library->title.'/'.$library->file_name) }}"
                                               type="application/pdf" height="150px" width="200px" /> <br><br>

                                        <div class="form-group">
                                            <label for="academic_year">{{trans('library.attach')}} <span class="text-danger">*</span></label>
                                            <input type="file" accept="application/pdf"  name="file_name">
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


