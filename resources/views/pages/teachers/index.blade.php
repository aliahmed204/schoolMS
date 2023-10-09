@extends('layouts.master')

@section('title')
    {{ __('main.List_Teachers') }}
@stop
@section('PageTitle')
    {{__('main.List_Teachers')}}
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
                                <a href="{{route('teachers.create')}}" class="btn btn-success btn-sm mb-2" role="button"
                                   aria-pressed="true">{{ trans('Teacher_trans.Add_Teacher') }}
                                </a>

                                <div class="table-responsive">
                                    <table  class="table table-hover table-sm table-bordered p-1" data-page-length="50" style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('Teacher_trans.Name_Teacher')}}</th>
                                            <th>{{trans('Teacher_trans.Gender')}}</th>
                                            <th>{{trans('Teacher_trans.Joining_Date')}}</th>
                                            <th>{{trans('Teacher_trans.specialization')}}</th>
                                            <th>{{trans('Teacher_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($teachers as $teacher)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$teacher->name}}</td>
                                                <td>{{$teacher->gender->name}}</td>
                                                <td>{{$teacher->joining_date}}</td>
                                                <td>{{$teacher->specialization->name}}</td>
                                                <td>
                                                    {{--Edit--}}
                                                    <a href="{{route('teachers.edit',$teacher->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    {{--Delete--}}
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#delete_Teacher{{ $teacher->id }}" title="{{ __('Grades_trans.Delete') }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                </td>
                                            </tr>

                                            <div class="modal fade" id="delete_Teacher{{$teacher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('teachers.destroy',['teacher'=>$teacher->id])}}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ __('Teacher_trans.Delete_Teacher') }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p> {{ __('Teacher_trans.Warning') }}</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ __('Teacher_trans.Close') }}</button>
                                                                    <button type="submit"
                                                                            class="btn btn-danger">{{ __('Teacher_trans.submit') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        @empty
                                            <td colspan="6"> <div class="alert alert-info" > {{ __('Teacher_trans.empty')}} </div></td>
                                        @endforelse
                                    </table>
                                    <div class="{{ app()->getLocale() == 'ar' ? 'pull-left' : 'pull-right'}}">
                                        {{$teachers->links()}}
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

        @if(session()->has('hasChild'))
            <script>
                toastr.options = {
                "progressBar": true ,
                'closeButton': true,
                };
                  toastr.error("{{ __('grades.delete_Grade_Error')}}" );
                </script>
        @endif


@endsection
