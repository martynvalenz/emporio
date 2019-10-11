@extends('admin.app')

@section('title')
<title>Emporio Legal | Crear Usuario</title>
@endsection

@section('styles')
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
      <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

    <style type="text/css">
      .minusculas{
        text-transform:lowercase;
      } 
      .mayusculas{
        text-transform:uppercase;
      }
    </style>
    
@endsection
 
@section('main-content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Agregar Usuario del sistema
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.emporio') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
      <li class="active">Crear</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="box box-default">
      <div class="box-header with-border">
        
      </div>

      <div class="box-body">     

        <form role="form" action="{{ route('usuarios.store') }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="row">
             <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="id_puesto">Puesto *</label>
                <select class="form-control" name="id_puesto" id="id_puesto" style="width: 100%;">
                  @foreach ($puestos as $puesto)
                     <option value="{{ $puesto->id }}">{{ $puesto->puesto }}</option>
                   @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                <label for="nombre" class="control-label">Nombre *</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control" placeholder="Nombre(s) del colaborador..." name="nombre" id="nombre" value="{{old('nombre')}}">
                </div>
                @if ($errors->has('nombre'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nombre') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group {{ $errors->has('apellido') ? ' has-error' : '' }}">
                <label for="apellido" class="control-label">Apellido *</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control" placeholder="Apellido(s) del colaborador..." name="apellido" id="apellido" value="{{old('apellido')}}">
                </div>
                @if ($errors->has('apellido'))
                    <span class="help-block">
                        <strong>{{ $errors->first('apellido') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
              <div class="form-group {{ $errors->has('iniciales') ? ' has-error' : '' }}">
                <label for="iniciales" class="control-label">Iniciales *</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                  <input type="text" class="form-control" placeholder="Iniciales..." name="iniciales" id="iniciales" value="{{old('iniciales')}}">
                </div>
                @if ($errors->has('iniciales'))
                    <span class="help-block">
                        <strong>{{ $errors->first('iniciales') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group {{ $errors->has('usuario') ? ' has-error' : '' }}">
                <label for="usuario" class="control-label">Nombre corto</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                  <input type="text" class="form-control" placeholder="Alias o nombre corto..." name="usuario" id="usuario" value="{{old('usuario')}}">
                </div>
                @if ($errors->has('usuario'))
                    <span class="help-block">
                        <strong>{{ $errors->first('usuario') }}</strong>
                    </span>
                @endif
              </div>
            </div>
          </div>

          <div class="row">
             
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">Correo *</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                  <input type="email" class="form-control" placeholder="Correo..." name="email" id="email" value="{{old('email')}}">
                </div>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label">Contraseña *</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="text" class="form-control" placeholder="Contraseña..." name="password" id="password" value="{{old('password')}}">
                </div>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password_confirmation" class="control-label">Confirmar Contraseña *</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="text" class="form-control" placeholder="Contraseña..." name="password_confirmation" id="password_confirmation" value="{{old('password_confirmation')}}">
                </div>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            
          </div>

          <hr>

          <div class="row">

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="form-group {{ $errors->has('rfc') ? ' has-error' : '' }}">
                <label for="rfc" class="control-label">RFC</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-qrcode"></i></span>
                  <input type="text" class="form-control mayusculas" placeholder="RFC..." name="rfc" id="rfc" value="{{ old('rfc') }}">
                </div>
              </div>
              @if ($errors->has('rfc'))
                  <span class="help-block">
                      <strong>{{ $errors->first('rfc') }}</strong>
                  </span>
              @endif
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="form-group {{ $errors->has('imss') ? ' has-error' : '' }}">
                <label for="imss" class="control-label">IMSS</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <input type="text" class="form-control" placeholder="Número de IMSS..." name="imss" id="imss" value="{{ old('imss') }}">
                </div>
              </div>
              @if ($errors->has('imss'))
                  <span class="help-block">
                      <strong>{{ $errors->first('imss') }}</strong>
                  </span>
              @endif
            </div>
          </div>

          <hr>

          <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <h2>Dirección</h2>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
              <div class="form-group {{ $errors->has('calle') ? ' has-error' : '' }}">
                <label for="calle" class="control-label">Calle</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
                  <input type="text" class="form-control" placeholder="Calle..." name="calle" id="calle" value="{{ old('calle') }}">
                </div>
              </div>
              @if ($errors->has('calle'))
                  <span class="help-block">
                      <strong>{{ $errors->first('calle') }}</strong>
                  </span>
              @endif
            </div>

            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
              <div class="form-group {{ $errors->has('numero') ? ' has-error' : '' }}">
                <label for="numero" class="control-label">Número</label>
                <div class="input-group">
                  <span class="input-group-addon"><i><b>#</b></i></span>
                  <input type="text" class="form-control" placeholder="Número..." name="numero" id="numero" value="{{ old('numero') }}">
                </div>
              </div>
              @if ($errors->has('numero'))
                  <span class="help-block">
                      <strong>{{ $errors->first('numero') }}</strong>
                  </span>
              @endif
            </div>

            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
              <div class="form-group {{ $errors->has('numero_int') ? ' has-error' : '' }}">
                <label for="numero_int" class="control-label">Número Interno</label>
                <div class="input-group">
                  <span class="input-group-addon"><i><b>#</b></i></span>
                  <input type="text" class="form-control" placeholder="" name="numero_int" id="numero_int" value="{{ old('numero_int') }}">
                </div>
              </div>
              @if ($errors->has('numero_int'))
                  <span class="help-block">
                      <strong>{{ $errors->first('numero_int') }}</strong>
                  </span>
              @endif
            </div>

            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
              <div class="form-group {{ $errors->has('cp') ? ' has-error' : '' }}">
                <label for="cp" class="control-label">Código Postal</label>
                <div class="input-group">
                  <span class="input-group-addon"><i><b>CP</b></i></span>
                  <input type="text" class="form-control" placeholder="Código..." name="cp" id="cp" value="{{ old('cp') }}">
                </div>
              </div>
              @if ($errors->has('cp'))
                  <span class="help-block">
                      <strong>{{ $errors->first('cp') }}</strong>
                  </span>
              @endif
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group {{ $errors->has('colonia') ? ' has-error' : '' }}">
                <label for="colonia" class="control-label">Colonia</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                  <input type="text" class="form-control" placeholder="Colonia..." name="colonia" id="colonia" value="{{ old('colonia') }}">
                </div>
              </div>
              @if ($errors->has('colonia'))
                  <span class="help-block">
                      <strong>{{ $errors->first('colonia') }}</strong>
                  </span>
              @endif
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group {{ $errors->has('localidad') ? ' has-error' : '' }}">
                <label for="localidad" class="control-label">Localidad</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
                  <input type="text" class="form-control" placeholder="Localidad..." name="localidad" id="localidad" value="{{ old('localidad') }}">
                </div>
              </div>
              @if ($errors->has('localidad'))
                  <span class="help-block">
                      <strong>{{ $errors->first('localidad') }}</strong>
                  </span>
              @endif
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group {{ $errors->has('municipio') ? ' has-error' : '' }}">
                <label for="municipio" class="control-label">Municipio</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map"></i></span>
                  <input type="text" class="form-control" placeholder="Municipio..." name="municipio" id="municipio" value="{{ old('municipio') }}">
                </div>
              </div>
              @if ($errors->has('municipio'))
                  <span class="help-block">
                      <strong>{{ $errors->first('municipio') }}</strong>
                  </span>
              @endif
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
             <div class="form-group">
               <label for="id_estado">Estado</label>
               <select class="form-control" name="id_estado" id="id_estado" style="width: 100%;">
                 @foreach ($estados as $estado)
                      <option value="{{ $estado->id }}">{{ $estado->estado }}</option>
                  @endforeach
               </select>
             </div>
           </div>

           <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
             <div class="form-group">
               <label for="id_pais">País</label>
               <select class="form-control" name="id_pais" id="id_pais" style="width: 100%;">
                 @foreach ($paises as $pais)
                      <option value="{{ $pais->id }}">{{ $pais->pais }}</option>
                    @endforeach
               </select>
             </div>
           </div>

          </div>
          <hr>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="telefono" class="control-label">Teléfono</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control" placeholder="Teléfono..." name="telefono" id="telefono" value="{{ old('telefono') }}" data-inputmask='"mask": "(###) ###-####"' data-mask>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="oficina" class="control-label">Teléfono de Oficina</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control" placeholder="Número de oficina..." name="oficina" id="oficina" value="{{ old('oficina') }}" data-inputmask='"mask": "(###) ###-#### ext ####"' data-mask>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="celular" class="control-label">Celular</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control" placeholder="Celular..." name="celular" id="celular" value="{{ old('celular') }}" data-inputmask='"mask": "(###) ###-####"' data-mask>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group {{ $errors->has('imagen') ? ' has-error' : '' }}">
                <label for="imagen" class="control-label">Foto (max: 300kb)</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                  <input type="file" class="form-control" placeholder="Imagen en formato .jpg o .png" name="imagen" id="imagen">
                </div>
              </div>
              @if ($errors->has('imagen'))
                  <span class="help-block">
                      <strong>{{ $errors->first('imagen') }}</strong>
                  </span>
              @endif
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 form-group has-feedback">
              <div class="form-group">
                <label for="estatus">Estatus</label>
                <div class="checkbox">
                  <label>
                    <input class="icheckbox_minimal-blue" type="checkbox" name="estatus"
                    @if (old('estatus') == 1)
                      checked
                    @else
                      unchecked
                    @endif
                    checked="checked"> Activo
                  </label>
                </div>
              </div>
            </div>

             <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 form-group has-feedback">
              <div class="form-group">
                <label for="acepta_comision"> Aplica Comisión</label>
                <div class="checkbox">
                  <label>
                    <input class="icheckbox_minimal-blue" type="checkbox" name="acepta_comision"
                    @if (old('acepta_comision') == 1)
                      checked
                    @else
                      unchecked
                    @endif
                    checked="checked"> Si
                  </label>
                </div>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <label for="comentarios">Comentarios</label>
              <textarea name="comentarios" id="editor1" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('comentarios') }}</textarea>
              <span class="fath-list form-control-feedback left" aria-hidden="true"></span>
            </div>
          </div>

          <hr>

          <div class="form-group pull-right">
            <input name="_token" value="{{ csrf_token() }}" type="hidden">
            <a href="{{ route('usuarios.index') }}" type="button" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Regresar
            </a>
            <button type="submit" class="btn btn-azul">Guardar <i class="glyphicon glyphicon-floppy-disk"></i></button>
          </div>
        </form>

      </div>
    </div>
  </section>
</div>

@endsection

@section('scripts')
<!-- Select2 -->
<script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('admin/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<!-- bootstrap time picker -->
<script src="{{ asset('admin/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script><!-- Page script -->
<!-- Toastr -->
<script src="{{ asset('admin/js/toastr.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- CK Editor -->
<script src="{{ asset('admin/js/ckeditor/ckeditor.js') }}"></script>
<script>
  $('#liUsuarios').addClass("treeview active");
  $('#liAdmin').addClass("active");
</script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
  });
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
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
  @if(Session::has('message'))
    var type="{{ Session::get('alert-type', 'info') }}";
    switch(type)
    {
      case 'info':
        toastr.info("{{ Session::get('message') }}");
        break;

      case 'warning':
        toastr.warning("{{ Session::get('message') }}");
        break;

      case 'success':
        toastr.success("{{ Session::get('message') }}");
        break;

      case 'error':
        toastr.error("{{ Session::get('message') }}");
        break;

    }
  @endif
</script>
@endsection