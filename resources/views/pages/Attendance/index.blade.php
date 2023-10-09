@extends('layouts.master')

@section('title')
    {{ trans('main.Attendance_list') }}
@stop

@section('PageTitle')
    {{ trans('main.Attendance_list') }}
@stop

@section('content')
    <!-- row -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h5 class="mb-2" style="font-family: 'Cairo', sans-serif;color: red"> {{ trans('main.today') }} : {{ date('d-m-Y') }}</h5>
    <form method="post" action="{{ route('attendances.store' , $section->id) }}">
        @csrf
        <table id="datatable1" class="table table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center">
            <thead>
            <tr>
                <th class="alert-success">#</th>
                <th class="alert-success">{{ trans('Students_trans.name') }}</th>
                <th class="alert-success">{{ trans('Students_trans.email') }}</th>
                <th class="alert-success">{{ trans('Students_trans.gender') }}</th>
                <th class="alert-success">{{ trans('Students_trans.Grade') }}</th>
                <th class="alert-success">{{ trans('Students_trans.classrooms') }}</th>
                <th class="alert-success">{{ trans('Students_trans.section') }}</th>
                <th class="alert-success">{{ trans('Students_trans.processes') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->gender->name }}</td>
                    <td>{{ $student->grade->name }}</td>
                    <td>{{ $student->class->name }}</td>
                    <td>{{ $student->section->name }}</td>
                    <td>
                           {{--لو الطالب اتاخد الغياب بتاعه انهارده بيظهر الحالة غايب/حاضر وبيتقفل الاختيار--}}
                        @if(isset($student->attendance()->where('for_day','=',date('Y-m-d'))->first()->student_id))

                            <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                <input name="attendences[{{ $student->id }}]" @disabled($student->attendance()->first()->status >= 0)
                                       @checked($student->attendance()->first()->status == 1 )
                                       class="leading-tight" type="radio" value="presence">
                                <span class="text-success">{{ trans('Students_trans.attend') }}</span>
                            </label>

                            <label class="ml-4 block text-gray-500 font-semibold">
                                <input name="attendences[{{ $student->id }}]" @disabled($student->attendance()->first()->status >= 0)
                                       @checked($student->attendance()->first()->status == 0 )
                                       class="leading-tight" type="radio" value="absent">
                                <span class="text-danger">{{ trans('Students_trans.non_attended') }}</span>
                            </label>

                        @else

                            <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                <input name="attendences[{{ $student->id }}]" class="leading-tight" type="radio" value="presence">
                                <span class="text-success">{{ trans('Students_trans.attend') }}</span>
                            </label>

                            <label class="ml-4 block text-gray-500 font-semibold">
                                <input name="attendences[{{ $student->id }}]" class="leading-tight" type="radio" value="absent">
                                <span class="text-danger">{{ trans('Students_trans.non_attended') }}</span>
                            </label>

                        @endif

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <P>
            <button class="btn btn-success" type="submit">{{ trans('Students_trans.submit') }}</button>
        </P>
    </form><br>
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
