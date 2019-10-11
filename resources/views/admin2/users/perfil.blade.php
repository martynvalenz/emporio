@extends('admin.app')

@section('title')
<title>Emporio Legal | Editar: {{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</title>
@endsection

@section('styles')
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
      <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">

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
      Editar usuario: {{ Auth::user()->nombre }} {{ Auth::user()->apellido }}
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.emporio') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
      <li class="active">{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="box box-default">
      <div class="box-header with-border">
        
      </div>

      <div class="box-body">     

        <form role="form" action="{{ route('admin.perfil_update') }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}

              <div class="row">
        			   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        			    <img src="{{ asset('images/users/'.Auth::user()->imagen) }}" alt="Imagen de {{ Auth::user()->usuario }}" height="150">
        			   </div>
        			   <br>
        			   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
        			    <span class="input-group">
        			    	<label for="imagen">Cambiar imagen de perfil</label>
        			    	<input type="file" name="imagen">
        			    </span>
        			  </div>
        			</div>

        			<hr>

        			<div class="row">
        			  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        			    <div class="form-group">
        			      <label>Creado</label>
        			      <div class="input-group">
        			        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        			        <input type="text" value="{{ Auth::user()->created_at->diffForHumans() }}" class="form-control" disabled style="background-color: white; color:black" data-tooltip="tooltip" title="{{ Auth::user()->created_at->format('d-m-Y') }}">
        			      </div>
        			      
        			    </div>
        			  </div>  
        			  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        			    <div class="form-group">
        			      <label>Última actualización</label>
        			      <div class="input-group">
        			        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        			        <input type="text" value="{{ Auth::user()->updated_at->diffForHumans() }}" class="form-control" disabled style="background-color: white; color:black" data-tooltip="tooltip" title="{{ Auth::user()->updated_at->format('d-m-Y') }}">
        			      </div>
        			    </div>
        			  </div>
        			</div>
        			<div class="row">
        				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        				  <div class="form-group {{ $errors->has('iniciales') ? ' has-error' : '' }}">
        				    <label for="iniciales" class="control-label">Iniciales *</label>
        				    <div class="input-group">
        				      <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
        				      <input type="text" class="form-control" placeholder="Iniciales..." name="iniciales" id="iniciales" value="@if(old('iniciales')){{ old('iniciales') }}@else{{ Auth::user()->iniciales }}@endif">
        				    </div>
        				    @if ($errors->has('iniciales'))
        				        <span class="help-block">
        				            <strong>{{ $errors->first('iniciales') }}</strong>
        				        </span>
        				    @endif
        				  </div>
        				</div>
        				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        				  <div class="form-group {{ $errors->has('usuario') ? ' has-error' : '' }}">
        				    <label for="usuario" class="control-label">Nombre corto</label>
        				    <div class="input-group">
        				      <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
        				      <input type="text" class="form-control" placeholder="Alias o nombre corto..." name="usuario" id="usuario" value="@if(old('usuario')){{ old('usuario') }}@else{{ Auth::user()->usuario }}@endif">
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
        			  <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
        			    <div class="form-group">
        			      <label for="telefono" class="control-label">Teléfono</label>
        			      <div class="input-group">
        			        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
        			        <input type="text" class="form-control" placeholder="Teléfono..." name="telefono" id="telefono" value="@if(old('telefono')){{ old('telefono') }}@else{{ Auth::user()->telefono }}@endif" data-inputmask='"mask": "(###) ###-####"' data-mask>
        			      </div>
        			    </div>
        			  </div>
        				<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
        				  <div class="form-group">
        				    <label for="oficina" class="control-label">Teléfono de Oficina</label>
        				    <div class="input-group">
        				      <span class="input-group-addon"><i class="fa fa-phone"></i></span>
        				      <input type="text" class="form-control" placeholder="Número de oficina..." name="oficina" id="oficina" value="@if(old('oficina')){{ old('oficina') }}@else{{ Auth::user()->oficina }}@endif" data-inputmask='"mask": "(###) ###-#### ext ####"' data-mask>
        				    </div>
        				  </div>
        				</div>
        				<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
        				  <div class="form-group">
        				    <label for="celular" class="control-label">Celular</label>
        				    <div class="input-group">
        				      <span class="input-group-addon"><i class="fa fa-phone"></i></span>
        				      <input type="text" class="form-control" placeholder="Celular..." name="celular" id="celular" value="@if(old('celular')){{ old('celular') }}@else{{ Auth::user()->celular }}@endif" data-inputmask='"mask": "(###) ###-####"' data-mask>
        				    </div>
        				  </div>
        				</div>
        			</div>
        			<div class="row">
        				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        					<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
        					  <label for="password" class="control-label">Contraseña Nueva *</label>
        					  <div class="input-group">
        					    <span class="input-group-addon"><i class="fa fa-key"></i></span>
        					    <input type="text" class="form-control" placeholder="Contraseña..." name="password" id="password">
        					  </div>
        					  @if ($errors->has('password'))
        					      <span class="help-block">
        					          <strong>{{ $errors->first('password') }}</strong>
        					      </span>
        					  @endif
        					</div>
        				</div>
        				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        					<div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        					  <label for="password_confirmation" class="control-label">Confirmar Contraseña *</label>
        					  <div class="input-group">
        					    <span class="input-group-addon"><i class="fa fa-key"></i></span>
        					    <input type="text" class="form-control" placeholder="Contraseña..." name="password_confirmation" id="password_confirmation">
        					  </div>
        					  @if ($errors->has('password_confirmation'))
        					      <span class="help-block">
        					          <strong>{{ $errors->first('password_confirmation') }}</strong>
        					      </span>
        					  @endif
        					</div>
        				</div>
        			</div>
        			<input type="hidden" value="{{ Auth::user()->id }}">

                  <hr>

              <div class="form-group pull-right">
                <input name="_token" value="{{ csrf_token() }}" type="hidden">
                <button type="button" class="btn btn-gris" data-dismiss="modal">
          				Cerrar <span class="glyphicon glyphicon-remove"></span>
          			</button>
          			<button type="submit" class="btn btn-azul">
          				<span class="glyphicon glyphicon-floppy-disk"></span> Actualizar
          			</button>
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


