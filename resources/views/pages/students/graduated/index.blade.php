@extends('layouts.master')

@section('title')
    {{trans('main.graduated_list')}}
@stop

@section('PageTitle')
    {{trans('main.graduated_list')}}
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
                                    <table id="datatable1" class="table  table-hover table-sm table-bordered p-0" data-page-length="10"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('Students_trans.name')}}</th>
                                            <th>{{trans('Students_trans.email')}}</th>
                                            <th>{{trans('Students_trans.gender')}}</th>
                                            <th>{{trans('Students_trans.Grade')}}</th>
                                            <th>{{trans('Students_trans.classrooms')}}</th>
                                            <th>{{trans('Students_trans.section')}}</th>
                                            <th>{{trans('Students_trans.processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($students as $student)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$student->name}}</td>
                                            <td>{{$student->email}}</td>
                                            <td>{{$student->gender->name}}</td>
                                            <td>{{$student->grade->name}}</td>
                                            <td>{{$student->class->name}}</td>
                                            <td>{{$student->section->name}}</td>
                                                <td>
                                                    {{--return--}}
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                            data-target="#Return_Student{{ $student->id }}"
                                                            title="{{ trans('Students_trans.restore') }}">
                                                        {{ trans('Students_trans.restore') }}
                                                    </button>
                                                    {{--Delete--}}
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#Delete_Student{{ $student->id }}"
                                                            title="{{ trans('Students_trans.Delete') }}">
                                                        {{ trans('Students_trans.Delete') }}
                                                    </button>
                                                </td>
                                            </tr>
                                        {{--Restore Modal--}}
                                        @include('pages.students.graduated.modal.restore')
                                        {{--Restore Modal--}}
                                        {{--Delete Modal--}}
                                        @include('pages.students.graduated.modal.delete')
                                        {{--Delete Modal--}}

                                        @empty
                                            <td colspan="8"><div class="alert alert-info">{{__('onlineClass.empty')}}</div></td>
                                        @endforelse
                                    </table>
                                    <div class="{{ app()->getLocale() == 'ar' ? 'pull-left' : 'pull-right'}}">
                                        {{$students->links()}}
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
    @if(session()->has('restored'))
        <script>
            toastr.options = {
                "progressBar": true ,
                'closeButton': true,
            };
            toastr.info("{{ __('messages.restored')}}");
        </script>
    @endif

@endsection
