@extends('admin.app')

@section('title')
<title>Emporio Legal | Cobro: {{ $ingreso->id }}</title>
@endsection

@section('styles')
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
      <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
    <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/datepicker/datepicker3.css') }}">
    <!-- Chosen select -->
    <link rel="stylesheet" href="{{ asset('css/chosen.min.css') }}">
    <!-- bootstrap wysihtml5 - text editor 
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">-->

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
      Cobro: {{ $ingreso->id }}
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
      <li><a href="{{ route('cobranza.index') }}">Cobranza</a></li>
      <li class="active">Cobro: {{ $ingreso->id }}</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="box box-default">
      <div class="box-header with-border">
        <!--<h3>Edición de factura y asignación de servicios</h3>-->
      </div>

      <div class="box-body">     

        <!--<form role="form" id="edtiarForm" action="{{ route('cobranza.update', $ingreso->id) }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('PUT') }}-->

        <form role="form" id="edtiarForm" enctype="multipart/form-data">
          
          <div class="row">
            <input type="hidden" id="id_cobranza" name="id_cobranza" value="{{ $ingreso->id }}" >
              <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                <div class="form-group {{ $errors->has('id_cliente') ? ' has-error' : '' }}">
                  <label for="id_cliente" class="control-label">Seleccionar Cliente <b style="color:red">*</b></label>
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fas fa-trophy"></i></span>
                      @if(count($detalles) > 0)  
                        <select class="form-control selectpicker" data-live-search="true" disabled>
                          @foreach($clientes as $cliente)
                            @if($cliente->id == $ingreso->id_cliente)
                              <option value="{{ $cliente->id }}" selected>{{ $cliente->nombre_comercial }}</option>
                            @else
                              <option value="{{ $cliente->id }}">{{ $cliente->nombre_comercial }}</option>
                            @endif
                          @endforeach
                        </select>
                        <input type="hidden" name="id_cliente" id="id_cliente_input" value="{{ $ingreso->id_cliente }}">
                      @else
                        <select class="form-control selectpicker" name="id_cliente" id="id_cliente_select" data-live-search="true">
                          <option value=""></option>
                          @foreach($clientes as $cliente)
                            @if($cliente->id == $ingreso->id_cliente)
                              <option value="{{ $cliente->id }}" selected>{{ $cliente->nombre_comercial }}</option>
                            @else
                              <option value="{{ $cliente->id }}">{{ $cliente->nombre_comercial }}</option>
                            @endif
                          @endforeach
                        </select>
                      @endif
                  </div>
                  @if ($errors->has('id_cliente'))
                      <span class="help-block">
                          <strong>{{ $errors->first('id_cliente') }}</strong>
                      </span>
                  @endif
                </div>                
              </div>

              <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                <div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
                  <label for="fecha" class="control-label">Fecha <b style="color:red">*</b></label>
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="text" name="fecha" class="form-control datepicker" value="@if(old('fecha')){{ old('fecha') }}@else{{ $ingreso->fecha }}@endif">
                  </div>
                  @if ($errors->has('fecha'))
                      <span class="help-block">
                          <strong>{{ $errors->first('fecha') }}</strong>
                      </span>
                  @endif
                </div>                
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group {{ $errors->has('id_razon_social') ? ' has-error' : '' }}">
                  <label for="id_razon_social" class="control-label">Seleccionar Razón Social</label>
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fas fa-qrcode"></i></span>
                      <select name="id_razon_social" id="id_razon_social" class="form-control">
                        @foreach($razones_sociales as $razon)
                          @if($razon->id == $ingreso->id_razon_social)
                            <option value="{{ $razon->id }}" selected>{{ $razon->razon_social }} | {{ $razon->rfc }}</option>
                          @else
                            <option value="{{ $razon->id }}">{{ $razon->razon_social }} | {{ $razon->rfc }}</option>
                          @endif
                        @endforeach
                      </select>
                      <div class="input-group-btn">
                        <a class="btn btn-info" title="Agregar nueva razón social" data-tooltip="tooltip" data-toggle="modal" data-target="#agregar_razon" id="btn_agregar_razon"><i class="fa fa-plus"></i></a>
                      </div>
                      @include('admin.ingresos.cobranza.razon')
                  </div>
                  @if ($errors->has('id_razon_social'))
                      <span class="help-block">
                          <strong>{{ $errors->first('id_razon_social') }}</strong>
                      </span>
                  @endif
                </div>                
              </div>
            </div>

            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group {{ $errors->has('id_cuenta') ? ' has-error' : '' }}">
                  <label for="id_cuenta">Cuenta <b style="color:red">*</b></label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-piggy-bank"></i></span>
                    <select name="id_cuenta" id="id_cuenta" class="form-control">
                      @foreach($cuentas as $cuenta)
                        @if($cuenta->id == $ingreso->id_cuenta)
                          <option value="{{ $cuenta->id }}" selected>{{ $cuenta->tipo }} {{ $cuenta->alias  }}</option>
                        @else
                          <option value="{{ $cuenta->id }}">{{ $cuenta->tipo }} {{ $cuenta->alias  }}</option>
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
                  <label for="id_forma_pago">Forma de pago <b style="color:red">*</b></label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                    <select name="id_forma_pago" id="id_forma_pago" class="form-control">
                      @foreach($formas_pago as $forma)
                        @if($forma->id == $ingreso->id_forma_pago)
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

            <div class="row">
              
              <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                <div class="form-group {{ $errors->has('cheque') ? ' has-error' : '' }}">
                  <label for="cheque">Folio de Cheque</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
                    <input type="text" name="cheque" id="cheque" value="@if(old('cheque')){{ old('cheque') }}@else{{ $ingreso->cheque }}@endif" class="form-control">
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
                    <input type="text" name="movimiento" id="movimiento" value="@if(old('movimiento')){{ old('movimiento') }}@else{{ $ingreso->movimiento }}@endif" class="form-control">
                  </div>
                  @if ($errors->has('movimiento'))
                      <span class="help-block">
                          <strong>{{ $errors->first('movimiento') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                <div class="form-group {{ $errors->has('total') ? ' has-error' : '' }}">
                  <label>Monto Total <b style="color:red">*</b></label>
                  <div class="input-group">
                    <span class="input-group-addon" style="background-color:green; color:white"><i class="far fa-money-bill-alt"></i></span>
                    <input type="decimal" id="total" name="total" class="form-control" value="@if(old('total')){{ old('total') }}@else{{ $ingreso->total }}@endif">
                  </div>
                  @if ($errors->has('total'))
                      <span class="help-block">
                          <strong>{{ $errors->first('total') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                <div class="form-group {{ $errors->has('restante') ? ' has-error' : '' }}">
                  <label>Monto Restante</label>
                  <div class="input-group">
                    <span class="input-group-addon" style="background-color: #cc6600; color:white"><i class="far fa-money-bill-alt"></i></span>
                    <input type="text" style="background-color:white;" class="form-control" value="{{ $ingreso->restante }}" disabled>
                  </div>
                  @if ($errors->has('restante'))
                      <span class="help-block">
                          <strong>{{ $errors->first('restante') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="concepto">Comentarios</label>
                <textarea name="concepto" id="concepto" rows="3" class="form-control">@if(old('concepto')){{ old('concepto') }}@else{{ $ingreso->concepto }}@endif</textarea>
              </div>
            </div>

            <br>

            <div class="row">
              <div class="form-group pull-right">
                <div class="col-lg-12">
                  <input name="_token" value="{{ csrf_token() }}" type="hidden">
                  <input type="hidden" value="Pendiente" name="estatus">
                  <input type="hidden" value="1" name="pagado_boolean">
                  <input type="hidden" value="{{ $ingreso->pagado }}" name="pagado">
                  <input type="hidden" value="{{ $ingreso->restante }}" name="restante">
                  <a href="{{ route('cobranza.index') }}" type="button" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Regresar
                  </a>
                  <button id="guardar" onclick="event.preventDefault();" class="btn btn-azul">Actualizar <i class="glyphicon glyphicon-floppy-disk"></i></button>
                </div>
              </div>
            </div>

              
          </form>
          <hr>   

          @if($ingreso->restante > 0)

            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
                <h3>Facturas y recibos pendientes</h3>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover table-responsive" style="font-size: 16px">
                    <thead style="background-color: #cc6600; color:white">
                      <tr>
                        <th hidden>Id</th>
                        <th>Factura</th>
                        <th>Recibo</th>
                        <th>Razón Social | RFC</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Pagado</th>
                        <th>Pendiente</th>
                        <th>datos</th>
                        <th colspan ="1">&nbsp;</th>
                      </tr> 
                    </thead>
                    <tbody>
                      @foreach($facturas_seleccionar  as $key => $factura)
                      <form role="form" id="agregarFacturaForm" action="{{ route('cobranza.insertar-factura') }}" method="post">
                          {{ csrf_field() }}
                          {{ method_field('POST') }}
                        <tr id="factura{{ $factura->id }}">
                          <td hidden>{{ $factura->id }}</td>
                          <td style="width:8%;" valign="middle" align="center" title="{{ $factura->comentarios }}" data-tooltip="tooltip">
                            {{ $factura->folio_factura }}
                          </td>
                          <td style="width:8%;" valign="middle" align="center" title="{{ $factura->comentarios }}" data-tooltip="tooltip">
                            {{ $factura->folio_recibo }}
                          </td>
                          <td style="width:30%;" valign="middle" align="left">{{ $factura->razon_social }} - {{ $factura->rfc }}</td>
                          <td style="width:10%;" align="center" valign="middle" title="Agregado {{ Carbon\Carbon::parse($factura->fecha)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</td>
                          <td style="width:10%;" valign="middle" align="right" data-tooltip="tooltip" title="Subtotal: {{ number_format($factura->subtotal,2) }} | IVA: {{ number_format($factura->iva,2) }}">{{ number_format($factura->total,2) }}</td>
                          <td style="width:10%;" valign="middle" align="right">{{ number_format($factura->pagado,2) }}</td>
                         <td style="width:14%;" valign="middle" align="right"><input type="decimal" name="monto" min="1" class="form-control monto"
                              @if($factura->saldo > $ingreso->restante)
                                value="{{ $ingreso->restante }}" max="{{ $ingreso->restante}}" title="El valor no puede ser mayor al monto disponible: {{ number_format($ingreso->restante,2) }}"
                              @else
                                value="{{ $factura->saldo }}" max="{{ $factura->saldo }}" title="El valor no puede ser mayor al saldo pendiente: {{ number_format($factura->saldo,2) }}"
                              @endif
                            class="form-control" data-tooltip="tooltip">
                          </td>  
                          <td>
                            <input type="hidden" name="id_factura" value="{{ $factura->id }}">   
                            <input type="hidden" name="id_cobranza_fact" value="{{ $ingreso->id }}">   
                            <input type="hidden" name="pagado_fact" value="{{ $factura->pagado }}"> 
                            <input type="hidden" name="saldo_fact" value="{{ $factura->saldo }}">
                            <input type="hidden" value="{{ $ingreso->restante }}" name="restante_fact">
                            <input type="hidden" value="{{ $factura->porcentaje_iva }}" name="porcentaje_iva">
                            <input type="hidden" value="{{ $ingreso->fecha }}" name="ingreso_fecha">
                          </td>
                          <td style="width:10%;" align="center">
                            <a 
                              class="btn btn-info btn-xs btn-detalle" 
                              title="Ver detalles de factura {{ $factura->folio_factura }}" 
                              data-tooltip="tooltip" 
                              data-toggle="modal" 
                              data-target="#modal-detalles" 
                              data-id="{{ $factura->id }}"
                              data-path="{{ route('facturas.detalles') }}"
                              data-token="{{ csrf_token() }}">
                              <i class="glyphicon glyphicon-th-list"></i>
                            </a>
                            <button 
                              class="btn btn-success btn-xs btn-insertar" 
                              title="Agregar factura o recibo al cobro" 
                              data-tooltip="tooltip"
                              id="agregarFactura"
                              data-token="{{ csrf_token() }}">
                              <i class="glyphicon glyphicon-ok"></i>
                            </button>
                          </td>
                        </tr>
                      </form>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div> 
          @else

          @endif
             
          

      </div>

      <br>

      <div class="box">
        <div class="box-body">
          <div class="row"> 
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <h3>Facturas y Recibos agregados al cobro</h3>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-responsive" style="font-size: 16px">
                  <thead style="background-color: #0B3798; color:white">
                    <tr>
                      <th hidden>Id</th>
                      <th>Factura</th>
                      <th>Recibo</th>
                      <th>Razón Social | RFC</th>
                      <th>Fecha</th>
                      <th>Total</th>
                      <th>Pagado</th>
                      <th>Saldo</th>
                      <th colspan ="1">&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($detalles  as $key => $detalle)
                      <tr id="detalle{{ $detalle->id }}">
                        <td hidden>{{ $detalle->id }}</td>
                        <td style="width:8%;" valign="middle" align="center" title="{{ $detalle->comentarios }}" data-tooltip="tooltip">
                          {{ $detalle->folio_factura }}
                        </td>
                        <td style="width:8%;" valign="middle" align="center" title="{{ $detalle->comentarios }}" data-tooltip="tooltip">
                          {{ $detalle->folio_recibo }}
                        </td>
                        <td style="width:32%;" valign="middle" align="left">{{ $detalle->razon_social }} - {{ $detalle->rfc }}</td>
                        <td style="width:10%;" align="center" valign="middle" title="Agregado {{ Carbon\Carbon::parse($detalle->fecha)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($detalle->fecha)->format('d/m/Y') }}</td>
                        <td style="width:10%;" valign="middle" align="right">{{ number_format($detalle->total,2) }}</td>
                        <td style="width:10%;" valign="middle" align="right">{{ number_format($detalle->monto,2) }}</td>
                       <td style="width:10%;" valign="middle" align="right">{{ number_format($detalle->saldo,2) }}</td>                          
                        <td style="width:12%;" align="center">
                          <a 
                            class="btn btn-info btn-xs btn-detalle" 
                            title="Ver detalles de detalle {{ $detalle->id }}" 
                            data-tooltip="tooltip" 
                            data-toggle="modal" 
                            data-target="#modal-detalles" 
                            data-id="{{ $detalle->id }}"
                            data-path="{{ route('facturas.detalles') }}"
                            data-token="{{ csrf_token() }}">
                            <i class="glyphicon glyphicon-th-list"></i>
                          </a>
                          <a 
                            class="btn btn-warning btn-xs" 
                            title="Editar factura o recibo" 
                            data-tooltip="tooltip">
                            <i class="glyphicon glyphicon-edit"></i>
                          </a>
                          <a class="btn btn-xs btn-danger" title="Eliminar detalle/recibo" data-tooltip="tooltip"><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </section>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/vue.js') }}"></script>
<script src="{{ asset('js/axios.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
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
<!-- bootstrap datepicker -->
<script src="{{ asset('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('admin/plugins/datepicker/locales/bootstrap-datepicker.es.js') }}"></script>
<!-- Chosen Jquery select -->
<script src="{{ asset('js/chosen.jquery.min.js') }}"></script>
<!-- Bootstrap WYSIHTML5 
<script src="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>-->
<!-- CK Editor 
<script src="{{ asset('admin/js/ckeditor/ckeditor.js') }}"></script>-->
<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
<script>
  $('#liFacturas').addClass("treeview active");
  $('#subCobranza').addClass("active");
</script>
<script type="text/javascript">
      $(".chosen").chosen();
</script>
<!--<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
  });
</script>-->
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
      $.get('/admin/facturas/razones/' + id_cliente, function(data)
      {
          console.log(data);

              $('#id_razon_social').empty();

          $.each(data, function(index, subcatObj)
          {

              $('#id_razon_social').append('<option value ="'+ subcatObj.id +'">'+subcatObj.razon_social+' | '+ subcatObj.rfc +'</option>');

          });
      });
  });
</script>
<script>
  $(document).ready(function()
  {
    $(".btn-detalle").on('click', function(e)
    {
      //e.preventDevault();
      var id_factura = $(this).data('id');
      var path = $(this).data('path');
      var token = $(this).data('token');
      var modal_body = $(".modal-body");
      var loading = '<p>' +
                      '<i class="fa fa-circle-o-notch fa-spin"></i> Cargando datos' +
                    '</p>';
      var table = $("#table-detalle tbody");
      var data = {'_token' : token, 'id' : id_factura}

      //modal_title.html('Detalle del Pedido: ' + parseFloat(id_pedido).toFixed(2));
      table.html(loading);
      console.log(data);

      $.post
      (
        path, 
        data, 
        function(data)
        {
          //console.log(response);
          table.html("");

          for(var i=0; i<data.length; i++)
          {
            var fila = '<tr style="font-size: 16px">';
            fila += '<td style="width:80%;" valign="left">' + data[i].clave + ' ' + data[i].servicio + ' ' + data[i].tramite  + ' ' + data[i].clase + '</td>';   
            fila += '<td style="width:20%;" valign="middle" align="right">' + parseFloat(data[i].monto).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString() + '</td>';
            fila += '</tr>';

            table.append(fila);  
            //console.log(fila);
          }
        }, 
        'json'
      );
    });
  });
</script>
<script>
  $(document).ready(function()
  {
    $("#btn_agregar_razon").on('click', function()
      {

        select_cliente = $('#id_cliente_select').val();
        input_cliente = $('#id_cliente_input').val();

        console.log(select_cliente);
        console.log(input_cliente);

        if(select_cliente > 0)
        {
          $("#id_cliente_razon").val(select_cliente);
        }
        else if(input_cliente > 0)
        {
          $("#id_cliente_razon").val(input_cliente);
        }


      });

    $("#guardar").click(function()
    {
      Actualizar_datos();
    });

    $("#agregarFactura").click(function()
    {
      $( "#agregarFacturaForm" ).submit();
    });

    $("#btn_razon").on('click', function(e)
    {
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

      e.preventDefault(); 

      id_cliente_razon = $("#id_cliente_razon").val();

      if(id_cliente_razon == '')
      {
        toastr.error('No hay cliente seleccionado, cierre la ventana y seleccione un cliente para poder asignarle una razón social.');
      }
      else
      {
        razon = $("#razon_social_razon").val();
        rfc = $("#rfc_razon").val();
        

        if(razon == '')
        {
          toastr.error('Anote una razón social');
        }
        else if (rfc == '')
        {
          toastr.error('Anote un RFC.');
        }
        else
        {
          Agregar_razon();
        }
      }
    });
  });

  function Agregar_razon()
  {
    var formData = 
    {
      '_token': $('input[name=_token]').val(),
      razon_social: $('input[name=razon_social_razon]').val(),
      rfc: $('input[name=rfc_razon]').val(),
      id_admin: $('input[name=id_admin_razon]').val(),
      id_cliente: $('input[name=id_cliente_razon]').val(),
      estatus: $('input[name=estatus_razon]').val()
    }    

    $.ajax(
    {
        type: 'POST',
        dataType: 'json',
        url: '/admin/clientes/insertar-razon',
        data: formData,
        success: function(data) 
        {
          toastr.success('Se insertó de forma correcta la razón social.'); 

          id_cliente = $("#id_cliente_razon").val();      

          //ajax
          $.get('/admin/facturas/razones/' + id_cliente, function(data)
          {
              console.log(data);

                  $('#id_razon_social').empty();

              $.each(data, function(index, razObj)
              {

                  $('#id_razon_social').append('<option value ="'+ razObj.id +'">'+razObj.razon_social+' | '+ razObj.rfc +'</option>');

              });
          });

          var nada='';
          $('#razon_social_razon').val(nada);
          $('#rfc_razon').val(nada);

          $('#agregar_razon').modal('toggle'); 


          
        },
        error: function (data) 
        {
            console.log('Error:', data);
        }
    });
  }

  function Actualizar_datos()
  {
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });

    total = $('input[name=total]').val();
    fecha = $('input[name=fecha]').val();
    id_cliente_input = $('#id_cliente_input').val();
    id_cliente_select = $('#id_cliente_select').val();

    console.log(total);
    console.log(fecha);
    console.log(id_cliente_input);
    console.log(id_cliente_select);

    if(total == '' | total == 0)
    {
      toastr.error('El monto Total no puede ser "0" o nulo');
    }
    else if(fecha == '')
    {
      toastr.error('La fecha no puede estar vacía');
    }
    else if(id_cliente_select == '' || id_cliente_input == '')
    {
      toastr.error('Seleccione un cliente');
    }
    else
    {
      var id_cobranza = $('#id_cobranza').val();
      console.log(id_cobranza);

      var formData = 
      {
        '_token': $('input[name=_token]').val(),
        concepto: $('textarea[name=concepto]').val(),
        id_cliente_input: $('#id_cliente_input').val(),
        id_cliente_select: $('#id_cliente_select').val(),
        fecha: $('input[name=fecha]').val(),
        cheque: $('input[name=cheque]').val(),
        movimiento: $('input[name=movimiento]').val(),
        total: $('input[name=total]').val(),
        pagado: $('input[name=pagado]').val(),
        estatus: $('input[name=estatus]').val(),
        pagado_boolean: $('input[name=pagado_boolean]').val(),
        id_forma_pago: $('select[name=id_forma_pago]').val(),
        id_cuenta: $('select[name=id_cuenta]').val(),
        id_razon_social: $('select[name=id_razon_social]').val(),
      } 

      $.ajax(
      {
        type: 'PUT',
        dataType: 'json',
        url: '/admin/cobranza/actualizar/' + id_cobranza,
        data: formData,
        success: function(data)
        {
          toastr.success('Se actualizó el registro exitosamente');
          id_cliente = $("#id_cliente_razon").val();      

          //ajax
          
        },
        error: function (data) 
        {
            console.log('Error:', data);
        }
      });



      //console.log(formData);
      //$("#edtiarForm").submit();
    }

    
  }
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Date picker
    $('.datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
      //format: 'dd-mm-yyyy'
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