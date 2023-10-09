@extends('layouts.master')

@section('title')
    {{trans('Students_trans.Student_details')}}
@stop


@section('PageTitle')
    {{trans('Students_trans.Student_details')}}
@stop


@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="card-body">
                        <div class="tab nav-border">
                            <ul class="nav nav-tabs" role="tablist">
                                {{-- Student Inforamtion --}}
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                       role="tab" aria-controls="home-02"
                                       aria-selected="true">{{trans('Students_trans.Student_details')}}</a>
                                </li>
                                {{-- Student Attachment --}}
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                       role="tab" aria-controls="profile-02"
                                       aria-selected="false">{{trans('Students_trans.Attachments')}}</a>
                                </li>

                                {{-- edit --}}
                                <li class="nav-item">
                                    <a class="nav-link" id="home-03-tab" data-toggle="tab" href="#home-03"
                                       role="tab" aria-controls="home-03"
                                       aria-selected="false">{{trans('Students_trans.edit')}}</a>
                                </li>

                                {{-- show quizzes degrees --}}
                                <li class="nav-item">
                                    <a class="nav-link" id="home-04-tab" data-toggle="tab" href="#home-04"
                                       role="tab" aria-controls="home-04"
                                       aria-selected="false">{{trans('Students_trans.quizzes')}}</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                {{-- Student Inforamtion --}}
                                <div class="tab-pane fade active show mt-3 mb-2" id="home-02" role="tabpanel"
                                     aria-labelledby="home-02-tab">
                                    <table class="table table-striped table-hover" style="text-align:center">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <tbody>
                                        {{-- 1 --}}
                                        <tr>
                                            <th scope="row">{{trans('Students_trans.name')}}</th>
                                            <td><span class="badge badge-info p-2" style="font-size: 18px">{{ $student->name }}</span></td>
                                            <th scope="row">{{trans('Students_trans.email')}}</th>
                                            <td>{{$student->email}}</td>
                                        </tr>
                                        {{-- 2 --}}
                                        <tr>
                                            <th scope="row">{{trans('Students_trans.gender')}}</th>
                                            <td>{{$student->gender->name}}</td>
                                            <th scope="row">{{trans('Students_trans.Nationality')}}</th>
                                            <td>{{$student->nationality->name}}</td>
                                        </tr>
                                        {{-- 2 --}}
                                        <tr>
                                            <th scope="row">{{trans('Students_trans.Grade')}}</th>
                                            <td>{{ $student->grade->name }}</td>
                                            <th scope="row">{{trans('Students_trans.classrooms')}}</th>
                                            <td>{{$student->class->name}}</td>
                                        </tr>
                                        {{-- 3 --}}
                                        <tr>
                                            <th scope="row">{{trans('Students_trans.section')}}</th>
                                            <td>{{$student->section->name}}</td>
                                            <th scope="row">{{trans('Students_trans.Date_of_Birth')}}</th>
                                            <td>{{ $student->date_of_birth}}</td>
                                        </tr>
                                        {{-- 3 --}}
                                        <tr>
                                            <th scope="row">{{trans('Students_trans.parent')}}</th>
                                            <td>{{ $student->parent->Father_Name}}</td>
                                            <th scope="row">{{trans('Students_trans.academic_year')}}</th>
                                            <td>{{ $student->academic_year }}</td>
                                        </tr>


                                            @forelse($degrees as $degree)
                                                 <tr>
                                                <th scope="row">{{trans('Students_trans.quiz_name')}}</th>
                                                <td>{{ $degree->quiz->name}}</td>
                                                <th scope="row">{{trans('Students_trans.quiz_score')}}</th>
                                                <td>{{ $degree->score }}</td>
                                                 </tr>
                                                @empty
                                            @endforelse



                                        </tbody>
                                    </table>
                                </div>

                                {{-- Student Attachment --}}
                                <div class="tab-pane fade" id="profile-02" role="tabpanel"
                                     aria-labelledby="profile-02-tab">
                                    <div class="card card-statistics">
                                        {{-- Add New Attachment --}}
                                        <div class="card-body mb-2">
                                            <form method="post" action="{{route('parent.children.upload_attachment',['student'=>$student->id])}}" enctype="multipart/form-data" >
                                                @csrf
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="academic_year">{{trans('Students_trans.Attachments')}} : <span class="text-danger">*</span></label>
                                                        <input type="file" accept="image/*" name="photos[]" multiple required>
                                                    </div>
                                                </div>
                                                <button type="submit" class="button button-border x-small">
                                                       {{trans('Students_trans.submit')}}
                                                </button>
                                            </form>
                                        </div>
                                        {{-- /Add New Attachment --}}
                                        {{-- Show Student Attachments --}}
                                        <table class="table center-aligned-table mb-0 table table-hover" style="text-align:center">
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">{{trans('Students_trans.filename')}}</th>
                                                <th scope="col">{{trans('Students_trans.created_at')}}</th>
                                                <th scope="col">{{trans('Students_trans.processes')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($student->images as $attachment)
                                                <tr style='text-align:center;vertical-align:middle'>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$attachment->file_name}}</td>
                                                    <td>{{$attachment->created_at->diffForHumans()}}</td>
                                                    <td colspan="2">
                                                        {{--Download Attachment--}}
                                                        <a class="btn btn-outline-info btn-sm"
                                                           href="{{route('parent.children.download_attachment',['student_name'=>$attachment->imageable->name , 'file_name'=>$attachment->file_name ])}}"
                                                           role="button"><i class="fa fa-download"></i>&nbsp; {{trans('Students_trans.Download')}}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                {{-- Student Profile --}}
                                <div class="tab-pane fade" id="home-03" role="tabpanel"
                                     aria-labelledby="home-02-tab">
                                    <form action="{{route('student.profiles.update',$student->id)}}" method="post">
                                        @csrf
                                        @method('patch')
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{trans('Teacher_trans.Name_ar')}}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">
                                                    <input type="text" name="Name_ar"
                                                           value="{{ $student->getTranslation('name', 'ar') }}"
                                                           class="form-control">
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{trans('Teacher_trans.Name_en')}}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">
                                                    <input type="text" name="Name_en"
                                                           value="{{ $student->getTranslation('name', 'en') }}"
                                                           class="form-control">
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0"> {{trans('Teacher_trans.Password')}}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">
                                                    <input type="password" id="password" class="form-control" name="password">
                                                </p><br><br>
                                                <input type="checkbox" class="form-check-input" onclick="showPass()"
                                                       id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">{{trans('main.showPass')}}</label>
                                            </div>
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-success">{{trans('Students_trans.Edit')}}</button>
                                    </form>
                                </div>

                                {{-- Student Profile --}}
                                <div class="tab-pane fade" id="home-04" role="tabpanel" aria-labelledby="home-04-tab">
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
                                                                <th>اسم الطالب</th>
                                                                <th>اخر سؤال</th>
                                                                <th>الدرجة</th>
                                                                <th>تلاعب</th>
                                                                <th>تاريخ اجراء الاختبار</th>
                                                                <th>العمليات</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($degrees as $degree)
                                                                <tr>
                                                                    <td>{{ $loop->iteration}}</td>
                                                                    <td>{{$degree->student->name}}</td>
                                                                    <td>{{$degree->question->title}}</td>
                                                                    <td>{{$degree->score}}</td>
                                                                    @if($degree->abuse == 0)
                                                                        <td>
                                                                            <span class="badge badge-success"> لا يوجد تلاعب </span>
                                                                        </td>
                                                                    @else
                                                                        <td>
                                                                            <span class="badge badge-danger"> يوجد تلاعب </span>
                                                                        </td><
                                                                    @endif
                                                                    <td>{{$degree->date}}</td>
                                                                    <td>

                                                                        {{--show students--}}
                                                                        <a href="{{route('parent.children.student_answers', [$degree->quiz_id ,$degree->student_id] )}}" class="btn btn-primary btn-sm"
                                                                           title="{{ __('quiz.qustion') }}" role="button" aria-pressed="true">
                                                                            <i class="fa fa-eye"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                        {{--<div class="{{ app()->getLocale() == 'ar' ? 'pull-left' : 'pull-right'}}">
                                                            {{$degrees->links()}}
                                                        </div>--}}
                                                    </div>
                                                </div>
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
    @if(session()->has('imageDeleted'))
        <script>
            toastr.options = {
                "progressBar": true ,
                'closeButton': true,
            };
            toastr.warning("{{ __('messages.image_deleted')}}");
        </script>
    @endif
@endsection
