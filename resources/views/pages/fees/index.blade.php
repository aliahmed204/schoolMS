@extends('layouts.master')

@section('title')

    {{trans('main.fees_list')}}
@stop

@section('PageTitle')
    {{trans('main.fees_list')}}
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
                                <a href="{{route('fees.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('main.add_fee')}}</a><br><br>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="table-responsive">
                                    <table id="datatable1" class="table  table-hover table-sm table-bordered p-0" data-page-length="10"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('fees.title')}}</th>
                                            <th>{{trans('fees.amount')}}</th>
                                            <th>{{trans('fees.grade')}}</th>
                                            <th>{{trans('fees.class')}}</th>
                                            <th>{{trans('fees.description')}}</th>
                                            <th>{{trans('fees.year')}}</th>
                                            <th>{{trans('fees.fee_type')}}</th>
                                            <th>{{trans('fees.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($fees as $fee)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$fee->title}}</td>
                                            <td>{{number_format($fee->amount,2)}}</td>
                                            <td>{{$fee->grade->name}}</td>
                                            <td>{{$fee->class->name}}</td>
                                            <td>{{$fee->description}}</td>
                                            <td>{{$fee->year}}</td>
                                            <td>{{$fee->fee_type}}</td>
                                                <td>
                                                    {{--Edit--}}
                                                    <a href="{{route('fees.edit',$fee->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    {{--Delete--}}
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#Delete_Fee{{ $fee->id }}"
                                                            title="{{ trans('Grades_trans.Delete') }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                </td>
                                            </tr>
                                        {{--Delete Modal--}}
                                        @include('pages.fees.modal.delete')
                                        {{--Delete Modal--}}
                                        @empty
                                        @endforelse
                                    </table>
                                    <div class="{{ app()->getLocale() == 'ar' ? 'pull-left' : 'pull-right'}}">
                                        {{$fees->links()}}
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

    @if(session()->has('updated'))
        <script>
            toastr.options = {
                "progressBar": true ,
                'closeButton': true,
                "positionClass": "toast-bottom-right",
            };
            toastr.info("{{ __('messages.Update')}}" );
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

@endsection
