@extends('layouts.master')

@section('css')
@endsection
@section('title')
    {{ __('main.edit_student') }}
@stop
@section('PageTitle')
    {{trans('main.edit_student')}}
@stop
@section('content')

    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form method="POST" action="{{ route('students.update',['student'=>$student->id]) }}" autocomplete="off">
                        @csrf
                        @method('patch')
                        <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{trans('Students_trans.personal_information')}}</h6><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Students_trans.name_ar')}} : <span class="text-danger">*</span></label>
                                    <input  type="text" name="name_ar" value="{{$student->getTranslation('name','ar')}}" class="form-control">
                                    @error('name_ar')
                                         <span class="badge text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Students_trans.name_en')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="name_en" value="{{$student->getTranslation('name','en')}}" type="text" >
                                    @error('name_en')
                                        <span class="badge text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Students_trans.email')}} : </label>
                                    <input type="email"  name="email" value="{{$student->email}}" class="form-control" >
                                    @error('email')
                                    <span class="badge text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Students_trans.password')}} :</label>
                                    <input  type="password" name="password" class="form-control" >
                                    @error('password')
                                    <span class="badge text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">{{trans('Students_trans.gender')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="gender_id">
                                        <option disabled>{{trans('Parent_trans.Choose')}}...</option>
                                        @foreach($genders as $gender)
                                            <option  value="{{ $gender->id }}"  @selected($student->gender_id == $gender->id) >
                                                {{ $gender->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('gender_id')
                                         <span class="badge text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nal_id">{{trans('Students_trans.Nationality')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="nationality_id">
                                        <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                        @foreach($nationalities as $nationality)
                                            <option  value="{{ $nationality->id }}" @selected($student->nationality_id == $nationality->id)>
                                                {{ $nationality->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('nationality_id')
                                        <span class="badge text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bg_id">{{trans('Students_trans.blood_type')}} : </label>
                                    <select class="custom-select mr-sm-2" name="blood_id">
                                        <option  disabled>{{trans('Parent_trans.Choose')}}...</option>
                                        @foreach($bloods as $type)
                                            <option value="{{ $type->id }}" @selected($student->blood_id == $type->id) >
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('nationality_id')
                                         <span class="badge text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('Students_trans.Date_of_Birth')}}  :</label>
                                    <input class="form-control" type="text"  id="datepicker-action" value="{{$student->date_of_birth}}" name="date_of_birth" data-date-format="yyyy-mm-dd">
                                    @error('date_of_birth')
                                        <span class="badge text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <h6 >{{trans('Students_trans.Student_information')}}</h6><br>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="grade_id">{{trans('Students_trans.Grade')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="grade_id">
                                        <option  disabled>{{trans('Parent_trans.Choose')}}...</option>

                                        @foreach($grades as $grade)
                                            <option  value="{{ $grade->id }}" @selected($student->grade_id == $grade->id)>
                                                {{ $grade->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('grade_id')
                                         <span class="badge text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2" >
                                <div class="form-group" id="classSelectContainer" >
                                    <label for="class_id">{{trans('Students_trans.classrooms')}} : <span class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="class_id" >
                                                {{--<option>Ajax</option>--}}
                                        <option value="{{$student->class_id}}">{{$student->class->name}}</option>
                                    </select>
                                    @error('class_id')
                                    <span class="badge text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group" id="sectionSelectContainer">
                                    <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                    <select class="custom-select mr-sm-2" name="section_id">
                                        {{--<option>Ajax</option>--}}
                                        <option value="{{$student->section_id}}">{{$student->section->name}}</option>
                                    </select>
                                    @error('section_id')
                                    <span class="badge text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="parent_id">{{trans('Students_trans.parent')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="parent_id">
                                        <option disabled>{{trans('Parent_trans.Choose')}}...</option>
                                        @foreach($parents as $parent)
                                            <option value="{{ $parent->id }}" @selected($student->parent_id == $parent->id) >{{ $parent->Father_Name }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                         <span class="badge text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="academic_year">{{trans('Students_trans.academic_year')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="academic_year">
                                        <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                        @for($year = date("Y")-1; $year <= date("Y") +1 ; $year++)
                                            <option value="{{ $year}}"  @selected($year == $student->academic_year)>{{ $year }}</option>
                                        @endfor
                                    </select>
                                    @error('parent_id')
                                         <span class="badge text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div><br>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Students_trans.submit')}}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection


