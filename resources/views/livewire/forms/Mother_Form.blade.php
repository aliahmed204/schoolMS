@if($currentStep == 2)
    <div  class="row setup-content" id="step-2">
        <div class="col-md-12">
            <div class="col-md-12">
                <br>

                <div class="form-row">
                    <div class="col">
                        <label for="title">{{trans('Parent_trans.Name_Mother')}}</label>
                        <input type="text" wire:model="Mother_Name" class="form-control">
                        <div>
                            @error('Mother_Name') <span class="badge text-danger">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label for="title">{{trans('Parent_trans.Name_Mother_en')}}</label>
                        <input type="text" wire:model="Mother_Name_en" class="form-control">
                        <div>
                            @error('Mother_Name_en') <span class="badge text-danger">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="form-row mt-2">
                    <div class="col-md-3">
                        <label for="title">{{trans('Parent_trans.Job_Mother')}}</label>
                        <input type="text" wire:model="Mother_Job" class="form-control">
                        <div>
                        @error('Mother_Job') <span class="badge text-danger">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="title">{{trans('Parent_trans.Job_Mother_en')}}</label>
                        <input type="text" wire:model="Mother_Job_en" class="form-control">
                        <div>
                        @error('Mother_Job_en') <span class="badge text-danger">*{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col">
                        <label for="title">{{trans('Parent_trans.National_ID_Mother')}}</label>
                        <input type="text" wire:model.blur="Mother_National_ID" class="form-control">
                        <div>
                            @error('Mother_National_ID') <span class="badge text-danger">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label for="title">{{trans('Parent_trans.Passport_ID_Mother')}}</label>
                        <input type="text" wire:model.blur="Mother_Passport_ID" class="form-control">
                        <div>
                            @error('Mother_Passport_ID') <span class="badge text-danger">*{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col">
                        <label for="title">{{trans('Parent_trans.Phone_Mother')}}</label>
                        <input type="text" wire:model.blur="Mother_Phone" class="form-control">
                        <div>
                            @error('Mother_Phone') <span class="badge text-danger">*{{ $message }}</span> @enderror
                        </div>
                    </div>

                </div>

                <div class="form-row mt-2">
                    <div class="form-group col-md-6">
                        <label for="inputCity">{{trans('Parent_trans.Nationality_Father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="Mother_Nationality">
                            <option selected>{{trans('Parent_trans.Choose')}}...</option>
                            @foreach($Nationalities as $National)
                                <option value="{{$National->id}}">{{$National->name}}</option>
                            @endforeach
                        </select>
                        <div>
                            @error('Mother_Nationality') <span class="badge text-danger">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group col">
                        <label for="inputState">{{trans('Parent_trans.Blood_Type_Father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="Mother_Blood_Type">
                            <option selected>{{trans('Parent_trans.Choose')}}...</option>
                            @foreach($Type_Bloods as $Type_Blood)
                                <option value="{{$Type_Blood->id}}">{{$Type_Blood->name}}</option>
                            @endforeach
                        </select>
                        <div>
                            @error('Mother_Blood_Type') <span class="badge text-danger">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group col">
                        <label for="inputZip">{{trans('Parent_trans.Religion_Father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="Mother_Religion">
                            <option selected>{{trans('Parent_trans.Choose')}}...</option>
                            @foreach($Religions as $Religion)
                                <option value="{{$Religion->id}}">{{$Religion->name}}</option>
                            @endforeach
                        </select>
                        <div>
                            @error('Mother_Religion') <span class="badge text-danger">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{trans('Parent_trans.Address_Mother')}}</label>
                    <textarea class="form-control" wire:model="Mother_Address" id="exampleFormControlTextarea1" rows="4"></textarea>
                    <div>
                        @error('Mother_Address') <span class="badge text-danger">*{{ $message }}</span> @enderror
                    </div>
                </div>

                <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button" wire:click="back(1)">
                    {{trans('Parent_trans.Back')}}
                </button>

                @if($updateMode)
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right mr-2" wire:click="secondStepSubmit_edit"
                            type="button">{{trans('Parent_trans.Next')}}
                    </button>
                @else
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right ml-2" type="button"
                            wire:click="secondStepSubmit">{{trans('Parent_trans.Next')}}</button>
                @endif

            </div>
        </div>
   </div>


@endif
