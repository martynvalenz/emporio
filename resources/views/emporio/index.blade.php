<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Emporio Legal - Propiedad Intelectual</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="GoProfit" name="author" />

	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" href="{{ asset('images/ico/emporio_imago.ico') }}">
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="{{ asset('emporio/plugins/bootstrap/4.1.3/css/bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('emporio/plugins/font-awesome/5.3/css/all.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('emporio/plugins/animate/animate.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('emporio/css/e-commerce/style.css') }}" rel="stylesheet" />
	<link href="{{ asset('emporio/css/e-commerce/style-responsive.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('emporio/css/e-commerce/theme/blue.css') }}" id="theme" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('owl-carousel/owl.carousel.css') }}">
	<link rel="stylesheet" href="{{ asset('emporio/css/widgets.css') }}">
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{ asset('emporio/plugins/pace/pace.min.js') }}"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<!-- BEGIN #page-container -->
	<div id="page-container" class="fade">

		<div id="top-nav" class="top-nav">
			<div class="container">
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						{{-- <li><a href="#">Bolsa de Trabajo</a></li>
						<li><a href="#">Blog</a></li>
						<li><a href="#">Noticias</a></li> --}}
						<li><a href="#"><i class="fas fa-phone"></i> +52 (614) 410 - 2482</a></li>
						<li><a href="mailto:operaciones@marcasyfranquicias.org"><i class="fas fa-envelope"></i> operaciones@marcasyfranquicias.org</a></li>
					</ul>

					<ul class="nav navbar-nav navbar-right">
						
						<li><a href="https://www.facebook.com/EmporioLegal" target="_blank"><i class="fab fa-facebook-f f-s-14"></i></a></li>
						<li class="dropdown dropdown-hover">
							<a href="#" data-toggle="dropdown"><img src="{{ asset('images/flag/mexico.png') }}" class="flag-img" alt="" /> Español <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#" class="dropdown-item"><img src="{{ asset('images/flag/mexico.png') }}" class="flag-img" alt="" /> Español</a></li>
								<li><a href="#" class="dropdown-item"><img src="{{ asset('images/flag/estados-unidos.png') }}" class="flag-img" alt="" /> Inglés</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div id="app">
			<app-home></app-home>
		</div>
		
		
		
	</div>
	
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{ asset('emporio/js/app.js') }}"></script>
	<script src="{{ asset('emporio/plugins/jquery/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ asset('emporio/plugins/bootstrap/4.1.3/js/bootstrap.bundle.min.js') }}"></script>
	{{-- [if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js') }}"></script>
		<script src="assets/crossbrowserjs/respond.min.js') }}"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js') }}"></script>
	<![endif] --}}
	<script src="{{ asset('emporio/plugins/js-cookie/js.cookie.js') }}"></script>
	<script src="{{ asset('emporio/plugins/paroller/jquery.paroller.min.js') }}"></script>
	<script src="{{ asset('emporio/js/e-commerce/apps.min.js') }}"></script>
	<script src="{{ asset('owl-carousel/owl.carousel.js') }}" defer></script>
	
	<!-- ================== END BASE JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
	<script>

		$(document).ready(function(){
		  var owl = $('.owl-carousel');
		  owl.owlCarousel({
		      items:4,
		      loop:true,
		      margin:10,
		      autoplay:true,
		      autoplayTimeout:2000,
		      autoplayHoverPause:true
		  });
		  $('.play').on('click',function(){
		      owl.trigger('play.owl.autoplay',[1000])
		  });
		  $('.stop').on('click',function(){
		      owl.trigger('stop.owl.autoplay')
		  });
		});

	</script>
</body>
</html>
