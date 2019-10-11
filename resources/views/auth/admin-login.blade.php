<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Emporio Legal | Login Administradores</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('admin/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">

  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('images/ico/emporio.png') }}">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('images/ico/emporio-114.png') }}">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('images/emporio-72.png') }}">
  <link rel="apple-touch-icon-precomposed" href="{{ asset('images/ico/apple-touch-icon-57.png') }}">
  <link rel="shortcut icon" href="{{ asset('images/ico/emporio_imago.ico') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
    });
  </script>
  <style>
    .help-block
    {
      color:red;
    }
  </style>

</head>
<body class="hold-transition login-page" style="background-color: #dfdfdf; height: auto;">
<div class="login-box" style="border: solid 1px #cccccc; padding-top: 20px; background-color:white">
  <div class="login-logo">
    <a href="/"><img src="{{ asset('images/ico/emporio.png') }}" alt="Emporio Legal"></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">

    <p class="login-box-msg" style="font-size: 20px">Inicio de sesión Administradores</p>

    <form action="{{ route('admin.login') }}" method="post">
    {{ csrf_field() }}

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-user"></i></span>
          <input type="usuario" class="form-control{{ $errors->has('user') ? ' is-invalid' : '' }}" placeholder="Nombre de usuario" name="usuario" value="{{ old('usuario') }}" autofocus>
        </div>
        <span class="fa fa-user form-control-feedback"></span>
        @if ($errors->has('usuario'))
            <span class="help-block">
                <strong>{{ $errors->first('usuario') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-key"></i></span>
          <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Contraseña" name="password" id="password">
          <div class="input-group-btn">  
            <a type="button" class="btn btn-default btn-flat" data-tooltip="tooltip" title="Mostrar contraseña" onclick="MostrarContrasena()"><i class="glyphicon glyphicon-eye-open"></i></a>
          </div>
        </div>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordarme
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" title="Ingresar al panel administrativo">Ingresar <i class="glyphicon glyphicon-log-in"></i></button>
          <a href="/" class="btn btn-default btn-block btn-flat" title="Regresar a la página principal">Regresar</a>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->

    <!--<a href="{{ route('password.request') }}" title="Te llegará un correo con un vínculo para actualizar tu contraseña.">Olvidé mi contraseña</a><br>
    <a href="{{ route('register') }}">Registrar</a><br>-->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="{{ asset('admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('admin/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('body').tooltip({
            selector: "[data-tooltip=tooltip]",
            container: "body"
        });
    });
</script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
<script>
  function MostrarContrasena()
  {
    var x = document.getElementById("password");
    if (x.type === "password") 
    {
        x.type = "text";
    } 
    else 
    {
        x.type = "password";
    }
  }
</script>
</body>
</html>












