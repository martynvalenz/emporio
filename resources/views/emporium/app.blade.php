<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @section('title')
    @show
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('images/ico/emporio_imago.ico') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('emporio/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Waves Effect Css -->
    <link href="{{ asset('emporio/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('emporio/plugins/animate-css/animate.css') }}" rel="stylesheet" />


    @section('styles')
    @show

    <!-- Custom Css -->
    <link href="{{ asset('emporio/css/style.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('emporio/css/themes/theme-blue.css') }}" rel="stylesheet">
</head>

<body class="theme-blue">
    <!-- Page Loader -->
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar 
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">Buscar</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">Cerrar</i>
        </div>
    </div>-->
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    @include('emporium.layouts.navbar')
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            @include('emporium.layouts.user')
            @include('emporium.layouts.sidebar')
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
            @include('emporium.layouts.slidebar')
        
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            @yield('main-content')
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="{{ asset('emporio/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('emporio/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('emporio/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('emporio/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('emporio/plugins/node-waves/waves.js') }}"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('emporio/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    @section('scripts')
    @show

    <!-- Custom Js -->
    <script src="{{ asset('emporio/js/admin.js') }}"></script>
    <script src="{{ asset('emporio/js/pages/index.js') }}"></script>

    <!-- Demo Js -->
    <script src="{{ asset('emporio/js/demo.js') }}"></script>
</body>

</html>