@extends('layouts.master')

@section('title')
    {{ __('main.Teacher_Profile') }}
@stop
@section('PageTitle')
    {{__('main.Teacher_Profile')}}
@stop

@section('content')
    <!-- row -->
    <div class="card-body ">
        <section style="background-color: #eee;" >
            <div class="row">
                <div class="col-lg-4 ">
                    <div class="card mb-4 mt-4 ">
                        <div class="card-body text-center">
                            <img src="{{URL::asset('assets/images/teacher.png')}}"
                                 alt="avatar"
                                 class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 style="font-family: Cairo,emoji" class="my-3">{{$teacher->Father_Name}}</h5>
                            <p class="text-muted mb-1">{{$teacher->email}}</p>
                            <p class="text-muted mb-2">{{trans('Teacher_trans.teacher')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4 mt-4 ">
                        <div class="card-body">
                            <form action="{{route('parent.profiles.update',$teacher->id)}}" method="post">
                                @csrf
                                @method('patch')
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">{{trans('Teacher_trans.Name_ar')}}</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            <input type="text" name="Name_ar"
                                                   value="{{ $teacher->getTranslation('Father_Name', 'ar') }}"
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
                                                   value="{{ $teacher->getTranslation('Father_Name', 'en') }}"
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
                                <button type="submit" class="btn btn-success">{{trans('Teacher_trans.Edit_Teacher')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- row closed -->
@endsection
@section('js')

    <script>
        function showPass() {
            var pass = document.getElementById("password");
            if (pass.type === "password") {
                pass.type = "text";
            } else {
                pass.type = "password";
            }
        }
    </script>
@endsection
