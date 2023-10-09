@extends('layouts.master')

@section('css')
@endsection

@section('title')
    {{ __('classRooms.title_page') }}
@stop
@section('PageTitle')
    {{__('classRooms.title_page')}}
@stop
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
                        <table id="datatable1" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
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
                            {{--For Filtration--}}
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
                                @include('pages.classRooms.modal.edit')
                                <!-- edit_modal -->

                                <!-- delete_modal -->
                                @include('pages.classRooms.modal.delete')
                                <!-- delete_modal -->

                            @empty
                                <td colspan="5"><div class="alert alert-info font-bold text-center"> {{ __('classRooms.empty') }}</div></td>
                            @endforelse
                        </table>
                        <div class="{{ app()->getLocale() == 'ar' ? 'pull-left' : 'pull-right'}}">
                            {{$classes->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- add_modal -->
        @include('pages.classRooms.modal.add')
        <!-- add_modal -->
    </div>


    <!-- delete selected -->
    @include('pages.classRooms.modal.deleteSelected')




@endsection

@section('js')
    {{--/*Check-ALl*/--}}
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

        {{--get IDS to Destroy --}}
    <script type="text/javascript">
        $(function() {
            $("#btn_delete_all").click(function() {
                console.log('here');
                let selected = [];
                $("#datatable1 input[type=checkbox]:checked").each(function() {
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
