@extends('admin.app')

@section('title')
<title>Emporio Legal | Editar Egreso</title>
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
      Editar egreso: {{ $egreso->categoria }}
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
      <li><a href="{{ route('egresos.index') }}">Egresos de Despacho</a></li>
      <li class="active">Editar</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="box box-default">
      <div class="box-header with-border">
        
      </div>

      <div class="box-body">     

        <form role="form" action="{{ route('egresos.update', $egreso->id) }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('PUT') }}

          <div class="row pull-right">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="created_at">Creado</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                  <input type="text" value="{{ Carbon\Carbon::parse($egreso->created_at)->diffForHumans() }}" class="form-control" style="background-color: #f5f5f5;" disabled title="{{ Carbon\Carbon::parse($egreso->created_at)->format('d/m/Y') }}" data-tooltip="tooltip">
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="updated_at">Último cambio</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                  <input type="text" value="{{ Carbon\Carbon::parse($egreso->updated_at)->diffForHumans() }}" class="form-control" style="background-color: #f5f5f5;" disabled title="{{ Carbon\Carbon::parse($egreso->updated_at)->format('d/m/Y') }}" data-tooltip="tooltip">
                </div>
              </div>
            </div>  

            @if($egreso->estatus == 'Cancelado')
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="updated_at">Cancelado</label>
                <div class="input-group">
                  <span class="input-group-addon" style="background-color: red; color:white"><i class="fa fa-calendar"></i></span>
                  <input type="text" value="{{ Carbon\Carbon::parse($egreso->cancelado_at)->diffForHumans() }}" class="form-control" style="background-color: #f5f5f5;" disabled title="{{ Carbon\Carbon::parse($egreso->cancelado_at)->format('d/m/Y') }}" data-tooltip="tooltip">
                </div>
              </div>
            </div> 
            @endif
          </div>

          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="form-group {{ $errors->has('id_proveedor') ? ' has-error' : '' }}">
                <label for="id_proveedor">Proveedor</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <select name="id_proveedor" id="id_proveedor" class="form-control">
                    @foreach ($proveedores as $proveedor)
                      @if ($proveedor->id == $egreso->id_proveedor)
                        <option value="{{ $proveedor->id }}" selected>{{ $proveedor->nombre_comercial }}</option>
                      @else
                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre_comercial }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="form-group {{ $errors->has('id_categoria') ? ' has-error' : '' }}">
                <label for="id_categoria">Categoría *</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                  <select name="id_categoria" id="id_categoria" class="form-control">
                    @foreach ($categoria_egresos as $cat)
                      @if ($cat->id == $egreso->id_categoria)
                        <option value="{{ $cat->id }}" selected>{{ $cat->categoria }}</option>
                      @else
                        <option value="{{ $cat->id }}">{{ $cat->categoria }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                @if ($errors->has('id_categoria'))
                    <span class="help-block">
                        <strong>{{ $errors->first('id_categoria') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
                <label for="fecha">Fecha de Egreso</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input type="date" name="fecha" id="fecha" class="form-control" value="@if(old('fecha')){{ old('fecha') }}@else{{ $egreso->fecha }}@endif">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
              <div class="form-group {{ $errors->has('id_cuenta') ? ' has-error' : '' }}">
                <label for="id_cuenta">Cuenta *</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-piggy-bank"></i></span>
                  <select name="id_cuenta" id="id_cuenta" class="form-control">
                    @foreach ($cuentas as $cuenta)
                      @if ($cuenta->id == $egreso->id_cuenta)
                        <option value="{{ $cuenta->id }}" selected>{{ $cuenta->tipo }} {{ $cuenta->alias }}</option>
                      @else
                        <option value="{{ $cuenta->id }}">{{ $cuenta->tipo }} {{ $cuenta->alias }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                @if ($errors->has('id_cuenta'))
                    <span class="help-block">
                        <strong>{{ $errors->first('id_cuenta') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group {{ $errors->has('id_forma_pago') ? ' has-error' : '' }}">
                <label for="id_forma_pago">Forma de pago *</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                  <select name="id_forma_pago" id="id_forma_pago" class="form-control">
                    @foreach ($formas_pago as $forma)
                      @if ($forma->id == $egreso->id_forma_pago)
                        <option value="{{ $forma->id }}" selected>{{ $forma->codigo }} - {{ $forma->forma_pago }}</option>
                      @else
                        <option value="{{ $forma->id }}">{{ $forma->codigo }} - {{ $forma->forma_pago }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                @if ($errors->has('id_forma_pago'))
                    <span class="help-block">
                        <strong>{{ $errors->first('id_forma_pago') }}</strong>
                    </span>
                @endif
              </div>
            </div>
          </div>
          <hr>
          <div class="row">

            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
              <div class="form-group">
                <label for="con_iva">con Factura?</label>
                <select name="con_iva" class="form-control">
                  @if($egreso->con_iva == 1)
                        <option value="1" selected>Si</option>
                        <option value="0">No</option>
                      @else
                        <option value="1">Si</option>
                        <option value="0" selected>No</option>
                      @endif
                    </select>
                @if ($errors->has('con_iva'))
                    <span class="help-block">
                        <strong>{{ $errors->first('con_iva') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
              <div class="form-group">
                <label>Monto Total *</label>
                <div class="input-group">
                  <span class="input-group-addon" style="background-color:green; color:white"><i class="far fa-money-bill-alt"></i></span>
                  <input type="text" id="total" name="total" class="form-control" value="@if(old('total')){{ old('total') }}@else{{ $egreso->total }}@endif">
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
              <div class="form-group {{ $errors->has('porcentaje_iva') ? ' has-error' : '' }}">
                <label for="porcentaje_iva">Porcentaje IVA</label>
                <div class="input-group">
                  <span class="input-group-addon"><i>%</i></span>
                  <input type="text" name="porcentaje_iva" id="porcentaje_iva" value="{{ $porcentaje_iva->porcentaje_iva }}" class="form-control">
                </div>
                @if ($errors->has('porcentaje_iva'))
                    <span class="help-block">
                        <strong>{{ $errors->first('porcentaje_iva') }}</strong>
                    </span>
                @endif
              </div>
            </div>

          </div>
          <div class="row">

            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
              <div class="form-group {{ $errors->has('cheque') ? ' has-error' : '' }}">
                <label for="cheque">Folio de Cheque</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
                  <input type="text" name="cheque" id="cheque" value="@if(old('cheque')){{ old('cheque') }}@else{{ $egreso->cheque }}@endif" class="form-control">
                </div>
                @if ($errors->has('cheque'))
                    <span class="help-block">
                        <strong>{{ $errors->first('cheque') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
              <div class="form-group {{ $errors->has('movimiento') ? ' has-error' : '' }}">
                <label for="movimiento">Movimiento Bancario</label>
                <div class="input-group">
                  <span class="input-group-addon"><i>#</i></span>
                  <input type="text" name="movimiento" id="movimiento" value="@if(old('movimiento')){{ old('movimiento') }}@else{{ $egreso->movimiento }}@endif" class="form-control">
                </div>
                @if ($errors->has('movimiento'))
                    <span class="help-block">
                        <strong>{{ $errors->first('movimiento') }}</strong>
                    </span>
                @endif
              </div>
            </div>

          </div>

          <hr>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group {{ $errors->has('id_cliente') ? ' has-error' : '' }}">
                <label for="id_cliente">Asociar egreso a un cliente</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <select class="form-control selectpicker" name="id_cliente" id="id_cliente" data-live-search="true">
                    <option value="">Sin selección</option>
                    @foreach ($clientes as $cliente)
                       @if ($cliente->id == $egreso->id_cliente)
                         <option value="{{ $cliente->id }}" selected>{{ $cliente->nombre_comercial }}</option>
                       @else
                         <option value="{{ $cliente->id }}">{{ $cliente->nombre_comercial }}</option>
                       @endif
                     @endforeach
                  </select>
                </div>
                @if ($errors->has('id_cliente'))
                    <span class="help-block">
                        <strong>{{ $errors->first('id_cliente') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group {{ $errors->has('id_servicio') ? ' has-error' : '' }}">
                <label for="id_servicio">Asociar egreso a un Servicio</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
                  <select name="id_servicio" id="id_servicio" class="form-control">
                    @foreach ($servicios as $servicio)
                      @if ($servicio->id == $egreso->id_servicio)
                        <option value="{{ $servicio->id }}" selected>{{ $servicio->clave }} {{ $servicio->tramite }} {{ $servicio->nombre }} {{ $servicio->clase }}</option>
                      @else
                        <option value="{{ $servicio->id }}">{{ $servicio->clave }} {{ $servicio->tramite }} {{ $servicio->nombre }} {{ $servicio->clase }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                @if ($errors->has('id_servicio'))
                    <span class="help-block">
                        <strong>{{ $errors->first('id_servicio') }}</strong>
                    </span>
                @endif
              </div>
            </div>
          </div>
          <hr>
          <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <div class="form-group">
                <label for="concepto">Descripción</label>
                <textarea class="form-control has-feedback-left" name="concepto" id="concepto" rows="3" placeholder="Anote una descripción...">@if(old('concepto')){{ old('concepto') }}@else{{ $egreso->concepto }}@endif</textarea>
              </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="estatus">Estatus</label>
                <select name="estatus" class="form-control">
                  @if($egreso->estatus == "Pagado")
                        <option value="Pagado" selected>Pagado</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Cancelado">Cancelado</option>
                      @elseif($egreso->estatus == "Pendiente")
                        <option value="Pagado">Pagado</option>
                        <option value="Pendiente" selected>Pendiente</option>
                        <option value="Cancelado">Cancelado</option>
                      @elseif($egreso->estatus == "Cancelado")
                        <option value="Pagado">Pagado</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Cancelado" selected>Cancelado</option>
                      @endif
                </select>
              </div>
            </div>
          </div>

          <hr>

          <div class="form-group pull-right">
            <input name="_token" value="{{ csrf_token() }}" type="hidden">
            <a href="{{ route('egresos.index') }}" type="button" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Regresar
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
<script>
  $('#liEgresos').addClass("treeview active");
  $('#subDespacho').addClass("active");
</script>
<script>
  $(document).ready(function() {
      $('body').tooltip({
          selector: "[data-tooltip=tooltip]",
          container: "body"
      });
  });
</script>
<script>
    $.ajaxSetup(
  {
     headers: 
     {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
  });
  $('#id_cliente').on('change', function(e)
  {
      console.log(e);

      var id_cliente = e.target.value;

      //ajax
      $.get('/admin/egresos/servicios/' + id_cliente, function(data)
      {
          console.log(data);

              $('#id_servicio').empty();
              $('#id_servicio').append('<option value ="">--Sin selección--</option>');

          $.each(data, function(index, subcatObj)
          {

              $('#id_servicio').append('<option value ="'+ subcatObj.id +'">'+subcatObj.clave + ' ' + subcatObj.tramite + ' ' + subcatObj.nombre + ' ' + subcatObj.clase + ' </option>');
 
          });
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