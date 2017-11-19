<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MegaSystem') }}</title>

        <!-- Bootstrap -->
        <link href="{{ asset("css/bootstrap.css") }}" rel="stylesheet">
        <!-- Dropzone -->
        <link href="{{ asset("css/basic.css") }}" rel="stylesheet">
        <link href="{{ asset("css/dropzone.css") }}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ asset("css/font-awesome.min.css") }}" rel="stylesheet">
        <!-- Custom Theme Style Gentelella -->
        <link href="{{ asset("css/gentelella.min.css") }}" rel="stylesheet">
        <!-- Custom Theme Style Toastr -->
        <link href="{{ asset("css/toastr.css") }}" rel="stylesheet">
        <!-- Custom Theme Style Select2 -->
        <link href="{{ asset("css/select2.min.css") }}" rel="stylesheet">

        @stack('stylesheets')

    </head>

    <body class="login">
        <div class="container body">
            <div class="main_container">

                @yield('main_container')

            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ asset("js/jquery.min.js") }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset("js/bootstrap.js") }}"></script>
        <!-- Dropzone -->
        <script src="{{ asset("js/dropzone.js") }}"></script>
        <!-- Custom Theme Scripts -->
        <script src="{{ asset("js/gentelella.min.js") }}"></script>
        <!-- Axios - AJAX -->
        <script src="{{ asset("js/axios.js") }}"></script>
        <!-- Vue JS -->
        <script src="{{ asset("js/vue.js") }}"></script>
        <!-- Toastr -->
        <script src="{{ asset("js/toastr.js") }}"></script>
        <!-- Select2 -->
        <script src="{{ asset("js/select2.min.js") }}"></script>
        <!-- Parsey -->
        <script src="{{ asset("js/parsley.js") }}"></script>
        <!-- General funtions JS -->
        <script src="{{ asset("js/app.js") }}"></script>

        @stack('scripts')

    </body>
</html>