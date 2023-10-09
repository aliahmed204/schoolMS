
<div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ __('grades.edit_Grade') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                            <input id="Name" type="text" name="name_ar" class="form-control"
                                   value="{{ $grade->getTranslation('name', 'ar') }}" required>
                        </div>
                        <div class="col">
                            <label for="Name_en" class="mr-sm-2">
                                {{ __('grades.stage_name_en') }} :
                            </label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ $grade->getTranslation('name', 'en') }}"  required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">{{ __('grades.Notes') }}:</label>
                        <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3">{{ $grade->notes }}</textarea>
                    </div>
                    <br><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('grades.Close') }}</button>
                        <button type="submit" class="btn btn-success">{{ __('grades.submit') }}</button>
                    </div>
                </form>
                <!-- Update_form -->
            </div>
        </div>
    </div>
</div>
