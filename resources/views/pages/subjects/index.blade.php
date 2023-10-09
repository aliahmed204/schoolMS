@extends('layouts.master')
@section('css') @endsection
@section('title')
    {{ __('main.subjects_list') }}
@stop
@section('PageTitle')
    {{__('main.subjects_list')}}
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
                                <a href="{{route('subjects.create')}}" class="btn btn-success btn-sm mb-2" role="button"
                                   aria-pressed="true">{{ trans('subject.add_subject') }}
                                </a>

                                <div class="table-responsive">
                                    <table  class="table table-hover table-sm table-bordered p-1" data-page-length="50" style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('subject.subject')}}</th>
                                            <th>{{trans('subject.grade')}}</th>
                                            <th>{{trans('subject.class')}}</th>
                                            <th>{{trans('subject.teacher')}}</th>
                                            <th>{{trans('subject.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($subjects as $subject)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$subject->name}}</td>
                                                <td>{{$subject->grade->name}}</td>
                                                <td>{{$subject->class->name}}</td>
                                                <td>{{$subject->teacher->name}}</td>
                                                <td>
                                                    {{--Edit--}}
                                                    <a href="{{route('subjects.edit',$subject->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    {{--Delete--}}
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#delete_subject{{ $subject->id }}" title="{{ __('subject.Delete') }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                </td>
                                            </tr>
                                            {{--Delete-modal--}}
                                            @include('pages.subjects.modal.delete')

                                        @empty
                                            <td colspan="6"> <div class="alert alert-info" > {{ __('subject.empty')}} </div></td>
                                        @endforelse
                                    </table>
                                    <div class="{{ app()->getLocale() == 'ar' ? 'pull-left' : 'pull-right'}}">
                                        {{$subjects->links()}}
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


