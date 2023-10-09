@extends('layouts.master')

@section('title')
    {{ __('main.library') }}
@stop
@section('PageTitle')
    {{__('main.library')}}
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
                                    <table  class="table table-hover table-sm table-bordered p-1" data-page-length="50" style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('library.title')}}</th>
                                            <th>{{ __('library.teacher')}}</th>
                                            <th>{{ __('library.grade')}}</th>
                                            <th>{{ __('library.class')}}</th>
                                            <th>{{ __('library.section')}}</th>
                                            <th>{{ __('library.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($files as $file)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$file->title}}</td>
                                                <td>{{$file->teacher->name}}</td>
                                                <td>{{$file->grade->name}}</td>
                                                <td>{{$file->class->name}}</td>
                                                <td>{{$file->section->name}}</td>
                                                <td>
                                                    <a href="{{route('student.library.downloadAttachment',[ 'file_title'=>$file->title,'file_name'=>$file->file_name])}}"
                                                       title="{{ __('library.download') }}" class="btn btn-warning btn-sm" role="button" aria-pressed="true">
                                                        <i class="fa fa-download"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                        @empty
                                            <td colspan="7"> <div class="alert alert-info" > {{ __('exam.empty')}} </div></td>
                                        @endforelse
                                    </table>
                                    <div class="{{ app()->getLocale() == 'ar' ? 'pull-left' : 'pull-right'}}">
                                        {{$files->links()}}
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


