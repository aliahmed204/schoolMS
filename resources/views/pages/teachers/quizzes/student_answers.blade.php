@extends('layouts.master')

@section('title')
    {{ __('main.Exams') }}
@stop
@section('PageTitle')
    {{__('main.Exams')}}: <span class="badge text-primary">{{$degrees[0]->student->name}}</span>
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
                                    <table id="data" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th colspan="2"> سؤال</th>
                                            <th> أجابة الطالب</th>
                                            <th> الأجابة الصحيحة</th>
                                            <th>مجموع الدرجات</th>
                                            <th>تلاعب</th>
                                            <th>تاريخ اجراء الاختبار</th>
                                            <th>التوقيت</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($degrees as $degree)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td colspan="2">{{$degree->question->title}}</td>
                                                <td>{{$degree->answer}}</td>
                                                <td>{{$degree->question->right_answer}}</td>
                                                <td>{{$degree->score}}</td>
                                                @if($degree->abuse == 0)
                                                    <td>
                                                        <span class="badge badge-success"> لا يوجد تلاعب </span>
                                                    </td>
                                                @else
                                                    <td>
                                                        <span class="badge badge-danger"> يوجد تلاعب </span>
                                                    </td>
                                                @endif
                                                <td>{{$degree->date}}</td>
                                                <td> {{$degree->created_at->format('H:i:s')}} </td>

                                            </tr>
                                        @endforeach
                                    </table>
                                    <div class="{{ app()->getLocale() == 'ar' ? 'pull-left' : 'pull-right'}}">
                                        {{$degrees->links()}}
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


