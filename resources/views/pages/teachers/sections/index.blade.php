@extends('layouts.master')

@section('title')
     {{ __('sections.title_page') }}
@stop

@section('PageTitle')
    {{ auth()->user()->name }} : {{ __('sections.title_page') }}
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
                                        <tr class="alert-primary">
                                            <th>#</th>
                                            <th>{{trans('sections.Name_Grade')}}</th>
                                            <th>{{ trans('sections.Name_Section') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($sections as $section)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$section->grade->name}}</td>
                                                <td>{{$section->name}}</td>
                                        @empty
                                            <td class="alert alert-danger"> {{trans('main.empty')}}  </td>
                                            </tr>
                                        @endforelse
                                    </table>

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

