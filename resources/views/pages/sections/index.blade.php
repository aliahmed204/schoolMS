@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('title')
    {{ __('sections.title_page') }}
@stop

@section('page-header')
    <div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('sections.title_page') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{ __('sections.title_page') }}</li>
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

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                        {{-- Add New Section--}}
                    <button type="button" class="button x-small mb-3" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('sections.add_section') }}
                    </button>


                <div class="accordion gray plus-icon round">
                    {{--Every Grade Has its Own Sections--}}
                @forelse($grades as $grade)
                    <div class="acd-group">
                        <a href="#" class="acd-heading">{{ $grade->name }}</a>
                        <div class="acd-des">
                            <div class="row">
                                <div class="col-xl-12 mb-30">
                                    <div class="card card-statistics h-100">
                                        <div class="card-body">
                                            <div class="d-block d-md-flex justify-content-between">
                                                <div class="d-block"></div>
                                            </div>
                                            <div class="table-responsive mt-15">
                                                <table class="table center-aligned-table mb-0">
                                                    <thead>
                                                    <tr class="text-dark">
                                                        <th>#</th>
                                                        <th>{{ trans('sections.Name_Section') }}</th>
                                                        <th>{{ trans('sections.Name_Class') }}</th>
                                                        <th>{{ trans('sections.Status') }}</th>
                                                        <th>{{ trans('sections.Processes') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    {{-- SECTIONS IN GRADE THROW RELATION grade->hasMany('sectoins')--}}
                                                    @forelse ($grade->sections as $section)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $section->name }}</td>
                                                            <td>{{ $section->class->name }}
                                                            </td>
                                                            <td>
                                                                @if ($section->status === '1') {{-- Active --}}
                                                                    <label class="badge badge-success">{{ trans('sections.Status_Section_AC') }}</label>
                                                                @else {{-- Disblaed --}}
                                                                    <label class="badge badge-danger">{{ trans('sections.Status_Section_No') }}</label>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                {{-- Edit --}}
                                                                <a href="#" class="btn btn-outline-info btn-sm" data-toggle="modal"
                                                                   data-target="#edit{{ $section->id }}">{{ trans('sections.Edit') }}</a>
                                                                {{-- Delete --}}
                                                                <a href="#" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                                   data-target="#delete{{ $section->id }}">{{ trans('sections.Delete') }}</a>
                                                            </td>
                                                        </tr>

                                                        <!--Edit Section -->
                                                        <div class="modal fade" id="edit{{ $section->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                                                                            {{ trans('sections.edit_Section') }}
                                                                        </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ route('sections.update', ['section'=>$section->id ]) }}" method="POST">
                                                                            @method('put')
                                                                            @csrf
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <input type="text" name="name_ar" class="form-control"
                                                                                           value="{{ $section->getTranslation('name', 'ar') }}" />
                                                                                </div>
                                                                                <div class="col">
                                                                                    <input type="text" name="name" class="form-control"
                                                                                           value="{{ $section->getTranslation('name', 'en') }}" />
                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                            <div class="col">
                                                                                <label for="inputName" class="control-label">{{ trans('sections.Name_Grade') }}</label>
                                                                                <select name="grade_id" class="custom-select" >
                                                                                    <option disabled>
                                                                                        {{ __('sections.Select_Grade') }}
                                                                                    </option>
                                                                                    @foreach ($grades as $grade)
                                                                                        <option value="{{ $grade->id }}"  @selected($grade->id == $section->grade_id)>
                                                                                            {{ $grade->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <br>

                                                                            <div class="col">
                                                                                <label for="inputName" class="control-label">{{ trans('sections.name') }}</label>
                                                                                <select name="class_id" class="custom-select">
                                                                                    <option value="{{ $section->class->id }}">
                                                                                        {{ $section->class->name }} {{-- And Other Options Are Related to Ajax --}}
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                            <br>

                                                                            <div class="col">
                                                                                <div class="form-check">
                                                                                    @if ($section->status === ' ')
                                                                                        <input type="checkbox"  checked class="form-check-input" name="status" id="exampleCheck1">
                                                                                    @else
                                                                                        <input type="checkbox"  class="form-check-input" name="status" id="exampleCheck1">
                                                                                    @endif
                                                                                    <label class="form-check-label" for="exampleCheck1">{{ trans('sections.Status') }}</label>
                                                                                </div>
                                                                            </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                            {{ trans('sections.Close') }}
                                                                        </button>
                                                                        <button type="submit" class="btn btn-danger">
                                                                            {{ trans('sections.submit') }}
                                                                        </button>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- delete_modal_Grade -->
                                                        <div class="modal fade" id="delete{{ $section->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                                            {{ trans('sections.delete_Section') }}
                                                                        </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ route('sections.destroy', ['section'=>$section->id]) }}" method="post">
                                                                            @method('delete')
                                                                            @csrf
                                                                            {{ trans('sections.Warning_Section') }}
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                                    {{ trans('sections.Close') }}
                                                                                </button>
                                                                                <button type="submit" class="btn btn-danger">
                                                                                    {{ trans('sections.submit') }}
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        @empty  {{--Empty Sections--}}
                                                            <td colspan="5"><div class="alert alert-info"> {{ __('sections.empty') }}</div></td>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty {{--Empty Grades--}}
                            <div class="alert alert-info"> {{ __('grades.empty') }}</div>
                        @endforelse
                    </div>
                </div>
                </div>
            </div>
        </div>


        <!-- add_modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                            {{ trans('sections.add_class') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('sections.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="name_ar" class="form-control"
                                           placeholder="{{ trans('sections.Section_name_ar') }}" />
                                </div>
                                <div class="col">
                                    <input type="text" name="name" class="form-control"
                                           placeholder="{{ trans('sections.Section_name_en') }}">
                                </div>
                            </div>
                            <br>
                            <div class="col">
                                <label for="inputName" class="control-label">
                                    {{ trans('sections.Name_Grade') }}
                                </label>
                                <select name="grade_id" class="custom-select" onchange="console.log($(this).val())">
                                    <option  selected disabled>   {{--Grade_id --}}
                                        {{ trans('sections.Select_Grade') }}
                                    </option>
                                    @foreach ($allGrades as $grade)
                                        <option value="{{ $grade->id }}">
                                            {{ $grade->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div class="col">
                                <label for="inputName" class="control-label">
                                    {{ trans('sections.Name_Class') }}
                                </label>
                                <select name="class_id" class="custom-select">
                                     {{--would complete By ajax --}}
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('sections.Close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('sections.submit') }}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>



@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

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
            $(document).ready(function () {
                $('select[name="grade_id"]').on('change', function () {
                    var Grade_id = $(this).val();
                    if (Grade_id) {
                        $.ajax({
                            url: "{{ URL::to('sections/getClasses') }}/"+Grade_id,
                            type: "GET",
                            dataType: "json",
                            success: function (data) {
                                $('select[name="class_id"]').empty();
                                $.each(data, function (key, value) {
                                    $('select[name="class_id"]').append('<option value="' + key + '">' + value + '</option>');
                                });
                            },
                        });
                    } else {
                        console.log('AJAX load did not work');
                    }
                });
            });

        </script>

@endsection
