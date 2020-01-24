<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="es">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Emporio Legal: Login</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="Emporio Legal" name="description" />
	<meta content="GoProfit" name="author" />
	<link rel="shortcut icon" href="{{ asset('images/ico/emporio_imago.ico') }}">
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="{{ asset('admin/css/open-sanz.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin/plugins/bootstrap/4.1.3/css/bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin/plugins/font-awesome/5.3/css/all.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin/plugins/animate/animate.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin/css/default/style.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin/css/default/style-responsive.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin/css/default/theme/default.css') }}" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{ asset('admin/plugins/pace/pace.min.js') }}"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin login-cover -->
	<div class="login-cover">
		<div class="login-cover-image" style="background-image: url({{ asset('images/login/'.$imagen_principal->imagen) }})" data-id="login-cover-image"></div>
		<div class="login-cover-bg"></div>
	</div>
	<input id="_token" value="{{ csrf_token() }}" type="hidden">
	<!-- end login-cover -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
		<!-- begin login -->
		<div class="login login-v2" data-pageload-addclass="animated fadeIn" style="background-color: rgba(239, 242, 245, 0.2); padding-top: 15px; padding-bottom: 10px">
			<!-- begin brand -->
			<div class="login-header" style="text-align: center">
				<div class="brand">
					<img src="{{ asset('images/ico/logo-imago-full.png') }}" alt="Emporio Legal">
				</div>
			</div>
			<br>
			<!-- end brand -->
			@if (count($errors)>0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<!-- begin login-content -->
			<div class="login-content">
				<form action="{{ route('login') }}" method="post">
				{{ csrf_field() }}
					<div class="form-group m-b-20">
						<input type="text" class="form-control form-control-lg {{ $errors->has('usuario') ? ' is-invalid' : '' }}" placeholder="Nombre de usuario" name="usuario" />
					</div>

					<div class="form-group m-b-20">
						<input data-toggle="password" data-placement="after" class="form-control form-control-lg {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="Contraseña" name="password" />
					</div>

					<div class="checkbox checkbox-css m-b-20">
						<input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} /> 
						<label for="remember">
							Recordarme
						</label>
					</div>

					<div class="login-buttons">
						<button type="submit" class="btn btn-primary btn-block btn-lg">Iniciar sesión <i class="fas fa-lock"></i></button>
					</div>
				</form>
			</div>
			<!-- end login-content -->
		</div>
		<!-- end login -->
		
		<!-- begin login-bg -->
		<ul class="login-bg-list clearfix">
			@foreach($imagenes as $imagen)
				<li @if($imagen->principal == 1) class="active" @else @endif><a href="javascript:;" data-click="change-bg" data-img="{{ asset('images/login/'.$imagen->imagen) }}" onclick="CambiarImagen({{ $imagen->id }})" style="background-image: url({{ asset('images/login/'.$imagen->imagen) }})"></a></li>
			@endforeach
		</ul>
		<!-- end login-bg -->	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{ asset('admin/plugins/jquery/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/bootstrap/4.1.3/js/bootstrap.bundle.min.js') }}"></script>
	<!--[if lt IE 9]>
		<script src="{{ asset('admin/crossbrowserjs/html5shiv.js') }}"></script>
		<script src="{{ asset('admin/crossbrowserjs/respond.min.js') }}"></script>
		<script src="{{ asset('admin/crossbrowserjs/excanvas.min.js') }}"></script>
	<![endif]-->
	<script src="{{ asset('admin/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/js-cookie/js.cookie.js') }}"></script>
	<script src="{{ asset('admin/js/theme/default.min.js') }}"></script>
	<script src="{{ asset('admin/js/apps.min.js') }}"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="{{ asset('admin/js/demo/login-v2.demo.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/bootstrap-show-password/bootstrap-show-password.js') }}"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$.ajaxSetup(
		{
		    headers:
		    {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});

		$(document).ready(function() {
			App.init();
			LoginV2.init();
		});

		function CambiarImagen(id)
		{
			var route = "/login/cambiarImagen/" + id;
			var token = $("#_token").val();
			$.ajax(
			{
			    url: route,
			    headers:
			    {
			        'X-CSRF-TOKEN': token
			    },
			    type: 'PUT',
			    dataType: 'json',
			    success: function(data)
			    {
			        
			    },
			    error: function(data)
			    {
			        console.log(data);
			    }
			});
		}
	</script>
</body>
</html>
