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
                                        {{-- 2 --}}
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
                                        </tbody>
                                    </table>
                                </div>

                                {{-- Student Attachment --}}
                                <div class="tab-pane fade" id="profile-02" role="tabpanel"
                                     aria-labelledby="profile-02-tab">
                                    <div class="card card-statistics">
                                        {{-- Add New Attachment --}}
                                        <div class="card-body mb-2">
                                            <form method="post" action="{{route('students.upload_attachment',['student'=>$student->id])}}" enctype="multipart/form-data" >
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
                                                           href="{{route('students.download_attachment',['student_name'=>$attachment->imageable->name , 'file_name'=>$attachment->file_name ])}}"
                                                           role="button"><i class="fa fa-download"></i>&nbsp; {{trans('Students_trans.Download')}}
                                                        </a>
                                                        {{--Delete Attachment--}}
                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                                data-toggle="modal" data-target="#Delete_img{{ $attachment->id }}"
                                                                title="{{ trans('Students_trans.Delete_attachment') }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>

                                                    </td>
                                                </tr>
                                               @include('pages.students.modal.delete_image')
                                            @endforeach
                                            </tbody>
                                        </table>
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
