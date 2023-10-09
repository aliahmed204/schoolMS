@extends('layouts.master')

@section('title')
    {{trans('invoice.invoice_list')}}
@stop

@section('PageTitle')
    {{trans('invoice.invoice_list')}}
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
                                            <th class="alert-primary">{{trans('invoice.student')}}</th>
                                            <th>{{trans('invoice.fee_type')}}</th>
                                            <th class="alert-info">{{trans('invoice.amount')}}</th>
                                            <th>{{trans('invoice.grade')}}</th>
                                            <th>{{trans('invoice.class')}}</th>
                                            <th>{{trans('invoice.description')}}</th>
                                            <th>{{trans('invoice.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($invoices as $invoice)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="alert-primary">{{$invoice->student->name}}</td>
                                            <td>{{$invoice->fee->title}}</td>
                                            <td class="alert-info">{{number_format($invoice->amount,2)}}</td>
                                            <td>{{$invoice->grade->name}}</td>
                                            <td>{{$invoice->class->name}}</td>
                                            <td>{{$invoice->description}}</td>
                                                <td>
                                                    <a href="{{route('feeInvoices.edit',['feeInvoice'=>$invoice->id])}}" class="btn btn-info btn-sm" role="button" aria-pressed="true">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    {{--Delete--}}
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#Delete_Fee_invoice{{$invoice->id}}"
                                                            title="{{ trans('invoice.Delete') }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        {{--Delete Modal--}}
                                        @include('pages.students.fees_invoices.modal.delete')
                                        {{--Delete Modal--}}

                                        @endforeach
                                    </table>
                                    <div class="{{ app()->getLocale() == 'ar' ? 'pull-left' : 'pull-right'}}">
                                        {{$invoices->links()}}
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
