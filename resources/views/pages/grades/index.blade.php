@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('title')
    {{ __('grades.title_page') }}
@stop

@section('page-header')
    <!-- breadcrumb -->

    <!-- breadcrumb -->

    <div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('grades.title_page') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{ __('grades.title_page') }}</li>
            </ol>
        </div>
    </div>
    </div>
@endsection
@section('content')

    <!-- row -->
    <div class="row">

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                @if($errors->any())
                        <div class="alert alert-danger font-bold col-6">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    @if(session()->has('success1'))
                       <div class="alert alert-success">
                           {{ session('success1') }}
                       </div>
                    @endif



                    <button type="button" class="button x-small mb-2" data-toggle="modal" data-target="#exampleModal">
                        {{ __('grades.add_Grade') }}
                    </button>
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('grades.Name') }}</th>
                                <th>{{ __('grades.Notes') }}</th>
                                <th>{{ __('grades.Processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($grades as $grade)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $grade->name }}</td>
                                    <td>{{ $grade->notes }}</td>
                                    <td>

                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $grade->id }}"
                                                title="{{ __('grades.Edit') }}">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $grade->id }}"
                                                title="{{ __('grades.Delete') }}">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                    </td>
                                </tr>

                            <!-- edit_modal_Grade -->
                                <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                    {{ __('grades.edit_Grade') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Update_form -->
                                                <form action="{{ route('grades.update', [ 'grade' => $grade->id ]) }}" method="post">
                                                    @method('put')
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="Name" class="mr-sm-2">
                                                                {{ __('grades.stage_name_ar') }}:
                                                            </label>
                                                            <input id="Name" type="text" name="name_ar"
                                                                   class="form-control"
                                                                   value="{{ $grade->getTranslation('name', 'ar') }}"
                                                                   required>
                                                        </div>
                                                        <div class="col">
                                                            <label for="Name_en" class="mr-sm-2">
                                                                {{ __('grades.stage_name_en') }} :
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                   value="{{ $grade->getTranslation('name', 'en') }}"
                                                                   name="name" required />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label
                                                            for="exampleFormControlTextarea1">{{ __('grades.Notes') }}
                                                            :</label>
                                                        <textarea class="form-control" name="notes"
                                                                  id="exampleFormControlTextarea1"
                                                                  rows="3">{{ $grade->notes }}</textarea>
                                                    </div>
                                                    <br><br>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ __('grades.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-success">{{ __('grades.submit') }}</button>
                                                    </div>
                                                </form>
                                                <!-- Update_form -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- edit_modal_Grade -->

                            <!-- delete_modal_Grade -->
                                <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ __('grades.delete_Grade') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('grades.destroy', ['grade'=>$grade->id]) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    {{ __('grades.Warning_Grade') }}
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ __('grades.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">{{ __('grades.submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            @empty
                                <td colspan="4"><div class="alert alert-info"> {{ __('grades.empty') }}</div></td>

                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- add_Grade_modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ __('grades.add_Grade') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- add_form -->
                        <form action="{{ route('grades.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="Name" class="mr-sm-2">{{ __('grades.grade_name_ar') }}
                                        :</label>
                                    <input id="Name" type="text" name="name_ar" class="form-control" />
                                </div>
                                <div class="col">
                                    <label for="Name_en" class="mr-sm-2">{{ __('grades.grade_name_en') }}
                                        :</label>
                                    <input type="text" class="form-control" name="name" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{ __('grades.Notes') }}
                                    :</label>
                                <textarea class="form-control" name="notes" id="exampleFormControlTextarea1"
                                          rows="3"></textarea>
                            </div>
                            <br><br>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ __('grades.Close') }}</button>
                                <button type="submit" class="btn btn-success">{{ __('grades.submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- row closed -->
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        {{--@if(session()->has('info'))
            toastr.options = {
            "progressBar": true ,
            'closeButton': true,
        };
            toastr.info("{{ __('messages.success')}}");
        @endif--}}

        @if(session()->has('success1'))
            toastr.options = {
            "progressBar": true ,
            'closeButton': true,
        };
            toastr.success("{{ __('messages.success')}}");
        @endif

        @if(session()->has('updated'))
            toastr.options = {
            "progressBar": true ,
            'closeButton': true,
            "positionClass": "toast-bottom-right",
        };
            toastr.info("{{ __('messages.Update')}}" );
        @endif

        @if(session()->has('deleted'))
            toastr.options = {
            "progressBar": true ,
            'closeButton': true,
        };
        toastr.warning("{{ __('messages.Delete')}}" );
        @endif

        @if(session()->has('hasChild'))
            toastr.options = {
            "progressBar": true ,
            'closeButton': true,
        };
        toastr.error("{{ __('grades.delete_Grade_Error')}}" );
        @endif


    </script>
@endsection
