@extends('layouts.master')

@section('title')
    {{ trans('setting.setting_list') }}
@stop
@section('PageTitle')
    {{ trans('setting.setting_list') }}
@stop
@section('content')

    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-md-10 ml-5 mt-4">
                <div class="card mb-4">
                <div class="card-body col-md-10">
                <form method="post" action="{{route('settings.update')}}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="row text-center">
                        <div class="col-md-12 border-right-2 border-right-blue-400">

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label font-weight-semibold">{{ trans('setting.school_name') }}<span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input name="school_name" value="{{ $setting['school_name'] }}" required
                                           type="text" class="form-control" placeholder="Name of School">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="current_session" class="col-md-3 col-form-label font-weight-semibold">{{ trans('setting.current_session') }}<span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select data-placeholder="Choose..." required name="current_session" id="current_session" class="custom-select mr-sm-2">
                                        <option value=""></option>
                                        @for($y=date('Y', strtotime('- 3 years')); $y<=date('Y', strtotime('+ 1 years')); $y++)
                                            <option {{ ($setting['current_session'] == (($y-=1).'-'.($y+=1))) ? 'selected' : '' }}>{{ ($y-=1).'-'.($y+=1) }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label font-weight-semibold">{{ trans('setting.school_title') }}</label>
                                <div class="col-md-9">
                                    <input name="school_title" value="{{ $setting['school_title'] }}" type="text" class="form-control" placeholder="School Acronym">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label font-weight-semibold">{{ trans('setting.school_phone') }}</label>
                                <div class="col-md-9">
                                    <input name="phone" value="{{ $setting['phone'] }}" type="text" class="form-control" placeholder="Phone">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label font-weight-semibold">{{ trans('setting.school_email') }}</label>
                                <div class="col-md-9">
                                    <input name="school_email" value="{{ $setting['school_email'] }}" type="email" class="form-control" placeholder="School Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label font-weight-semibold">{{ trans('setting.school_address') }}<span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input required name="address" value="{{ $setting['address'] }}" type="text" class="form-control" placeholder="School Address">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label font-weight-semibold">{{ trans('setting.end_first_term') }} </label>
                                <div class="col-md-9">
                                    <input name="end_first_term" value="{{ $setting['end_first_term'] }}" type="text" class="form-control date-pick" placeholder="Date Term Ends">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label font-weight-semibold">{{ trans('setting.end_second_term') }}</label>
                                <div class="col-md-9">
                                    <input name="end_second_term" value="{{ $setting['end_second_term'] }}" type="text" class="form-control date-pick" placeholder="Date Term Ends">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label font-weight-semibold">{{ trans('setting.school_logo') }}</label>
                                <div class="col-md-9">
                                    <div class="mb-3">
                                        <img style="width: 100px" height="100px"
                                             src="{{ URL::asset('attachments/setting/'.$setting['logo']) }}"
                                             alt="{{ trans('setting.school_logo') }}">
                                    </div>
                                    <input name="logo" accept="image/*" type="file" class="file-input" data-show-caption="false" data-show-upload="false" data-fouc>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Students_trans.submit')}}</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
    @if(session()->has('updated'))
        <script>
            toastr.options = {
                "progressBar": true ,
                'closeButton': true,
            };
            toastr.info("{{ __('messages.Update')}}" );
        </script>
    @endif
@endsection
