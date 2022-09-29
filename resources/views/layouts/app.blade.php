<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('storage/images/favicon.ico') }}">
    <title> |@yield('title')</title>
    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('assets/css/vendors_css.css') }}">
    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/skin_color.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @section('page_css')
    @show()
</head>
<body class="hold-transition light-skin sidebar-mini theme-primary fixed">
    <div class="wrapper">
        <div id="loader"></div>
            @section('header')
                @include('layouts.header')
            @show()
            @section('side-bar')
                @include('layouts.side-bar')
            @show
            @section('content')
                @yield('right_side_bar')
            @show
        @section('footer')
            <footer class="main-footer">
                <div class="pull-right d-none d-sm-inline-block">
                    <ul
                        class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0)">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Purchase Now</a>
                        </li>
                    </ul>
                </div>
                &copy; 2021 <a href="https://www.multipurposethemes.com/">Multipurpose Themes</a>. All Rights Reserved.
            </footer>
        @show
    </div>
    <script src="{{ asset('assets/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/chat-popup.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/apexcharts-bundle/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('js/notify.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{ asset('assets/vendor_components/sweetalert/jquery.sweet-alert.custom.js')}}"></script>
    <script src="{{ asset('assets/vendor_components/ckeditor/ckeditor.js')}}"></script>
	<script src="{{ asset('assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')}}"></script>
	<script src="{{ asset('assets/js/pages/editor.js')}}"></script>
        @foreach ($errors->all() as $error)
            <script>
                    $.notify("{{ $error }}", "error");
            </script>
        @endforeach
        @if (Session::has('success') or Session::has('error'))
            <script>
                @if (Session::has('success'))
                    $.notify("{{ Session::get('success') }}", "success");
                @endif
                @if (Session::has('error'))
                    $.notify("{{ Session::get('error') }}", "error");
                @endif
            </script>
        @endif
    <script>
        function logout(){
            $('#logoutform').submit();
        }
    </script>

    @section('page_js')
    @show
</body>
</html>
