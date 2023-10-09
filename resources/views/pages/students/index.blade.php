@extends('layouts.master')

@section('title')
    {{trans('main.students')}}
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@stop

@section('PageTitle')
    {{trans('main.students')}}
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
                                <a href="{{route('students.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('main.add_student')}}</a><br><br>

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
                                            <th>{{trans('Students_trans.name')}}</th>
                                            <th>{{trans('Students_trans.email')}}</th>
                                            <th>{{trans('Students_trans.gender')}}</th>
                                            <th>{{trans('Students_trans.Grade')}}</th>
                                            <th>{{trans('Students_trans.classrooms')}}</th>
                                            <th>{{trans('Students_trans.section')}}</th>
                                            <th>{{trans('Students_trans.processes')}}</th>
                                            <th>{{trans('Students_trans.fees')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $student)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$student->name}}</td>
                                                <td>{{$student->email}}</td>
                                                <td>{{$student->gender->name}}</td>
                                                <td>{{$student->grade->name}}</td>
                                                <td>{{$student->class->name}}</td>
                                                <td>{{$student->section->name}}</td>
                                                <td>
                                                    {{--Show--}}
                                                    <a href="{{route('students.show',$student->id)}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    {{--Edit--}}
                                                    <a href="{{route('students.edit',$student->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    {{--Delete--}}
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#Delete_Student{{ $student->id }}" title="{{ trans('grades.Delete') }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    {{--Graduate--}}
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                            data-target="#Graduate_Student{{ $student->id }}" title="{{ trans('Students_trans.Graduate_Student') }}">
                                                        <i class="fa fa-graduation-cap"></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <div class="dropdown show">
                                                        <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i  class="fas fa-dollar-sign"></i>&nbsp; {{trans('Students_trans.processes')}}
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="{{route('feeInvoices.invoice_create',[ 'id' =>$student->id] )}}">
                                                                <i style="color: #0000cc" class="fa fa-edit"></i>&nbsp;{{trans('Students_trans.invoice')}}
                                                            </a>
                                                            <a class="dropdown-item" href="{{route('receiptStudents.create',[ 'id' =>$student->id]) }}">
                                                                <i style="color: #9dc8e2" class="fa fa-money"></i>&nbsp;{{trans('Students_trans.Receipt_Voucher')}}
                                                            </a>
                                                            <a class="dropdown-item" href="{{route('processingFees.create',[ 'id' =>$student->id])}}">
                                                                <i style="color: #9dc8e2" class="fas fa-money"></i>&nbsp;{{trans('receipt.processingFee')}}&nbsp;
                                                            </a>
                                                            <a class="dropdown-item" href="{{route('paymentStudents.create',[ 'id' =>$student->id])}}">
                                                                <i style="color:goldenrod" class="fas fa-donate"></i>&nbsp; {{trans('Students_trans.Payment_Voucher')}}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        {{--Delete Modal--}}
                                        @include('pages.students.modal.delete')
                                        {{--Delete Modal--}}
                                        {{--Graduate Modal--}}
                                        @include('pages.students.modal.graduate')
                                        {{--Graduate Modal--}}

                                        @endforeach
                                    </table>
                                    <div class="{{ app()->getLocale() == 'ar' ? 'pull-left' : 'pull-right'}}">
                                        {{$students->links()}}
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

@endsection
