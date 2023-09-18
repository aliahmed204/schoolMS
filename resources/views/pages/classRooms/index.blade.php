@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('title')
    {{ __('classRooms.title_page') }}
@stop

@section('page-header')
    <div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('classRooms.title_page') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{ __('classRooms.title_page') }}</li>
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

                        {{-- Add New CLassRoom--}}
                    <button type="button" class="button x-small mb-2" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('classRooms.add_class') }}
                    </button>

                    {{-- Delete Selected--}}
                    <button type="button" class="button x-small mb-2"  id="btn_delete_all">
                        {{ trans('classRooms.delete_checkbox') }}
                    </button>

                    {{-- Filter Classes--}}
                    <form action="{{route('classRooms.filterClasses')}}" method="get">
                        @csrf
                        <select class="fancyselect mb-2 btn-outline-primary"  data-style="btn btn-info" name="grade_id" required onchange="this.form.submit()">
                            <option value="" selected disabled>{{ trans('classRooms.Search_By_Grade') }}</option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                            @endforeach
                        </select>
                    </form>



                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th style="width: 12px">
                                    <input type="checkbox" name="select_all" id="select_all" onclick="checkAll('box', this)">
                                </th>
                                <th>#</th>
                                <th>{{ __('classRooms.Name_class') }}</th>
                                <th>{{ __('classRooms.Name_Grade') }}</th>
                                <th>{{ __('classRooms.Processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($details))
                               @php $classes = $details @endphp
                            @endif

                            @forelse ($classes as $class)
                                <tr>
                                    <td>
                                        <input type="checkbox" value="{{$class->id}}" class="box">
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $class->name }}</td>
                                    <td>{{ $class->grade->name }}</td>
                                    <td>
                                        <!-- edit_button -->
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $class->id }}"
                                                title="{{ trans('classRooms.Edit') }}">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <!-- Delete_button -->
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $class->id }}"
                                                title="{{ trans('classRooms.Delete') }}">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                    </td>
                                </tr>

                            <!-- edit_modal -->
                                <div class="modal fade" id="edit{{ $class->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                    {{ trans('classRooms.edit_Grade') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!--form -->
                                                <form action="{{ route('classRooms.update', [ 'classRoom' => $class->id] ) }}" method="post">
                                                    @method('put')
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="Name" class="mr-sm-2">{{ trans('classRooms.stage_name_ar') }}:</label>
                                                            <input id="Name" type="text" name="name_ar" class="form-control"
                                                                   value="{{ $class->getTranslation('name','ar') }}" required>
                                                        </div>
                                                        <div class="col">
                                                            <label for="Name_en" class="mr-sm-2">{{ trans('classRooms.stage_name_en') }}:</label>
                                                            <input type="text" class="form-control"
                                                                   value="{{$class->getTranslation('name' ,'en')}}" name="name" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Name_en" class="mr-sm-2">{{ trans('classRooms.Name_Grade') }}:</label>
                                                        <div class="box">

                                                            <select class="fancyselect" name="grade_id">
                                                                @foreach ($grades as $grade)
                                                                    <option value="{{ $grade->id }}" @selected($class->grade_id == $grade->id) >
                                                                        {{ $grade->name }}
                                                                    </option>

                                                                @endforeach
                                                            </select>

                                                        </div>
                                                    </div>
                                                    <br><br>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('classRooms.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-success">{{ trans('classRooms.submit') }}</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- end-edit_ -->

                            <!-- delete_modal -->
                                <div class="modal fade" id="delete{{ $class->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                    {{ trans('classRooms.delete_Grade') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('classRooms.destroy', [ 'classRoom' => $class->id] ) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    {{ trans('classRooms.Warning_Grade') }}
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                            {{ trans('classRooms.Close') }}
                                                        </button>
                                                        <button type="submit" class="btn btn-danger">
                                                            {{ trans('classRooms.submit') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <td colspan="5"><div class="alert alert-info font-bold"> {{ __('classRooms.empty') }}</div></td>

                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- add_modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('classRooms.add_class') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class=" row mb-30" action="{{ route('classRooms.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="repeater">
                                    <div data-repeater-list="classes_list"> <!-- container for data  -->
                                        <div data-repeater-item>
                                            <div class="row">
                                                <div class="col">  <!-- name_ar -->
                                                    <label for="Name" class="mr-sm-2">{{ trans('classRooms.Name_class') }}:</label>
                                                    <input class="form-control" type="text" name="name_ar"  />
                                                </div>

                                                <div class="col"> <!-- name en -->
                                                    <label for="Name" class="mr-sm-2">{{ trans('classRooms.Name_class_en') }}:</label>
                                                    <input class="form-control" type="text" name="name"  />
                                                </div>

                                                <div class="col"> <!-- grade_id -->
                                                    <label for="Name_en" class="mr-sm-2">{{ trans('classRooms.Name_Grade') }}:</label>
                                                    <div class="box">
                                                            <select class="fancyselect" name="grade_id">
                                                                <option selected hidden>--Select Grade--</option>
                                                                @foreach ($grades as $grade)
                                                                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                                @endforeach
                                                            </select>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label for="Name_en" class="mr-sm-2 mt-2">{{ trans('classRooms.Processes') }}:</label>
                                                    <input class="btn btn-danger btn-block" data-repeater-delete type="button"
                                                           value="{{ trans('classRooms.delete_row') }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-12">
                                            <input class="button mb-1" data-repeater-create type="button" value="{{ trans('classRooms.add_row') }}"/>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ trans('classRooms.Close') }}</button>
                                        <button type="submit"
                                                class="btn btn-success">{{ trans('classRooms.submit') }}</button>
                                    </div>


                                </div>
                            </div>
                        </form>
                    </div>


                </div>

            </div>

        </div>
    </div>
         <!-- add_modal -->

    <!-- delete selected -->

    <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('classRooms.delete_class') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('classRooms.delete_all') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        {{ trans('classRooms.Warning_Grade') }}
                        <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" >
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('classRooms.Close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('classRooms.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        {{--@if(session()->has('info'))
            toastr.options = {
            "progressBar": true ,
            'closeButton': true,
        };
            toastr.info("{{ __('messages.welcome')}}");
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

    </script>

    <script>

        function checkAll(className , element){
            let elements = document.getElementsByClassName(className);
            let length = elements.length;

            if(element.checked){
                for (let i=0 ; i < length ; i++){
                    elements[i].checked = true ;
                }
            }else{
                for (let i=0 ; i < length ; i++){
                    elements[i].checked = false ;
                }
            }


        }

    </script>

    <script type="text/javascript">
        $(function() {
            $("#btn_delete_all").click(function() {
                let selected = new Array();
                $("#datatable input[type=checkbox]:checked").each(function() {
                    selected.push(this.value);
                });

                if (selected.length > 0) {
                    $('#delete_all').modal('show')
                    $('input[id="delete_all_id"]').val(selected);
                }
            });
        });

    </script>

@endsection
