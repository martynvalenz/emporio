<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Emporio Legal</title>
	@section('title')
	@show
	<link rel="shortcut icon" href="{{ asset('images/ico/emporio_imago.ico') }}">
	<link rel="stylesheet" href="{{ asset('admin/bootstrap/css/bootstrap.css') }}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<style>
	    body {
	        margin:0;
	    }

	    iframe {
	    	padding-top: 50px;
	        display: block;       /* iframes are inline by default */
	        background: #000;
	        border: none;         /* Reset default border */
	        height: 100vh;        /* Viewport-relative units */
	        width: 100vw;
	    }
	    nav{
	    	height:auto;
	    }
	    .navbar-right li a{
	    	color: rgba(9,54,151,1) !important;
	    	font-size: 16px;
	    }

	    .navbar-right li a:hover{
	    	background-color: #e6e6e6 !important;
	    	color:rgba(9,54,151,1) !important;
	    }

	    .glyphicon-off{
			color: rgba(9,54,151,1) !important;
	    }
	    .glyphicon-off:hover{
			color: red !important;
	    }
	</style>

</head>
<body>
	
	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="/">Emporio Legal</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav navbar-right">
	        @if (Auth::guest())
                <li><a href="">Clientes <i class="fa fa-user"></i></a></li>
                <li><a href="{{ route('login') }}">Admin <i class="fa fa-user-secret"></i></a></li>
            @else
            	<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->nombre }} <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#"><i class="fa fa-user"></i> Mi Perfil</a></li>
						<li><a href="#"><i class="fa fa-id-card-o" aria-hidden="true"></i> Mi Cuenta</a></li>
						<li><a href="#"><i class="fa fa-key"></i> Cambiar Contraseña</a></li>
						<li role="separator" class="divider"></li>
						<li title="Cerrar Sesión" class="logout-button"><a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" ><i class="glyphicon glyphicon-off"></i> Cerrar Sesión</a></li>
					</ul>
				</li>
                <li class="logout-button">
                    <a  href=""
                        onclick="event.preventDefault(); 
                                document.getElementById('logout-form').submit();"
                        title="Cerrar sesión" >
                        <i class="glyphicon glyphicon-off"></i>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
                <li><a href="{{ route('login') }}">Admin <i class="fa fa-user-secret"></i></a></li>
            @endif
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	<section>
		<iframe src="http://marcasyfranquicias.org/">
			
		</iframe>
	</section>

	<script src="{{ asset('admin/js/jquery-3.2.1.js') }}"></script>
	<script src="{{ asset('admin/bootstrap/js/bootstrap.js') }}"></script>
</body>
</html>