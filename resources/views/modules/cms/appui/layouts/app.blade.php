<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <title>{{ config('cms.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="AppUI is a Web App Bootstrap Admin Template created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ asset('appui/img/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('appui/img/icon57.png') }}" sizes="57x57">
    <link rel="apple-touch-icon" href="{{ asset('appui/img/icon72.png') }}" sizes="72x72">
    <link rel="apple-touch-icon" href="{{ asset('appui/img/icon76.png') }}" sizes="76x76">
    <link rel="apple-touch-icon" href="{{ asset('appui/img/icon114.png') }}" sizes="114x114">
    <link rel="apple-touch-icon" href="{{ asset('appui/img/icon120.png') }}" sizes="120x120">
    <link rel="apple-touch-icon" href="{{ asset('appui/img/icon144.png') }}" sizes="144x144">
    <link rel="apple-touch-icon" href="{{ asset('appui/img/icon152.png') }}" sizes="152x152">
    <link rel="apple-touch-icon" href="{{ asset('appui/img/icon180.png') }}" sizes="180x180">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Bootstrap is included in its original form, unaltered -->
    <link rel="stylesheet" href="{{ asset('appui/css/bootstrap.min.css')  }}">

    <!-- Related styles of various icon packs and plugins -->
    <link rel="stylesheet" href="{{ asset('appui/css/plugins.css')  }}">

    <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
    <link rel="stylesheet" href="{{ asset('appui/css/main.css')  }}">

    <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

    <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
    <link rel="stylesheet" href="{{ asset('appui/css/themes.css')  }}">
    <!-- END Stylesheets -->

    <!-- Modernizr (browser feature detection library) -->
    <script src="{{ asset('appui/js/vendor/modernizr-3.3.1.min.js')  }}"></script>
</head>
<body>
    <!-- Page Wrapper -->
    <!-- In the PHP version you can set the following options from inc/config file -->
<!--
    Available classes:

    'page-loading'      enables page preloader
-->
<div id="page-wrapper" class="page-loading">

    @include('cms::appui.blocks.preloader')

    <div id="page-container" class="header-fixed-top sidebar-visible-lg-full">


        @include('cms::appui.blocks.sidebar')

        <!-- Main Container -->
        <div id="main-container">

            @include('cms::appui.blocks.header')

            @yield('content')
            <div class="loading" style="display:none">
                <div class="loading-inner"></div>
            </div>
        </div>
        <!-- END Main Container -->
    </div>
    <!-- END Page Container -->
</div>
<!-- END Page Wrapper -->

<link rel="stylesheet" href="{{ asset('css/cms.css')  }}">

<!-- jQuery, Bootstrap, jQuery plugins and Custom JS code -->
<script src="{{ asset('appui/js/vendor/jquery-2.2.4.min.js') }}"></script>
<script src="{{ asset('appui/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('appui/js/plugins.js') }}"></script>
<script src="{{ asset('appui/js/app.js') }}"></script>
<script src="{{ asset('appui/js/popup/fly.js') }}"></script>
<script src="{{ asset('appui/js/popup/ejs.js') }}"></script>
<script src="{{ asset('appui/js/popup/tmpl.js') }}"></script>
<script src="{{ asset('appui/js/popup/popup.js') }}"></script>
<script src="{{ asset('appui/js/popup/croppie.js') }}"></script>
<script src="{{ asset('appui/js/popup/media.js') }}"></script>
@yield ('scripts')
<script>
    var baseUrl = @json(url('/'));
    var _token = '{{ csrf_field() }}';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</body>
</html>
