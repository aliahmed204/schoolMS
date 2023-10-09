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
    @include('layouts.head')

</head>
<body>

    <div class="wrapper">

        <!--preloader -->
        <div id="pre-loader">
            <img src="{{ URL::asset('assets/images/pre-loader/loader-01.svg') }}" alt="">
        </div>
        <!-- preloader -->

        @include('layouts.main-header')

        @include('layouts.main-sidebar')

        <!--Main content -->
        <div class="content-wrapper">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mb-0">
                            {{ __('main.Welcome')}} :<span class="badge text-primary"> {{auth()->user()->Father_Name}} </span>
                        </h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>

            <section style="background-color: #eee;">
                <div class="container py-5">
                    <div class="row ">
                        @foreach($sons as $son)
                            <div class="col-md-8 col-lg-6 col-xl-4">
                                <a href="">
                                    <div class="card text-black mt-2">
                                        @if($son->section_id == 1 || $son->section_id == 2)
                                            <img src="{{URL::asset('assets/images/my_son1.png')}}"/>
                                        @else
                                            <img src="{{URL::asset('assets/images/my_son.jpeg')}}"/>
                                        @endif
                                        <div class="card-body">
                                            <div class="text-center">
                                                <h5 style="font-family: 'Cairo', sans-serif; font-size: 15px" class="card-title ">
                                                    {{$son->name}}</h5>
                                                <p class="text-muted mb-4">معلومات الطالب</p>
                                            </div>
                                            <div>
                                                <div class="d-flex justify-content-between">
                                                    <span>المرحلة</span><span>{{$son->grade->name}}</span>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <span>الصف</span><span>{{$son->class->name}}</span>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <span>القسم</span><span>{{$son->section->name}}</span>
                                                </div>

                                                <div class="d-flex justify-content-between">
                                                    @php $sonDegree = $son->degrees->count()  @endphp
                                               @if( $sonDegree == 0)
                                                  <span>عدد الاختبارات</span>
                                                    <span class="text-danger">{{$sonDegree}}</span>
                                               @else
                                                 <span>عدد الاختبارات</span>
                                                    <span class="text-success">{{$sonDegree}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>


            <!--footer -->

            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--footer -->

    @include('layouts.footer-scripts')

</body>

</html>
