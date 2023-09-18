@if($currentStep == 1) {{-- will show only in step one{1} --}}
<div class="row setup-content" id="step-1">
    <div class="col-xs-12">
        <div class="col-md-12">
            <br>
            <div class="form-row">
                <div class="col">
                    <label for="title">{{trans('Parent_trans.Email')}}</label>
                    <input type="email" wire:model="Email"  class="form-control">
                    @error('Email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="title">{{trans('Parent_trans.Password')}}</label>
                    <input type="password" wire:model="Password" class="form-control" >
                    @error('Password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <label for="title">{{trans('Parent_trans.Name_Father')}}</label>
                    <input type="text" wire:model="Father_Name" class="form-control" >
                    @error('Father_Name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="title">{{trans('Parent_trans.Name_Father_en')}}</label>
                    <input type="text" wire:model="Father_Name_en" class="form-control" >
                    @error('Father_Name_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3">
                    <label for="title">{{trans('Parent_trans.Job_Father')}}</label>
                    <input type="text" wire:model="Father_Job" class="form-control">
                    @error('Father_Job')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="title">{{trans('Parent_trans.Job_Father_en')}}</label>
                    <input type="text" wire:model="Father_Job_en" class="form-control">
                    @error('Father_Job_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col">
                    <label for="title">{{trans('Parent_trans.National_ID_Father')}}</label>
                    <input type="text" wire:model="Father_National_ID" class="form-control">
                    @error('Father_National_ID')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="title">{{trans('Parent_trans.Passport_ID_Father')}}</label>
                    <input type="text" wire:model="Father_Passport_ID" class="form-control">
                    @error('Father_Passport_ID')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col">
                    <label for="title">{{trans('Parent_trans.Phone_Father')}}</label>
                    <input type="text" wire:model="Father_Phone" class="form-control">
                    @error('Father_Phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
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
                    @error('Father_Nationality')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="inputState">{{trans('Parent_trans.Blood_Type_Father_id')}}</label>
                    <select class="custom-select my-1 mr-sm-2" wire:model="Father_Blood_Type">
                        <option selected>{{trans('Parent_trans.Choose')}}...</option>
                        @foreach($Type_Bloods as $Type_Blood)
                        <option value="{{$Type_Blood->id}}">{{$Type_Blood->name}}</option>
                        @endforeach
                    </select>
                    @error('Father_Blood_Type')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="inputZip">{{trans('Parent_trans.Religion_Father_id')}}</label>
                    <select class="custom-select my-1 mr-sm-2" wire:model="Father_Religion">
                        <option selected>{{trans('Parent_trans.Choose')}}...</option>
                        @foreach($Religions as $Religion)
                        <option value="{{$Religion->id}}">{{$Religion->name}}</option>
                        @endforeach
                    </select>
                    @error('Father_Religion')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="form-group">
                <label for="exampleFormControlTextarea1">{{trans('Parent_trans.Address_Father')}}</label>
                <textarea class="form-control" wire:model="Father_Address" id="exampleFormControlTextarea1" rows="4"></textarea>
                @error('Father_Address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            @if(isset($updateMode))
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




