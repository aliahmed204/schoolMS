<!DOCTYPE html>
<html lang="en">
@section('title')
    {{ __('main.Dashboard')}}
@stop
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">



    @livewireStyles
    @include('layouts.head')

</head>
<body>

<div class="wrapper">

    <!--=================================
preloader -->

    <div id="pre-loader">
        <img src="{{ URL::asset('assets/images/pre-loader/loader-01.svg') }}" alt="">
    </div>

    <!--=================================
preloader -->

    @include('layouts.main-header')

    @include('layouts.main-sidebar')

    <!--=================================
 Main content -->
    <!-- main-content -->
    <div class="content-wrapper">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="mb-0">
                        {{ __('main.Welcome')}} : {{auth()->user()->name}}
                    </h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    </ol>
                </div>
            </div>
        </div>

        <!-- widgets -->
        <div class="row" >
            <div class="col-xl-6 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left ml-2">
                                <span class="text-success">
                                    <i class="fas fa-user-graduate highlight-icon" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="float-right text-right mr-2">
                                <p class="card-text text-dark">{{ __('main.students_count')}}</p>
                                <h4>{{$sections_count}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">
                            <i class="fas fa-binoculars mr-1" aria-hidden="true"></i>
                            <a href="{{route('teacher.students.index')}}" target="_blank">
                                <span class="text-danger">{{ __('main.show_info')}}</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fas fa-chalkboard highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">{{ __('main.sections_count')}}</p>
                                <h4>{{$students_count}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">
                            <i class="fas fa-binoculars mr-1" aria-hidden="true"></i>
                            <a href="{{route('teacher.sections.index')}}" target="_blank">
                                <span class="text-danger">{{ __('main.show_info')}}</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Orders Status widgets-->

        <div class="row">

            <div  style="height: 400px;" class="col-xl-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="tab nav-border" style="position: relative;">
                            <div class="d-block d-md-flex justify-content-between">
                                <div class="d-block w-100">
                                    <h5 style="font-family: 'Cairo', sans-serif" class="card-title">{{trans('main.teacher_latest_update')}}</h5>
                                </div>
                                <div class="d-block d-md-flex nav-tabs-custom">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                                        <li class="nav-item">
                                            <a class="nav-link active show" id="students-tab" data-toggle="tab"
                                               href="#students" role="tab" aria-controls="students"
                                               aria-selected="true"> {{ __('main.students')}}</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="teachers-tab" data-toggle="tab" href="#teachers"
                                               role="tab" aria-controls="teachers"
                                               aria-selected="false">{{ __('main.Exams') }}
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="parents-tab" data-toggle="tab" href="#parents"
                                               role="tab" aria-controls="parents"
                                               aria-selected="false">{{ __('main.onlineClasses')}}
                                            </a>
                                        </li>


                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content" id="myTabContent">

                                {{--students Table--}}
                                <div class="tab-pane fade active show" id="students" role="tabpanel" aria-labelledby="students-tab">
                                    <div class="table-responsive mt-15">
                                        <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                            <thead>
                                            <tr  class="table-info text-danger">
                                                <th>#</th>
                                                <th>{{trans('Students_trans.name')}}</th>
                                                <th>{{trans('Students_trans.email')}}</th>
                                                <th>{{trans('Students_trans.gender')}}</th>
                                                <th>{{trans('Students_trans.Grade')}}</th>
                                                <th>{{trans('Students_trans.classrooms')}}</th>
                                                <th>{{trans('Students_trans.section')}}</th>
                                                <th> {{trans('main.created_at')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($students as $student)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$student->name}}</td>
                                                    <td>{{$student->email}}</td>
                                                    <td>{{$student->gender->name}}</td>
                                                    <td>{{$student->grade->name}}</td>
                                                    <td>{{$student->class->name}}</td>
                                                    <td>{{$student->section->name}}</td>
                                                    <td class="text-success">{{$student->created_at}}</td>
                                                    @empty
                                                        <td class="alert-danger" colspan="8">{{ __('main.empty')}}</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>

                                    </div>
                                    <div  class="{{ app()->getLocale() == 'ar' ? 'pull-left' : 'pull-right' }} mt-4">
                                        {{$students->links()}}
                                    </div>
                                </div>

                                {{--Quizzes Table--}}
                                <div class="tab-pane fade" id="teachers" role="tabpanel" aria-labelledby="teachers-tab">
                                    <div class="table-responsive mt-15">
                                        <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                            <thead>
                                            <tr  class="table-info text-danger">
                                                <th>#</th>
                                                <th>{{trans('exam.Exam')}}</th>
                                                <th>{{trans('exam.subject')}} </th>
                                                <th>{{trans('Students_trans.Grade')}}</th>
                                                <th>{{trans('Students_trans.classrooms')}}</th>
                                                <th>{{trans('Students_trans.section')}}</th>
                                                <th>{{trans('main.created_at')}}</th>
                                            </tr>
                                            </thead>

                                            @forelse($quizzes as $quiz)
                                                <tbody>
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$quiz->name}}</td>
                                                    <td>{{$quiz->subject->name}}</td>
                                                    <td>{{$quiz->grade->name}}</td>
                                                    <td>{{$quiz->class->name}}</td>
                                                    <td>{{$quiz->section->name}}</td>
                                                    <td class="text-success">{{$quiz->created_at}}</td>
                                                    @empty
                                                        <td class="alert-danger" colspan="7">{{trans('main.empty')}} </td>
                                                </tr>
                                                </tbody>
                                            @endforelse
                                        </table>
                                    </div>
                                    <div  class="{{ app()->getLocale() == 'ar' ? 'pull-left' : 'pull-right' }} mt-4">
                                        {{$quizzes->links()}}
                                    </div>
                                </div>

                                {{--parents Table--}}
                                <div class="tab-pane fade" id="parents" role="tabpanel" aria-labelledby="parents-tab">
                                    <div class="table-responsive mt-15">
                                        <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                            <thead>
                                            <tr  class="table-info text-danger">
                                                <th>#</th>
                                                <th>{{trans('onlineClass.Grade')}}</th>
                                                <th>{{trans('onlineClass.class')}}</th>
                                                <th>{{trans('onlineClass.section')}}</th>
                                                <th>{{trans('onlineClass.topic')}}</th>
                                                <th>{{trans('onlineClass.start_at')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($onlineClasses as $onlineClass)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$onlineClass->grade->name}}</td>
                                                    <td>{{ $onlineClass->class->name }}</td>
                                                    <td>{{$onlineClass->section->name}}</td>
                                                    <td>{{$onlineClass->topic}}</td>
                                                    <td>{{$onlineClass->start_at}}</td>
                                                    @empty
                                                        <td class="alert-danger" colspan="6">{{trans('main.empty')}}</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                        <div  class="{{ app()->getLocale() == 'ar' ? 'pull-left' : 'pull-right' }} mt-4">
                                            {{$onlineClasses->links()}}
                                        </div>
                                    </div>
                                </div>

                                {{--sections Table--}}
                                <div class="tab-pane fade" id="fee_invoices" role="tabpanel" aria-labelledby="fee_invoices-tab">
                                    <div class="table-responsive mt-15">
                                        <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                            <thead>
                                            <tr  class="table-info text-danger">
                                                <th>#</th>
                                                <th>{{trans('invoice.student')}}</th>
                                                <th>{{trans('invoice.fee_type')}}</th>
                                                <th class="alert-info">{{trans('invoice.amount')}}</th>
                                                <th>{{trans('invoice.class')}}</th>
                                                <th>{{trans('invoice.invoice_date')}}</th>
                                                <th>{{trans('main.created_at')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                          {{--  @forelse($latest_invoices as $invoice)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$invoice->student->name}}</td>
                                                    <td>{{$invoice->fee->title}}</td>
                                                    <td class="alert-info">{{number_format($invoice->amount,2)}}</td>
                                                    <td>{{$invoice->class->name}}</td>
                                                    <td>{{$invoice->invoice_date}}</td>
                                                    <td class="text-success">{{$invoice->created_at}}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="alert-danger" colspan="9">{{trans('main.empty')}}</td>
                                                </tr>
                                            @endforelse--}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>



        <livewire:calendar />

        <div class="row mb-3">
        </div>
        <!--=================================
wrapper -->

        <!--=================================
footer -->

        @include('layouts.footer')
    </div><!-- main content wrapper end-->
</div>
</div>
</div>

<!--=================================
footer -->

@include('layouts.footer-scripts')
@livewireScripts
@stack('scripts')

</body>

</html>
