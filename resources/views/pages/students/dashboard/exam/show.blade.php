@extends('layouts.master')

@section('css')
    @livewireStyles
@endsection

@section('title')
    {{trans('exam.exam_list')}}
@stop

@section('PageTitle')
    {{trans('exam.exam_list')}}
@stop



@section('content')

    @livewire('exam-question', ['quiz_id' => $quiz_id, 'student_id' => $student_id])

@endsection

@section('js')
    @livewireScripts
@endsection

