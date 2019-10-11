@extends('admin.app')

@section('title')
<title>Emporio Legal | Datos Fiscales</title>
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
      
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
      <li class="active">Datos Fiscales</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="box box-default">
      <div class="box-header with-border">

      </div>

      <div class="box-body">

        <img src="{{ asset('images/ico/logo-full.png') }}" alt="logo">

        <hr>        

        {{ Form::Open(array('action'=>array('EmporioController@update', $emporio->id), 'method'=>'put')) }}

        

          <div class="row">
            
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group {{ $errors->has('nombre_comercial') ? ' has-error' : '' }}">
                <label for="nombre_comercial" class="control-label">Empresa</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-university"></i></span>
                  <input type="text" class="form-control" placeholder="Nombre Comercial..." name="nombre_comercial" id="nombre_comercial" value="@if(old('nombre_comercial')){{ old('nombre_comercial') }}@else{{ $emporio->nombre_comercial }}@endif">
                </div>
              </div>
              @if ($errors->has('nombre_comercial'))
                  <span class="help-block">
                      <strong>{{ $errors->first('nombre_comercial') }}</strong>
                  </span>
              @endif
            </div>

          </div>

          <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
              <div class="form-group {{ $errors->has('razon_social') ? ' has-error' : '' }}">
                <label for="razon_social" class="control-label">Razón Social</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-university"></i></span>
                  <input type="text" class="form-control mayusculas" placeholder="Razón Social..." name="razon_social" id="razon_social" value="@if(old('razon_social')){{ old('razon_social') }}@else{{ $emporio->razon_social }}@endif">
                </div>
              </div>
              @if ($errors->has('razon_social'))
                  <span class="help-block">
                      <strong>{{ $errors->first('razon_social') }}</strong>
                  </span>
              @endif
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group {{ $errors->has('rfc') ? ' has-error' : '' }}">
                <label for="rfc" class="control-label">RFC</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-university"></i></span>
                  <input type="text" class="form-control mayusculas" placeholder="RFC..." name="rfc" id="rfc" value="@if(old('rfc')){{ old('rfc') }}@else{{ $emporio->rfc }}@endif">
                </div>
              </div>
              @if ($errors->has('rfc'))
                  <span class="help-block">
                      <strong>{{ $errors->first('rfc') }}</strong>
                  </span>
              @endif
            </div>

          </div>

          <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
              <div class="form-group">
                <label for="calle" class="control-label">Calle</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
                  <input type="text" class="form-control" placeholder="Calle..." name="calle" id="calle" value="@if(old('calle')){{ old('calle') }}@else{{ $emporio->calle }}@endif">
                </div>
              </div>
              @if ($errors->has('calle'))
                  <span class="help-block">
                      <strong>{{ $errors->first('calle') }}</strong>
                  </span>
              @endif
            </div>

            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
              <div class="form-group">
                <label for="numero" class="control-label">Número</label>
                <div class="input-group">
                  <span class="input-group-addon"><i><b>#</b></i></span>
                  <input type="text" class="form-control" placeholder="Número..." name="numero" id="numero" value="@if(old('numero')){{ old('numero') }}@else{{ $emporio->numero }}@endif">
                </div>
              </div>
              @if ($errors->has('numero'))
                  <span class="help-block">
                      <strong>{{ $errors->first('numero') }}</strong>
                  </span>
              @endif
            </div>

            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
              <div class="form-group">
                <label for="numero_int" class="control-label">Número Interno</label>
                <div class="input-group">
                  <span class="input-group-addon"><i><b>#</b></i></span>
                  <input type="text" class="form-control" placeholder="" name="numero_int" id="numero_int" value="@if(old('numero_int')){{ old('numero_int') }}@else{{ $emporio->numero_int }}@endif">
                </div>
              </div>
              @if ($errors->has('numero_int'))
                  <span class="help-block">
                      <strong>{{ $errors->first('numero_int') }}</strong>
                  </span>
              @endif
            </div>

            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
              <div class="form-group">
                <label for="cp" class="control-label">Código Postal</label>
                <div class="input-group">
                  <span class="input-group-addon"><i><b>CP</b></i></span>
                  <input type="text" class="form-control" placeholder="Código..." name="cp" id="cp" value="@if(old('cp')){{ old('cp') }}@else{{ $emporio->cp }}@endif">
                </div>
              </div>
              @if ($errors->has('cp'))
                  <span class="help-block">
                      <strong>{{ $errors->first('cp') }}</strong>
                  </span>
              @endif
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
              <div class="form-group">
                <label for="colonia" class="control-label">Colonia</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                  <input type="text" class="form-control" placeholder="Colonia..." name="colonia" id="colonia" value="@if(old('colonia')){{ old('colonia') }}@else{{ $emporio->colonia }}@endif">
                </div>
              </div>
              @if ($errors->has('colonia'))
                  <span class="help-block">
                      <strong>{{ $errors->first('colonia') }}</strong>
                  </span>
              @endif
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
              <div class="form-group">
                <label for="localidad" class="control-label">Localidad</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
                  <input type="text" class="form-control" placeholder="Localidad..." name="localidad" id="localidad" value="@if(old('localidad')){{ old('localidad') }}@else{{ $emporio->localidad }}@endif">
                </div>
              </div>
              @if ($errors->has('localidad'))
                  <span class="help-block">
                      <strong>{{ $errors->first('localidad') }}</strong>
                  </span>
              @endif
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
              <div class="form-group">
                <label for="municipio" class="control-label">Municipio</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map"></i></span>
                  <input type="text" class="form-control" placeholder="Municipio..." name="municipio" id="municipio" value="@if(old('municipio')){{ old('municipio') }}@else{{ $emporio->municipio }}@endif">
                </div>
              </div>
              @if ($errors->has('municipio'))
                  <span class="help-block">
                      <strong>{{ $errors->first('municipio') }}</strong>
                  </span>
              @endif
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
             <div class="form-group">
               <label for="estado">Estado</label>
               <select class="form-control" name="estado" id="estado" style="width: 100%;">
                 @foreach ($estados as $estado)
                   @if ($estado->estado == $emporio->estado)
                     <option value="{{ $estado->estado }}" selected>{{ $estado->estado }}</option>
                   @else
                     <option value="{{ $estado->estado }}">{{ $estado->estado }}</option>
                   @endif
                 @endforeach
               </select>
             </div>
           </div>

           <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
             <div class="form-group">
               <label for="pais">País</label>
               <select class="form-control" name="pais" id="pais" style="width: 100%;">
                 @foreach ($paises as $pais)
                   @if ($pais->pais == $emporio->pais)
                     <option value="{{ $pais->pais }}" selected>{{ $pais->pais }}</option>
                   @else
                     <option value="{{ $pais->pais }}">{{ $pais->pais }}</option>
                   @endif
                 @endforeach
               </select>
             </div>
           </div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
              <div class="form-group">
                <label for="telefono" class="control-label">Teléfono 1</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control" placeholder="Teléfono 1..." name="telefono" id="telefono" value="@if(old('telefono')){{ old('telefono') }}@else{{ $emporio->telefono }}@endif" data-inputmask='"mask": "(###) ###-####"' data-mask>
                </div>
              </div>
              @if ($errors->has('telefono'))
                  <span class="help-block">
                      <strong>{{ $errors->first('telefono') }}</strong>
                  </span>
              @endif
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
              <div class="form-group">
                <label for="telefono2" class="control-label">Teléfono 2</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control" placeholder="Teléfono 1..." name="telefono2" id="telefono2" value="@if(old('telefono2')){{ old('telefono2') }}@else{{ $emporio->telefono2 }}@endif" data-inputmask='"mask": "(###) ###-####"' data-mask>
                </div>
              </div>
              @if ($errors->has('telefono2'))
                  <span class="help-block">
                      <strong>{{ $errors->first('telefono2') }}</strong>
                  </span>
              @endif
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
              <div class="form-group">
                <label for="telefono3" class="control-label">Teléfono 3</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control" placeholder="Teléfono 1..." name="telefono3" id="telefono3" value="@if(old('telefono3')){{ old('telefono3') }}@else{{ $emporio->telefono3 }}@endif" data-inputmask='"mask": "(###) ###-####"' data-mask>
                </div>
              </div>
              @if ($errors->has('telefono3'))
                  <span class="help-block">
                      <strong>{{ $errors->first('telefono3') }}</strong>
                  </span>
              @endif
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
              <div class="form-group">
                <label for="pagina_web" class="control-label">Página web</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                  <input type="text" class="form-control minusculas" placeholder="http://..." name="pagina_web" id="pagina_web" value="@if(old('pagina_web')){{ old('pagina_web') }}@else{{ $emporio->pagina_web }}@endif">
                </div>
              </div>
              @if ($errors->has('pagina_web'))
                  <span class="help-block">
                      <strong>{{ $errors->first('pagina_web') }}</strong>
                  </span>
              @endif
            </div>
          </div>

          <div class="form-group pull-right">
            <input name="_token" value="{{ csrf_token() }}" type="hidden">
            <a href="{{ route('admin.emporio') }}" type="button" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Regresar
            </a>
            <button type="submit" class="btn btn-azul">Guardar  <i class="glyphicon glyphicon-floppy-disk"></i></button>
          </div>


        {{ Form::Close() }}

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
  $('#liAjustes').addClass("treeview active");
  $('#liFiscal').addClass("active");
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