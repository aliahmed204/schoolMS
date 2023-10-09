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
                                <a href="{{route('teacher.onlineClasses.create')}}" class="btn btn-success btn-sm mb-2" role="button"
                                   aria-pressed="true">{{ trans('onlineClass.add_class') }}
                                </a>

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
                                            <th>{{trans('onlineClass.start_url')}}</th>
                                            <th>{{trans('onlineClass.join_url')}}</th>
                                            <th>{{trans('onlineClass.Processes')}}</th>
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
                                                <td class="text-danger">
                                                    <a href="{{$onlineClass->start_url}}" target="_blank">
                                                        {{trans('onlineClass.start_url')}}
                                                    </a>
                                                </td>
                                                <td>

                                                    {{--Delete--}}
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#delete_metting{{ $onlineClass->id }}" title="{{ __('onlineClass.Delete') }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                </td>
                                            </tr>
                                            {{--Delete-modal--}}
                                            @include('pages.teachers.onlineClasses.modal.delete')
                                        @empty
                                            <td colspan="10"> <div class="alert alert-info" > {{ __('onlineClass.empty')}} </div></td>
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
