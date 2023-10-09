@extends('layouts.master')

@section('title')

    {{trans('invoice.add_invoice')}}
@stop

@section('PageTitle')
    {{trans('invoice.add_invoice')}}
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

                    <form  action="{{ route('feeInvoices.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="invoice_list">
                                    <div data-repeater-item>
                                        <div class="row">

                                            <div class="col">
                                                <label for="Name" class="mr-sm-2">{{ trans('invoice.student') }}</label>
                                                <select class="fancyselect" name="student_id" required>
                                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                                </select>
                                            </div>

                                            <div class="col">
                                                <label for="Name_en" class="mr-sm-2"> {{ trans('invoice.fee_type') }}</label>
                                                <div class="box">
                                                    <select class="fancyselect" name="fee_id" required>
                                                        <option value="">{{ trans('invoice.select') }}</option>
                                                        @foreach($fees as $fee)
                                                            <option value="{{ $fee->id }}">{{ $fee->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <label for="Name_en" class="mr-sm-2">{{ trans('invoice.amount') }}</label>
                                                <div class="box">
                                                    <select class="fancyselect" name="amount" required>
                                                        <option value="">{{ trans('invoice.select') }}</option>
                                                        @foreach($fees as $fee)
                                                            <option value="{{ $fee->amount }}">{{ $fee->amount }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label for="description" class="mr-sm-2">{{ trans('invoice.description') }}</label>
                                                <div class="box">
                                                    <input type="text" class="form-control" name="description" required>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label for="name_en" class="mr-sm-2">{{ trans('invoice.Processes') }}:</label>
                                                <input class="btn btn-danger btn-block" data-repeater-delete type="button" value="{{ trans('classRooms.delete_row') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input class="button" data-repeater-create type="button" value="{{ trans('classRooms.add_row') }}"/>
                                    </div>
                                </div><br>
                                <input type="hidden" name="grade_id" value="{{$student->grade_id}}">
                                <input type="hidden" name="class_id" value="{{$student->class_id}}">

                                <button type="submit" class="btn btn-primary"> {{ trans('invoice.submit') }}</button>
                            </div>
                        </div>
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
