@if($currentStep == 1) {{-- will show only in step one{1} --}}
<div class="row setup-content " id="step-1">
    <div class="col-md-12 ">
        <div class="col-md-12">
            <br>
            <form wire:submit="save">
            <div class="form-row">
                <div class="col mt-1">
                    <label for="title">{{trans('Parent_trans.Email')}}</label>
                    <input type="email" wire:model.blur="Email"  class="form-control">
                    <div>
                        @error('Email') <span class="badge text-danger">*{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col mt-1">
                    <label for="title">{{trans('Parent_trans.Password')}}</label>
                    <input type="password" wire:model.blur="Password" class="form-control" >
                    <div>
                        @error('Password') <span class="badge text-danger">*{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="form-row mt-2">
                <div class="col ">
                    <label for="title">{{trans('Parent_trans.Name_Father')}}</label>
                    <input type="text" wire:model="Father_Name" class="form-control" >
                    <div>
                        @error('Father_Name') <span class="badge text-danger">*{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col">
                    <label for="title">{{trans('Parent_trans.Name_Father_en')}}</label>
                    <input type="text" wire:model="Father_Name_en" class="form-control" >
                    <div>
                        @error('Father_Name_en') <span class="badge text-danger">*{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="form-row mt-2">
                <div class="col-md-3">
                    <label for="title">{{trans('Parent_trans.Job_Father')}}</label>
                    <input type="text" wire:model="Father_Job" class="form-control">
                    <div>
                        @error('Father_Job') <span class="badge text-danger">*{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="title">{{trans('Parent_trans.Job_Father_en')}}</label>
                    <input type="text" wire:model="Father_Job_en" class="form-control">
                    <div>
                        @error('Father_Job_en') <span class="badge text-danger">*{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col">
                    <label for="title">{{trans('Parent_trans.National_ID_Father')}}</label>
                    <input type="text" wire:model.blur="Father_National_ID" class="form-control">
                    <div>
                        @error('Father_National_ID') <span class="badge text-danger">*{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col">
                    <label for="title">{{trans('Parent_trans.Passport_ID_Father')}}</label>
                    <input type="text" wire:model.blur="Father_Passport_ID" class="form-control">
                    <div>
                        @error('Father_Passport_ID') <span class="badge text-danger">*{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col">
                    <label for="title">{{trans('Parent_trans.Phone_Father')}}</label>
                    <input type="text" wire:model.blur="Father_Phone" class="form-control">
                    <div>
                        @error('Father_Phone') <span class="badge text-danger">*{{ $message }}</span> @enderror
                    </div>
                </div>

            </div>


            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">{{trans('Parent_trans.Nationality_Father_id')}}</label>
                    <select class="custom-select my-1 mr-sm-2" wire:model="Father_Nationality">
                        <option selected>{{trans('Parent_trans.Choose')}}...</option>
                        @foreach($Nationalities as $National)
                        <option value="{{$National->id}}">{{$National->name}}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('Father_Nationality') <span class="badge text-danger">*{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group col">
                    <label for="inputState">{{trans('Parent_trans.Blood_Type_Father_id')}}</label>
                    <select class="custom-select my-1 mr-sm-2" wire:model="Father_Blood_Type">
                        <option selected>{{trans('Parent_trans.Choose')}}...</option>
                        @foreach($Type_Bloods as $Type_Blood)
                        <option value="{{$Type_Blood->id}}">{{$Type_Blood->name}}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('Father_Blood_Type') <span class="badge text-danger">*{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group col">
                    <label for="inputZip">{{trans('Parent_trans.Religion_Father_id')}}</label>
                    <select class="custom-select my-1 mr-sm-2" wire:model="Father_Religion">
                        <option selected>{{trans('Parent_trans.Choose')}}...</option>
                        @foreach($Religions as $Religion)
                        <option value="{{$Religion->id}}">{{$Religion->name}}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('Father_Religion') <span class="badge text-danger">*{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="exampleFormControlTextarea1">{{trans('Parent_trans.Address_Father')}}</label>
                <textarea class="form-control" wire:model="Father_Address" id="exampleFormControlTextarea1" rows="4"></textarea>
                <div>
                    @error('Father_Address') <span class="badge text-danger">*{{ $message }}</span> @enderror
                </div>
            </div>

            @if($updateMode)
            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                    wire:click="firstStepSubmit_edit" type="button">{{trans('Parent_trans.Next')}}
            </button>
            @else
            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                    wire:click="firstStepSubmit" type="button">{{trans('Parent_trans.Next')}}
            </button>
            @endif

        </div>
    </div>
</div>
@endif




