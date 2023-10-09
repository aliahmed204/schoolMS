<!-- Title -->
<title>@yield("title")</title>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon" />

<!-- Font -->
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
@yield('css')
<!--- Style css -->
{{--<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">--}}

<!--- Style css -->
    @if (App::getLocale() == 'en')
        <link href="{{ asset('assets/css/ltr.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('assets/css/rtl.css') }}" rel="stylesheet">
    @endif

<!--- wizard css -->
<link href="{{ asset('assets/css/wizard.css') }}" rel="stylesheet">

{{--Toaster --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
