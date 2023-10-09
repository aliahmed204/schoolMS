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
                                @if(session()->has('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ session()->get('error') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
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
                                <a href="{{route('library.create')}}" class="btn btn-success btn-sm mb-2" role="button"
                                   aria-pressed="true">{{  __('library.add_file') }}
                                </a>

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
                                                    <a href="{{route('library.downloadAttachment',[ 'file_title'=>$file->title,'file_name'=>$file->file_name])}}"
                                                       title="{{ __('library.download') }}" class="btn btn-warning btn-sm" role="button" aria-pressed="true">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    {{--Edit--}}
                                                    <a href="{{route('library.edit',['library'=>$file->id])}}" class="btn btn-info btn-sm" role="button" aria-pressed="true">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    {{--Delete--}}
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#delete_file{{ $file->id }}" title="{{ __('library.Delete') }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                </td>
                                            </tr>
                                            {{--Delete-modal--}}
                                            @include('pages.library.modal.delete')

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

@section('js')
        @if(session()->has('success1'))
            <script>
                toastr.options = {
                "progressBar": true ,
                'closeButton': true,
                 };
                toastr.success("{{ __('messages.success')}}");
            </script>
        @endif

        @if(session()->has('deleted'))
            <script>
                toastr.options = {
                "progressBar": true ,
                'closeButton': true,
                 };
                 toastr.warning("{{ __('messages.Delete')}}" );
            </script>
        @endif

        @if(session()->has('updated'))
            <script>
                toastr.options = {
                    "progressBar": true ,
                    'closeButton': true,
                };
                toastr.info("{{ __('messages.Update')}}" );
            </script>
        @endif


@endsection
