@extends('layouts.master')

@section('title')
    {{trans('receipt.processingFee')}}
@stop

@section('PageTitle')
    {{trans('receipt.processingFee')}}
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
                                            <th>{{trans('receipt.date')}}</th>
                                            <th>{{trans('receipt.student')}}</th>
                                            <th>{{trans('receipt.debit')}}</th>
                                            <th>{{trans('receipt.description')}}</th>
                                            <th>{{trans('receipt.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($processingFees as $processingFee)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$processingFee->date}}</td>
                                            <td>{{$processingFee->student->name}}</td>
                                            <td>{{number_format($processingFee->amount,2)}}</td>
                                            <td>{{$processingFee->description}}</td>

                                                <td>
                                                    <a href="{{route('processingFees.edit',['processingFee'=>$processingFee->id])}}" class="btn btn-info btn-sm" role="button" aria-pressed="true">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    {{--Delete--}}
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#Delete_processingFees{{$processingFee->id}}"
                                                            title="{{ trans('receipt.Delete') }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        {{--Delete Modal--}}
                                        @include('pages.students.processingFee.modal.delete')
                                        {{--Delete Modal--}}

                                        @endforeach
                                    </table>
                                    <div class="{{ app()->getLocale() == 'ar' ? 'pull-left' : 'pull-right'}}">
                                        {{$processingFees->links()}}
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
