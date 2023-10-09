<!-- jquery -->
<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script type="text/javascript">
    var plugin_path = '{{asset('assets/js')}}/';
</script>

<!-- chart -->
<script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>
<!-- calendar -->
<script src="{{ URL::asset('assets/js/calendar.init.js') }}"></script>
<!-- charts sparkline -->
<script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
@yield('js')
<script src="{{ URL::asset('assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ URL::asset('assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>

<script>
    $(document).ready(function () {
        $('select[name="grade_id"]').on('change', function () {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "{{ URL::to('ajax/getClasses') }}/"+Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        var classSelect = $('select[name="class_id"]');
                        classSelect.empty().append( '<option selected disabled>{{ trans("Parent_trans.Choose") }}...</option>');
                        $.each(data, function (key, value) {
                            classSelect.append('<option value="' + key + '">' + value + '</option>');
                        });
                        $('#classSelectContainer').show();
                    },
                    error: function (xhr, status, error) {
                        var classSelect = $('select[name="class_id"]');
                        console.log('AJAX request failed. Status: ' + status + ', Error: ' + error);
                        classSelect.after('<span class="badge text-danger"> *' + error + '</span>');
                    },
                });
            }
            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('select[name="class_id"]').on('change', function () {
            let Class_id = $(this).val();
            if (Class_id) {
                $.ajax({
                    url: "{{ URL::to('ajax/getSections')}}/"+Class_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="section_id"]').empty().append('<option selected disabled >{{trans("Parent_trans.Choose")}}...</option>');
                        $.each(data, function (key, value) {
                            $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                        $('#sectionSelectContainer').show();
                    },
                    error: function (xhr, status, error) {
                        console.log('AJAX request failed. Status: ' + status + ', Error: ' + error);
                        $('select[name="section_id"]').after('<span class="badge text-danger"> *' + error + '</span>');
                    },
                });
            }
            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


@if(session()->has('success1'))
    <script>
        toastr.options = {
            "progressBar": true ,
            'closeButton': true,
        };
        toastr.success("{{ __('messages.success')}}");
    </script>
@endif

@if(session()->has('updated'))
    <script>
        toastr.options = {
            "progressBar": true ,
            'closeButton': true,
            "positionClass": "toast-bottom-right",
        };
        toastr.info("{{ __('messages.Update')}}" );
    </script>
@endif

@if(session()->has('deleted'))
    <script>
        toastr.options = {
            "progressBar": true ,
            'closeButton': true,
        };
        toastr.warning("{{ __('messages.Delete')}}" );
    </script>
@endif

