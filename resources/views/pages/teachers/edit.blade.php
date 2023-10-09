@extends('layouts.master')

@section('css') @endsection

@section('title')
    {{ __('Teacher_trans.Edit_Teacher') }}
@stop
@section('PageTitle')
    {{__('Teacher_trans.Edit_Teacher')}}
@stop
@section('content')

    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('teachers.update',['teacher'=>$teacher->id])}}" method="post">
                                @csrf
                                @method('patch')
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('Teacher_trans.Email')}}</label>
                                        <input type="email" name="email" value="{{$teacher->email}}" class="form-control">
                                        @error('email')
                                            <span class="badge text-danger">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{trans('Teacher_trans.Password')}}</label>
                                        <input type="password" name="password"  class="form-control">
                                        @error('password')
                                            <span class="badge text-danger">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('Teacher_trans.Name_ar')}}</label>
                                        <input type="text" name="name_ar"  value="{{$teacher->getTranslation('name','ar')}}" class="form-control">
                                        @error('name_ar')
                                            <span class="badge text-danger">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{trans('Teacher_trans.Name_en')}}</label>
                                        <input type="text" name="name_en" value="{{$teacher->getTranslation('name','en')}}" class="form-control">
                                        @error('name_en')
                                            <span class="badge text-danger">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputCity">{{trans('Teacher_trans.specialization')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="specialization_id">
                                            <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                            @foreach($specializations as $specialization)
                                                <option value="{{$specialization->id}}" @selected($teacher->specialization_id == $specialization->id )>
                                                    {{$specialization->name}}/{{$specialization->id}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('specialization_id')
                                             <span class="badge text-danger">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col">
                                        <label for="inputState">{{trans('Teacher_trans.Gender')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="gender_id">
                                            <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                            @foreach($genders as $gender)
                                                <option value="{{$gender->id}}" @selected($teacher->gender_id == $gender->id )>
                                                    {{$gender->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('gender_id')
                                             <span class="badge text-danger">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('Teacher_trans.Joining_Date')}}</label>
                                        <div class='input-group date'>
                                            <input class="form-control" type="text" value="{{$teacher->joining_date}}" id="datepicker-action" name="joining_date" data-date-format="yyyy-mm-dd"  required>
                                        </div>
                                        @error('joining_date')
                                            <span class="badge text-danger">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">{{trans('Teacher_trans.Address')}}</label>
                                    <textarea class="form-control" name="address"
                                              id="exampleFormControlTextarea1" rows="4">{{$teacher->address}}</textarea>
                                    @error('address')
                                         <span class="badge text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <button class="btn btn-success nextBtn btn-lg {{(App::getLocale() == 'ar') ? "pull-left" : "pull-right"}} " type="submit">
                                    {{trans('Teacher_trans.Edit_Teacher')}}
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection

@section('js')

        @if(session()->has('updated'))
            <script>
                toastr.options = {
                "progressBar": true ,
                'closeButton': true,
                 };
                toastr.info("{{ __('messages.Update')}}" );
            </script>
        @endif

@endsection
