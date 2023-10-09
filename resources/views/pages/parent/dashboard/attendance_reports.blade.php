@extends('layouts.master')

@section('title')
    {{ trans('main.Attendance_reports') }}
@stop

@section('PageTitle')
    {{ trans('main.Attendance_reports') }}
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

                <form method="post"  action="{{ route('parent.children.attendance_search') }}" autocomplete="off">
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{ __('main.search_info')}}</h6><br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="student"></label>
                                <select class="custom-select mr-sm-2" name="student_id">
                                    <option >{{ __('main.Students')}}</option>
                                    @foreach($allStudents as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card-body datepicker-form">
                            <div class="input-group" data-date-format="yyyy-mm-dd">
                                <span class="input-group-addon">{{ __('main.from')}}</span>
                                <input class="form-control range-from date-picker-default" placeholder="{{ __('main.start')}}"  type="text"  required name="from">
                                <span class="input-group-addon">{{ __('main.to')}}</span>
                                <input class="form-control range-to date-picker-default" placeholder="{{ __('main.end')}}" type="text" required name="to">

                            </div>
                        </div>

                    </div>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right mb-2" type="submit">{{trans('Students_trans.submit')}}</button>
                </form>
                @isset($students_attendance)
                <div class="table-responsive">
                    <table id="datatable1" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                           style="text-align: center">
                        <thead>
                        <tr>
                            <th class="alert-success">#</th>
                            <th class="alert-success">{{trans('Students_trans.name')}}</th>
                            <th class="alert-success">{{trans('Students_trans.Grade')}}</th>
                            <th class="alert-success">{{trans('Students_trans.section')}}</th>
                            <th class="alert-success">{{ trans('Students_trans.for_day') }}</th>
                            <th class="alert-warning">{{ trans('Students_trans.status') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($students_attendance as $student_attendance)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$student_attendance->student->name}}</td>
                                <td>{{$student_attendance->grade->name}}</td>
                                <td>{{$student_attendance->section->name}}</td>
                                <td>{{$student_attendance->for_day}}</td>
                                <td>
                                    @if($student_attendance->status == 0)
                                        <span class="text-danger">{{ trans('Students_trans.non_attended') }}</span>
                                    @else
                                        <span class="text-success">{{ trans('Students_trans.attend') }}</span>
                                    @endif
                                </td>
                                @empty
                                    <td colspan="6" class="alert alert-info text-center"> {{ __('main.empty') }} </td>
                            </tr>

                        @endforelse
                    </table>
                </div>
                @endisset

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
