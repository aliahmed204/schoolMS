<div>
    {{-- Success is as dangerous as failure. --}}

    Success is as dangerous as failure.

        <!-- row -->
        <div class="row">
            <div class="col-xl-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <h5 class="card-title" >{{$data[$counter]->title}}  </h5>

                        @foreach(preg_split('/(-)/',$data[$counter]->answers) as $index=>$answer)
                           <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio{{$index}}" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio{{$index}}" wire:click="nextQuestion({{$data[$counter]->id}} ,{{$data[$counter]->score}},'{{$answer}}','{{$data[$counter]->right_answer}}')">{{$answer}}</label>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->


</div>
