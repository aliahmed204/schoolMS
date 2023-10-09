@php
    use Illuminate\Support\Facades\Auth;
@endphp
<div class="container-fluid">
    <div class="row">
        <!-- Left main start-->
        <div class="side-menu-fixed">

            @if (Auth::guard('web')->check())
                @include('layouts.main-sidebar.admin-sidebar')
            @elseif (Auth::guard('student')->check())
                @include ('layouts.main-sidebar.student-sidebar')
            @elseif (Auth::guard('teacher')->check())
                @include ('layouts.main-sidebar.teacher-sidebar')
            @elseif (Auth::guard('parent')->check())
                @include ('layouts.main-sidebar.parent-sidebar')
            @endif
        </div>

