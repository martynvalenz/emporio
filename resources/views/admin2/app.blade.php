<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="shortcut icon" href="{{ asset('images/ico/emporio_imago.ico') }}">
	@section('title')
	@show

	<link rel="stylesheet" href="{{ asset('admin/bootstrap/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
	<!-- Fancybox -->
	<link rel="stylesheet" href="{{ asset('fancybox/source/jquery.fancybox.css') }}" type="text/css" media="screen">
	<link rel="stylesheet" href="{{ asset('fancybox/source/helpers/jquery.fancybox-buttons.css') }}">
	<link rel="stylesheet" href="{{ asset('fancybox/source/helpers/jquery.fancybox-thumbs.css') }}">

	<link rel="stylesheet" href="{{ asset('admin/css/font-awesome.min.css') }}">
	    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('admin/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.css') }}">
    
    <link rel="stylesheet" href="{{ asset('admin/popup-modal/jquery-confirm.min.css') }}">
    
    @section('styles')
	@show
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/_all-skins.min.css') }}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		@include('admin.layouts.header')
		@include('admin.layouts.sidebar')
		@yield('main-content')		
		@include('admin.layouts.footer')
		@include('admin.layouts.aside')	
	</div>

	<!-- jQuery 2.2.3 -->
	<script src="{{ asset('admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="{{ asset('admin/bootstrap/js/jquery-ui-1.11.4.js') }}"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
	  $.widget.bridge('uibutton', $.ui.button);
	</script>
	<!-- Bootstrap 3.3.6 -->
	<script src="{{ asset('admin/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>

	<script src="{{ asset('js/fontawesome-all.js') }}"></script>

	<!-- Fancybox -->
	<script src="{{ asset('fancybox/source/jquery.fancybox.pack.js') }}"></script>
	<script src="{{ asset('fancybox/lib/jquery.mousewheel.pack.js') }}"></script>
	
	<script src="{{ asset('fancybox/source/helpers/jquery.fancybox-buttons.js') }}"></script>
	<script src="{{ asset('fancybox/source/helpers/jquery.fancybox-media.js') }}"></script>
	<script src="{{ asset('fancybox/source/helpers/jquery.fancybox-thumbs.js') }}"></script>
	<script src="{{ asset('admin/popup-modal/jquery-confirm.min.js') }}"></script>
	<script src="{{ asset('js/passive-events.js') }}"></script>

@section('scripts')   
@show

<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/app.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<!-- AdminLTE for demo purposes 
<script src="{{ asset('admin/dist/js/demo.js') }}"></script>-->


</body>
</html>