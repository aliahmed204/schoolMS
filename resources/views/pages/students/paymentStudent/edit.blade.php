@extends('layouts.master')

@section('css')
@endsection
@section('title')
    {{ __('receipt.edit') }}
@stop
@section('PageTitle')
    {{trans('receipt.edit')}}
@stop
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

                        <form method="POST"  action="{{ route('paymentStudents.update',['paymentStudent'=>$paymentStudent->id]) }}" autocomplete="off">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{trans('Students_trans.name')}}</label>
                                        <input  class="form-control text-danger font-weight-bold" readonly value="{{$paymentStudent->student->name}}" type="text" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{trans('receipt.debit')}}: <span class="text-danger">*</span></label>
                                        <input  class="form-control" name="debit" value="{{$paymentStudent->amount}}" type="number" >
                                        <input  type="hidden" name="student_id"  value="{{$paymentStudent->student->id}}" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{trans('invoice.description')}}: <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{$paymentStudent->description}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Students_trans.submit')}}</button>
                        </form>

                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection

@section('js')
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
@endsection
