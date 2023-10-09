@extends('layouts.master')

@section('title')
    {{ __('main.edit_fee') }}
@stop

@section('PageTitle')
    {{trans('main.edit_fee')}}
@stop


@section('content')

    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="{{ route('fees.update',['fee'=>$fee->id]) }}" autocomplete="off">
                        @csrf
                        @method('patch')
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4">{{trans('fees.fees_ar')}} </label>
                                <input type="text" value="{{ $fee->getTranslation('title','ar') }}" name="title_ar" class="form-control">
                            </div>

                            <div class="form-group col">
                                <label for="inputEmail4">{{trans('fees.fees_en')}}</label>
                                <input type="text" value="{{ $fee->getTranslation('title','en') }}" name="title_en" class="form-control">
                            </div>


                            <div class="form-group col">
                                <label for="inputEmail4">{{trans('fees.amount')}}</label>
                                <input type="number" value="{{$fee->amount}}" name="amount" class="form-control">
                            </div>
                        </div>


                        <div class="form-row">

                            <div class="form-group col">
                                <label for="inputState"> {{trans('fees.grade')}} </label>
                                <select class="custom-select mr-sm-2" name="grade_id">
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}" @selected($fee->grade_id == $grade->id)>{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="inputZip"> {{trans('fees.class')}}</label>
                                <select class="custom-select mr-sm-2" name="class_id">
                                    <option value="{{ $fee->class_id }}" >{{ $fee->class->name }}</option>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="inputZip"> {{trans('fees.year')}}</label>
                                <select class="custom-select mr-sm-2" name="year">
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @php
                                        $current_year = date("Y")
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}" @selected($fee->year == $year)>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="inputZip"> {{trans('fees.fee_type')}}</label>
                                <select class="custom-select mr-sm-2" name="fee_type">
                                    <option value="1" @selected($fee->fee_type == '1')> {{trans('fees.school_fees')}}</option>
                                    <option value="2" @selected($fee->fee_type == '2')> {{trans('fees.bus_fees')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputAddress">{{trans('fees.description')}}</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4">{{$fee->description}}</textarea>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary">{{trans('fees.submit')}}</button>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection


