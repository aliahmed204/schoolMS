<div>
    {{-- data Saved in Db . --}}
    @if (!empty($success))
        <div class="alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $success }}
        </div>
    @endif
    {{-- data Updated in Db . --}}
    @if (!empty($update))
        <div class="alert alert-info" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $update }}
        </div>
    @endif
    {{-- data Deleted and also Attachment if Exists in Db . --}}
    @if (session()->has('deleted'))
        <div class="alert alert-warning text-center" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ session()->get('deleted') }}
        </div>
    @endif
    {{-- Error In Query . --}}
    @if (!empty($catchError))
        <div class="alert alert-danger" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $catchError }}
        </div>
    @endif
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}


    {{-- show all Parents in DB --}}
    @if($show_table)
        @include('livewire.tables.show-parent')
    @else
        {{-- add-Parents to DB --}}
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <button   wire:click="back(1)" type="button" class="btn btn-circle {{ $currentStep == 1 ? 'btn-success' : 'btn-default' }}">1</button>
                <p>{{ trans('Parent_trans.Step1') }}</p>
            </div>
            <div class="stepwizard-step">
                <button wire:click="back(2)" type="button"
                        class="btn btn-circle {{ $currentStep == 2 ? 'btn-success' : 'btn-default' }}"
                        @if (!$updateMode && $currentStep == 1)  disabled @endif  > 2 </button> {{--Can't Use This to go to Step 2 If we in Step 1 {validation}--}}
                <p>{{ trans('Parent_trans.Step2') }}</p>
            </div>
            <div class="stepwizard-step">
                <button  wire:click="back(3)" type="button"
                         class="btn btn-circle {{ $currentStep == 3 ? 'btn-success' : 'btn-default' }}"
                         @if (!$updateMode && ($currentStep == 1 || $currentStep == 2))  disabled @endif>3</button>
                <p>{{ trans('Parent_trans.Step3') }}</p>
            </div>
        </div>
    </div>
        {{-- Step 1 Father_Form --}}
        @include('livewire.forms.Father_Form')
        {{-- Step 2 Mother_Form --}}
        @include('livewire.forms.Mother_Form')
        {{-- Step 3 Attachments --}}
    <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
        @if ($currentStep != 3)
            <div style="display: none" class="row setup-content" id="step-3">
                @endif
                <div class="col-md-12">
                    <div class="col-md-12"><br>
                        <label style="color: red">{{trans('Parent_trans.Attachments')}}</label>
                        <div class="form-group">
                            <input type="file" wire:model="photos" accept="image/*" multiple>
                        </div>
                        @error('photos.*') <span class="badge text-danger">{{ $message }}</span> @enderror
                        <br>

                        <input type="hidden" wire:model="Parent_id">
                        <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button"
                                wire:click="back(2)">{{ trans('Parent_trans.Back') }}</button> {{--BACK TO STEP 2--}}

                        @if($updateMode)
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="submitForm_update"
                                    type="button">{{trans('Parent_trans.Finish')}}
                            </button>
                        @else
                            <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="submitForm"
                                    type="button">{{ trans('Parent_trans.Finish') }}</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
@endif



</div>


