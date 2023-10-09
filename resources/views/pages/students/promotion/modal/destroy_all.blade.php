<!-- Deleted inFormation Student -->
<div class="modal fade" id="destroy_all" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">تراجع الكل</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('promotions.rollbackPromotion')}}" method="post">
                    @csrf
                    @method('DELETE')

                    <input type="hidden" name="page_id" value="1">
                    <h5 style="font-family: 'Cairo', sans-serif;">هل انت متاك من عملية تراجع كافة الطلاب ؟</h5>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="inputState">{{trans('Students_trans.Grade')}}</label>
                            <select class="custom-select mr-sm-2" name="new_grade" >
                                <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                @foreach($grades as $grade)
                                    <option value="{{$grade->id}}">{{$grade->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="new_class">{{trans('Students_trans.classrooms')}}:</label>
                            <select class="custom-select mr-sm-2" name="new_class" >

                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="section_id">{{trans('Students_trans.section')}}:</label>
                            <select class="custom-select mr-sm-2" name="new_section" >

                            </select>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="academic_year">{{trans('Students_trans.academic_year')}}:</label>
                                <select class="custom-select mr-sm-2" name="to_academic_year">
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @for($year = date("Y")-1; $year <= date("Y") +1 ; $year++)
                                        <option value="{{ $year}}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Students_trans.Close')}}</button>
                        <button  class="btn btn-danger">{{trans('Students_trans.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
