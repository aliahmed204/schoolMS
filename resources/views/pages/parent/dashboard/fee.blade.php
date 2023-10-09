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
                                                    <a href="{{route('parent.children.receipt',['id'=>$invoice->student_id])}}" class="btn btn-info btn-sm" role="button" aria-pressed="true">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>


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
    @if(session()->has('noReceipt'))
        <script>
            toastr.options = {
                "progressBar": true ,
                'closeButton': true,
            };
            toastr.warning("{{ __('messages.noReceipt')}}","Receipt");
        </script>
    @endif
@endsection
