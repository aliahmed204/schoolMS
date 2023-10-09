@extends('layouts.master')

@section('title')
    {{ __('grades.title_page') }}
@stop

@section('PageTitle')
    {{__('grades.title_page')}}
@stop

@section('content')

    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                @if($errors->any())
                        <div class="alert alert-danger font-bold col-6 text-center">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="button" class="button x-small mb-2" data-toggle="modal" data-target="#exampleModal">
                        {{ __('grades.add_Grade') }}
                    </button>
                    <div class="table-responsive">
                        <table id="datatable1" class="table  table-hover table-sm table-bordered p-0" data-page-length="10" style="text-align: center">
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
                                @include('pages.grades.modal.edit')
                            <!-- edit_modal_Grade -->

                            <!-- delete_modal_Grade -->
                                @include('pages.grades.modal.delete')
                            <!-- delete_modal_Grade -->

                            @empty
                                <td colspan="4"><div class="alert alert-info text-center"> {{ __('grades.empty') }}</div></td>
                            @endforelse

                        </table>
                        <div class="{{ app()->getLocale() == 'ar' ? 'pull-left' : 'pull-right'}}">
                                {{$grades->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- add_Grade_modal -->
        @include('pages.grades.modal.add')
        <!-- add_Grade_modal -->
    </div>
    <!-- row closed -->
@endsection

@section('js')

        @if(session()->has('hasChild'))
            <script>
                toastr.options = {
                "progressBar": true ,
                'closeButton': true,
                };
            toastr.error("{{ __('grades.delete_Grade_Error')}}" );
            </script>
        @endif
@endsection
