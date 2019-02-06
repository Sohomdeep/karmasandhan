<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>{{ config('app.name', 'Jobs') }}</title>
    {{--<link rel="shortcut icon" href="{{ asset('public/admin-assets/img/favicon/favicon.ico') }}">--}}

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('public/admin-assets/img/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('public/admin-assets/img/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('public/admin-assets/img/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('public/admin-assets/img/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('public/admin-assets/img/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('public/admin-assets/img/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('public/admin-assets/img/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('public/admin-assets/img/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/admin-assets/img/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('public/admin-assets/img/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/admin-assets/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('public/admin-assets/img/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/admin-assets/img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('public/admin-assets/img/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('public/admin-assets/img/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <script src="{{ asset('public/admin-assets/js/jquery-2.2.1.min.js') }}"></script>
    <script src="{{ asset('public/admin-assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/admin-assets/js/custom/maxFormValidation.1.5.js') }}"></script>

    <link href="{{ asset('public/admin-assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin-assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin-assets/css/endless.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin-assets/css/endless-skin.css') }}" rel="stylesheet">

    <script src="{{ asset('public/admin-assets/jConfirm/jquery.alerts.js') }}"></script>
    <link href="{{ asset('public/admin-assets/jConfirm/jquery.alerts.css') }}" rel="stylesheet">


    <style>
        .invalid-feedback{
            color: #a94442;
        }
        .requireStar{
            color: #fb5a43;
        }
        .ui-datepicker-title{
            color:#393942;
        }
        ul.pagination li a.current {
            background: rgba(60,141,188,.5);
            color: white;
        }
    </style>
</head>
<body class="overflow-hidden">
    <div id="app">
        <main class="py-4">
            @if(Auth::check())
                @include('admin.includes.header')
            @endif

                @yield('content')

            @if(Auth::check())
                @include('admin.includes.footer')
            @endif
        </main>
    </div>
</body>

<script src="{{asset('public/admin-assets/js/jquery.flot.min.js')}}"></script>
<!-- Morris -->
<script src="{{asset('public/admin-assets/js/rapheal.min.js')}}"></script>
<script src="{{asset('public/admin-assets/js/morris.min.js')}}"></script>

<!-- Colorbox -->
<script src="{{asset('public/admin-assets/js/jquery.colorbox.min.js')}}"></script>

<!-- Sparkline -->
<script src="{{asset('public/admin-assets/js/jquery.sparkline.min.js')}}"></script>

<!-- Pace -->
<script src="{{asset('public/admin-assets/js/uncompressed/pace.js')}}"></script>

<!-- Slimscroll -->
<script src="{{asset('public/admin-assets/js/jquery.slimscroll.min.js')}}"></script>

<!-- Modernizr -->
<script src="{{asset('public/admin-assets/js/modernizr.min.js')}}"></script>

<!-- Cookie -->
<script src="{{asset('public/admin-assets/js/jquery.cookie.min.js')}}"></script>

<!-- Popup Overlay -->
<script src="{{asset('public/admin-assets/js/jquery.popupoverlay.min.js')}}"></script>

<script src="{{asset('public/admin-assets/js/endless/endless.js')}}"></script>
</html>
