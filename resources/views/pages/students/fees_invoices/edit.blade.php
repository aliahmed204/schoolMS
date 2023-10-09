@extends('layouts.master')

@section('css')
@endsection
@section('title')
    {{ __('invoice.edit') }}
@stop
@section('PageTitle')
    {{trans('invoice.edit')}}
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

                    <form action="{{route('feeInvoices.update',['feeInvoice'=>$feeInvoice->id])}}" method="post" autocomplete="off">
                        @method('patch')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="student_id">{{ __('invoice.student') }}</label>
                                <input type="text" value="{{$feeInvoice->student->name}}" readonly name="student_id" class="form-control">
                            </div>


                            <div class="form-group col">
                                <label for="amount">{{ __('invoice.amount') }}</label>
                                <input type="number" value="{{$feeInvoice->amount}}" name="amount" class="form-control">
                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group col">
                                <label for="inputZip"> {{ __('invoice.fee_type') }}</label>
                                <select class="custom-select mr-sm-2" name="fee_id"> {{--fee type bus/school --}}
                                    @foreach($fees as $fee)
                                        <option value="{{$fee->id}}" @selected($fee->id == $feeInvoice->fee_id) >
                                            {{$fee->title}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="inputAddress">{{ __('invoice.description') }}</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4">{{$feeInvoice->description}}</textarea>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary">{{ __('invoice.submit') }}</button>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection

@section('js')


@endsection
