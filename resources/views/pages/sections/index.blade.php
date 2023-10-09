@extends('layouts.master')

@section('title')
    {{ __('sections.title_page') }}
@stop

@section('PageTitle')
    {{__('sections.title_page')}}
@stop

@section('content')

    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                        {{-- Add New Section--}}
                    <button type="button" class="button x-small mb-3" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('sections.add_section') }}
                    </button>

                <div class="accordion gray plus-icon round">
                    {{--Every Grade Has its Own Sections--}}
                @forelse($grades as $grade)
                    <div class="acd-group">
                        <a href="#" class="acd-heading">{{ $grade->name }}</a>
                        <div class="acd-des">
                            <div class="row">
                                <div class="col-xl-12 mb-30">
                                    <div class="card card-statistics h-100">
                                        <div class="card-body">
                                            <div class="d-block d-md-flex justify-content-between">
                                                <div class="d-block"></div>
                                            </div>
                                            <div class="table-responsive mt-15">
                                                <table class="table center-aligned-table mb-0">
                                                    <thead>
                                                    <tr class="text-dark">
                                                        <th>#</th>
                                                        <th>{{ trans('sections.Name_Section') }}</th>
                                                        <th>{{ trans('sections.Name_Class') }}</th>
                                                        <th>{{ trans('sections.Status') }}</th>
                                                        <th>{{ trans('sections.Processes') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    {{-- SECTIONS IN GRADE THROW RELATION grade->hasMany('sectoins')--}}
                                                    @forelse ($grade->sections as $section)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $section->name }}</td>
                                                            <td>{{ $section->class->name }}</td>
                                                            <td>
                                                                @if ($section->status === '1') {{-- Active --}}
                                                                    <label class="badge badge-success">{{ trans('sections.Status_Section_AC') }}</label>
                                                                @else {{-- Disblaed --}}
                                                                    <label class="badge badge-danger">{{ trans('sections.Status_Section_No') }}</label>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                {{-- Edit --}}
                                                                <a href="#" class="btn btn-outline-info btn-sm" data-toggle="modal"
                                                                   data-target="#edit{{ $section->id }}">{{ trans('sections.Edit') }}</a>
                                                                {{-- Delete --}}
                                                                <a href="#" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                                   data-target="#delete{{ $section->id }}">{{ trans('sections.Delete') }}</a>
                                                            </td>
                                                        </tr>

                                                        <!-- edit_modal_Section -->
                                                        @include('pages.sections.modal.edit')
                                                        <!-- edit_modal_Section -->

                                                        <!-- delete_modal_Section -->
                                                        @include('pages.sections.modal.delete')
                                                        <!-- delete_modal_Section -->

                                                        @empty  {{--Empty Sections--}}
                                                            <td colspan="5"><div class="alert alert-info"> {{ __('sections.empty') }}</div></td>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty {{--Empty Grades--}}
                            <div class="alert alert-info"> {{ __('grades.empty') }}</div>
                        @endforelse
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- add_modal_Section -->
        @include('pages.sections.modal.add')
        <!-- add_modal_Section -->

@endsection


