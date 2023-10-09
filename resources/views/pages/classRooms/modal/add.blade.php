<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('classRooms.add_class') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class=" row mb-30" action="{{ route('classRooms.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="repeater">
                            <!-- container for data  multiple values-->
                            <div data-repeater-list="classes_list" > <!-- container for data  -->
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
                                                    <option selected hidden>{{ __('grades.select') }}</option>
                                                    @foreach ($grades as $grade)
                                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label for="Name_en" class="mr-sm-2 mt-2">{{ trans('classRooms.Processes') }}:</label>
                                            <input class="btn btn-danger btn-block" data-repeater-delete type="button" value="{{ trans('classRooms.delete_row') }}" />
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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('classRooms.Close') }}</button>
                                <button type="submit" class="btn btn-success">{{ trans('classRooms.submit') }}</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>


        </div>

    </div>

</div>
