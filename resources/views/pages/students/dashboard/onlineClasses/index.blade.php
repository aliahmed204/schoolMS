@extends('layouts.master')

@section('title')
    {{ __('main.onlineClasses') }}
@stop
@section('PageTitle')
    {{__('main.onlineClasses')}}
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
                                            <th>{{trans('onlineClass.Grade')}}</th>
                                            <th>{{trans('onlineClass.class')}}</th>
                                            <th>{{trans('onlineClass.section')}}</th>
                                            <th>{{trans('onlineClass.created_by')}}</th>
                                            <th>{{trans('onlineClass.topic')}}</th>
                                            <th>{{trans('onlineClass.start_at')}}</th>
                                            <th>{{trans('onlineClass.duration')}}</th>
                                            <th>{{trans('onlineClass.join_url')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($onlineClasses as $onlineClass)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$onlineClass->grade->name}}</td>
                                                <td>{{ $onlineClass->class->name }}</td>
                                                <td>{{$onlineClass->section->name}}</td>
                                                <td>{{$onlineClass->created_by}}</td>
                                                <td>{{$onlineClass->topic}}</td>
                                                <td>{{$onlineClass->start_at}}</td>
                                                <td>{{$onlineClass->duration}}<span class="badge text-danger">{{__('onlineClass.minute')}}</span></td>
                                                <td class="text-danger">
                                                    <a href="{{$onlineClass->join_url}}" target="_blank">
                                                        {{trans('onlineClass.join_now')}}
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <td colspan="8"> <div class="alert alert-info" > {{ __('onlineClass.empty')}} </div></td>
                                        @endforelse
                                    </table>
                                    <div class="{{ app()->getLocale() == 'ar' ? 'pull-left' : 'pull-right'}}">
                                        {{$onlineClasses->links()}}
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
