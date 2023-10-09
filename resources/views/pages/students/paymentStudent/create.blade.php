@extends('layouts.master')

@section('title')
    {{trans('Students_trans.Payment_Voucher')}}
@stop

@section('PageTitle')

    {{trans('Students_trans.Payment_Voucher')}}
@stop
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST"  action="{{ route('paymentStudents.store') }}" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{trans('Students_trans.name')}}</label>
                                    <input  class="form-control text-danger" readonly value="{{$student->name}}" type="text" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('receipt.amount')}}: <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="debit" type="number" value="{{$amount}}">
                                    <input  type="hidden" name="student_id"  value="{{$student->id}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('receipt.student_account')}}: <span class="text-danger">*</span></label>
                                    <input  class="form-control"  disabled   type="number" value="{{$amount}}">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{trans('invoice.description')}}: <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        @if($amount > 0)
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Students_trans.submit')}}</button>
                        @endif
                    </form>

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
