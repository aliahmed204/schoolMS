@extends('layouts.master')

@section('title')
    {{trans('receipt.receipt_list')}}
@stop

@section('PageTitle')
    {{trans('receipt.receipt_list')}}
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
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($receipts as $receipt)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$receipt->date}}</td>
                                            <td>{{$receipt->student->name}}</td>
                                            <td>{{number_format($receipt->debit,2)}}</td>
                                            <td>{{$receipt->description}}</td>

                                        @endforeach
                                    </table>
                                    <div class="{{ app()->getLocale() == 'ar' ? 'pull-left' : 'pull-right'}}">
                                        {{$receipts->links()}}
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

