@extends('admin.app')

@section('title')
<title>Emporio Legal | Factura {{ $factura->folio_factura }}</title>
@endsection

@section('styles')
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
      <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
    <!-- Chosen select -->
    <link rel="stylesheet" href="{{ asset('css/chosen.min.css') }}">
    <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/datepicker/datepicker3.css') }}">
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
      Factura: {{ $factura->folio_factura }}
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
      <li><a href="{{ route('facturas.index') }}">Facturas</a></li>
      <li class="active">Factura: {{ $factura->folio_factura }}</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="box box-default">
      <div class="box-header with-border">
        <!--<h3>Edición de factura y asignación de servicios</h3>-->
      </div>

      <div class="box-body">     

        <form role="form" id="edtiarForm" action="{{ route('facturas.update', $factura->id) }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          
          <div class="row">
            <input type="hidden" id="id_factura" name="id_factura" value="{{ $factura->id }}" >
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
              <div class="form-group {{ $errors->has('id_cliente') ? ' has-error' : '' }}">
                <label for="id_cliente" class="control-label">Seleccionar Cliente <b style="color:red">*</b></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-trophy"></i></span>
                    @if(count($detalles) > 0)  
                      <select class="form-control selectpicker" data-live-search="true" disabled>
                        @foreach($clientes as $cliente)
                          @if($cliente->id == $factura->id_cliente)
                            <option value="{{ $cliente->id }}" selected>{{ $cliente->nombre_comercial }}</option>
                          @else
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre_comercial }}</option>
                          @endif
                        @endforeach
                      </select>
                      <input type="hidden" name="id_cliente" id="id_cliente_input" value="{{ $factura->id_cliente }}">
                    @else
                      <select class="form-control selectpicker" name="id_cliente" id="id_cliente_select" data-live-search="true">
                        @foreach($clientes as $cliente)
                          @if($cliente->id == $factura->id_cliente)
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
                    <input type="text" id="fecha" name="fecha" class="form-control datepicker" value="@if(old('fecha')){{ old('fecha') }}@else{{ $factura->fecha }}@endif">
                </div>
                @if ($errors->has('fecha'))
                    <span class="help-block">
                        <strong>{{ $errors->first('fecha') }}</strong>
                    </span>
                @endif
              </div>                
            </div>

            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
              <div class="form-group {{ $errors->has('folio_factura') ? ' has-error' : '' }}">
                <label for="folio_factura" class="control-label">Folio de Factura <b style="color:red">*</b></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="far fa-file-pdf"></i></span>
                    <input type="text" class="form-control" name="folio_factura" value="@if(old('folio_factura')){{ old('folio_factura') }}@else{{ $factura->folio_factura }}@endif">
                </div>
                @if ($errors->has('folio_factura'))
                    <span class="help-block">
                        <strong>{{ $errors->first('folio_factura') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-12">
              <div class="form-group {{ $errors->has('id_razon_social') ? ' has-error' : '' }}">
                <label for="id_razon_social" class="control-label">Seleccionar Razón Social</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-qrcode"></i></span>
                    <select name="id_razon_social" id="id_razon_social" class="form-control">
                      @foreach($razones_sociales as $razon)
                        @if($razon->id == $factura->id_razon_social)
                          <option value="{{ $razon->id }}" selected>{{ $razon->razon_social }} | {{ $razon->rfc }}</option>
                        @else
                          <option value="{{ $razon->id }}">{{ $razon->razon_social }} | {{ $razon->rfc }}</option>
                        @endif
                      @endforeach
                    </select>
                    <div class="input-group-btn">
                      <a class="btn btn-info" title="Agregar nueva razón social" data-tooltip="tooltip" data-toggle="modal" data-target="#agregar_razon" id="btn_agregar_razon"><i class="fa fa-plus"></i>
                      </a>
                    </div>
                    
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <label for="comentarios">Comentarios</label>
              <textarea name="comentarios" id="comentarios" rows="3" class="form-control">@if(old('comentarios')){{ old('comentarios') }}@else{{ $factura->comentarios }}@endif</textarea>
            </div>
          </div>

          <br>

          <div class="row">
            <div class="form-group pull-right">
              <div class="col-lg-12">
                <input name="_token" value="{{ csrf_token() }}" type="hidden">
                <input type="hidden" value="Pendiente" name="estatus">
                <input type="hidden" value="{{ Auth::user()->id }}" name="id_admin">
                <a href="{{ route('facturas.index') }}" type="button" class="btn btn-warning btn-flat"><i class="glyphicon glyphicon-menu-left"></i> Facturas
                </a>
                <button type="submit" id="guardar" class="btn btn-azul btn-flat">Guardar <i class="glyphicon glyphicon-floppy-disk"></i></button>
                <a class="btn btn-success btn-flat">Pagar Facturas <i class="far fa-money-bill-alt"></i></a>
              </div>
            </div>
          </div>
              
        </form>
            <hr>
            
          <div class="row">
            @if(count($servicios_seleccionar) > 0)
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
                <h3>Servicios Pendientes por facturar</h3>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover table-responsive" style="font-size: 16px">
                    <thead style="background-color: #cc6600; color:white">
                      <tr>
                        <th>Id</th>
                        <th hidden>Inputs</th>
                        <th>Clave</th>
                        <th>Marca</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Facturado</th>
                        <th>Pendiente</th>
                        <th colspan="1">&nbsp;</th>
                      </tr> 
                    </thead>
                    <tbody>
                      @foreach($servicios_seleccionar as $servicio)
                        <form role="form" action="{{ route('facturas.insertar-detalle') }}" method="post">
                        {{ csrf_field() }}
                          <tr id="servicio{{ $servicio->id }}">
                            <td style="width:10%;" valign="middle" align="left">{{ $servicio->id }}</td>
                            <td hidden>
                              <input type="hidden" name="id_servicio" value="{{ $servicio->id }}">
                              <input type="hidden" name="id_factura" value="{{ $factura->id }}">
                              <input type="hidden" name="subtotal" value="{{ $factura->subtotal }}">
                              <input type="hidden" name="porcentaje_iva" value="{{ $factura->porcentaje_iva }}">
                              <input type="hidden" name="iva" value="{{ $factura->iva }}">
                              <input type="hidden" name="total" value="{{ $factura->total }}">
                              <input type="hidden" name="pagado" value="{{ $factura->pagado }}">
                              <input type="hidden" name="facturado" value="{{ $servicio->facturado }}">
                              <input type="hidden" name="costo" value="{{ $servicio->costo }}">
                            </td>
                            <td style="width:10%;" valign="middle" align="left" title="{{ $servicio->servicio }}" data-tooltip="tooltip">
                              {{ $servicio->clave }}
                            </td>
                            <td style="width:33%;" valign="middle" align="left">{{ $servicio->tramite }} {{ $servicio->nombre }} {{ $servicio->clase }}</td>
                            <td style="width:10%;" align="center" valign="middle" title="Agregado {{ Carbon\Carbon::parse($servicio->created_at)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->created_at)->format('d/m/Y') }}</td>
                            <td style="width:12%;" valign="middle" align="right" data-tooltip="tooltip">
                              <input type="number" class="form-control" value="{{ $servicio->costo - $servicio->facturado }}" style="text-align: right" name="monto" max="{{ $servicio->costo - $servicio->facturado }}" title="Monto pendiente por facturar: {{ ($servicio->costo - $servicio->facturado) }}" data-tooltip="tooltip">
                            </td>
                            <td style="width:10%;" valign="middle" align="right">{{ number_format($servicio->facturado,2) }}</td>
                            <td style="width:10%;" valign="middle" align="right">{{ number_format($servicio->costo - $servicio->facturado,2) }}</td>
                            <td style="width:5%;" align="center">
                              <button 
                                class="btn btn-success btn-xs btn-insertar btn-flat" 
                                title="Agregar el servicio #{{ $servicio->id }} a la factura" 
                                data-tooltip="tooltip"
                                type="submit"
                                >
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
            @else
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
                <h3>No hay servicios pendientes por facturar</h3>
              </div>
            @endif
          </div>

            <hr>

          <div class="row">
            @if(count($detalles) > 0)
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
                <h3>Servicios facturados</h3>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover table-responsive" style="font-size: 16px">
                    <thead style="background-color: #0B3798; color:white">
                      <tr>
                        <th>Id</th>
                        <th>Clave</th>
                        <th>Marca</th>
                        <th>Fecha</th>
                        <th>Facturado</th>
                        <th>Pendiente</th>
                        <th colspan="1">&nbsp;</th>
                      </tr> 
                    </thead>
                    <tbody>
                      @foreach($detalles as $det)
                        <tr id="det{{ $det->id }}">
                          <td style="width:10%;" valign="middle" align="left">{{ $det->id_servicio }}</td>
                          <td style="width:10%;" valign="middle" align="left" title="{{ $det->servicio }}" data-tooltip="tooltip">
                            {{ $det->clave }}
                          </td>
                          <td style="width:40%;" valign="middle" align="left">{{ $det->tramite }} {{ $det->marca }} {{ $det->clase }}</td>
                          <td style="width:10%;" align="center" valign="middle" title="Agregado {{ Carbon\Carbon::parse($det->created_at)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($det->created_at)->format('d/m/Y') }}</td>
                          <td style="width:10%;" valign="middle" align="right" data-tooltip="tooltip">{{ number_format($det->monto,2) }}</td>
                          <td style="width:10%;" valign="middle" align="right">{{ number_format($det->costo - $det->facturado,2) }}</td>
                          <td style="width:10%;" align="center">
                            <a 
                              class="btn btn-warning btn-xs btn-detalle btn-flat" 
                              data-tooltip="tooltip" title="Editar monto de factura" data-target="#modal-editar-detalles-{{ $det->id }}" data-toggle="modal">
                              <i class="fas fa-edit"></i>
                            </a>
                            <button 
                              class="btn btn-danger btn-xs btn-insertar btn-flat" 
                              title="Quitar servicio de la factura" 
                              data-tooltip="tooltip" data-target="#modal-eliminar-detalles-{{ $det->id }}" data-toggle="modal">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                          </td>
                        </tr>
                        @include('admin.facturacion.facturas.edit-detalles')
                        @include('admin.facturacion.facturas.eliminar')
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            @else
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
                <h3>No hay servicios anexados a la factura</h3>
              </div>
            @endif
          </div>

          <div class="row">
            <div class="col-md-offset-8 col-md-4 col-sm-12 col-xs-12">
             <div class="table-responsive" style="font: bold; border: 1px solid #D2D6DF;">
               <table class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%" >
                 <tbody style="font-size: 18px">
                   <tr id="totales-carrito">
                     <td>Subtotal</td>
                     <td align="right" id="subtotal">$ {{number_format($factura->subtotal,2)}}</td>
                     <input type="hidden" id="subtotal_final" name="subtotal_final" value="{{ $factura->subtotal }}">
                   </tr>
                   <tr id="totales-carrito">
                     <td>Porcentaje IVA</td>
                     <td name="porcentaje_iva">
                       <div class="input-group pull-right" style="width:80%">
                         <input style="text-align: right; font-size: 16px" type="text" id="porcentaje_iva" name="porcentaje_iva" value="{{ $factura->porcentaje_iva }}" class="form-control">
                         <div class="input-group-btn">  
                           <button type="button" class="btn btn-warning" id="btn_actualizar_iva" data-tooltip="tooltip" title="Actualizar montos por cambio de IVA" onclick="event.preventDefault();"><i class="glyphicon glyphicon-refresh"></i></button>
                         </div>
                       </div>
                     </td>
                   </tr>
                   <tr id="totales-carrito">
                     <td>IVA</td>
                     <td align="right" id="iva">$ {{number_format($factura->iva,2)}}</td>
                     <input type="hidden" id="iva_final" name="iva_final" value="{{ $factura->iva }}">
                   </tr>
                   <tr id="totales-carrito">
                     <td>Total</td>
                     <td align="right" id="total">$ {{number_format($factura->total,2)}}</td>
                     <input type="hidden" id="total_final" name="total" value="{{ $factura->total }}">
                     <input type="hidden" id="pagado" name="pagado" value="{{ $factura->pagado }}">
                     <input type="hidden" id="saldo" name="saldo" value="{{ $factura->saldo }}">
                   </tr>
                 </tbody>
               </table>
             </div>
            </div>
          </div>
        </div>

          <hr>
          
          

      </div>
    </div>
    @include('admin.ingresos.cobranza.razon')
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
<!-- Chosen Jquery select -->
<script src="{{ asset('js/chosen.jquery.min.js') }}"></script>
<!-- Bootstrap WYSIHTML5 
<script src="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>-->
<!-- CK Editor 
<script src="{{ asset('admin/js/ckeditor/ckeditor.js') }}"></script>-->
<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('admin/plugins/datepicker/locales/bootstrap-datepicker.es.js') }}"></script>
<script>
  $('#liFacturas').addClass("treeview active");
  $('#subFacturas').addClass("active");
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
  //Date picker
  $('.datepicker').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
    //format: 'dd-mm-yyyy'
  });
</script>
<script>
  
  $(document).ready(function()
  {
    
  });

  $('#bt_add').click(function()
  {
    agregarValor();
  });

  $("#btn_actualizar_iva").click(function() 
  {
    totales();
    guardarIVA();
  });

  $("#btn_borrar").click(function() 
  {
    limpiar();
  });

  $("#guardar").click(function()
  {
    $( "#edtiarForm" ).submit();
  });

  $("#id_servicio").change(mostrarValores);
  var total=0;
  total = $("#subtotal_final").val();
  total = total * 1;
  console.log(total);
  var iva=0;


  function mostrarValores()
  {
    datosServicio=document.getElementById('id_servicio').value.split('_');
    $("#id_servicio_val").val(datosServicio[0]); 
    $("#monto").val(datosServicio[1]); 
    $("#monto_val").val(datosServicio[1]); 
    costo=datosServicio[1];
    facturado=datosServicio[2];
    costo=costo*1;
    facturado=facturado*1;

    monto_pendiente=costo-facturado;
    $("#monto_ini").val(monto_pendiente);
    $("#monto_val").val(monto_pendiente);
    $("#facturado").val(facturado);
    $("#costo").val(costo);

  }

  function agregarValor()
  {
    monto = $("#monto_ini").val();
    monto_val = $("#monto_val").val();
    id_servicio = $("#id_servicio_val").val();
    servicio = $("#servicio_val").val();
    facturado = $("#facturado").val();
    costo = $("#costo").val();

    monto = monto *1;
    monto_val = monto_val*1;
    facturado = facturado * 1;  
    costo = costo * 1;
    facturado_final = facturado + monto;
    total = total *1;
    //console.log(facturado_final);
    facturado_terminado_val =  costo - monto - facturado;


    if(id_servicio == "")
    {
      toastr.error('No se ha seleccionado un servicio');
    }
    else if(monto_val < monto)
    {
      toastr.error('El monto del servicio no puede ser mayor al monto pendiente por facturar');
    }

    else if (monto == 0)
    {
      toastr.error('No se puede facturar ese servicio, ya que el monto restante por facturar es 0.');
    }
    
    else
    {
      if(facturado_terminado_val == 0)
      {
        facturado_terminado = 1;
      }
      else
      {
        facturado_terminado = 0;
      }
      $("#facturado").val(facturado_final);
      $("#facturado_terminado").val(facturado_terminado);

      console.log(facturado_terminado);
      console.log(facturado_terminado_val);
      console.log(facturado_final);

      
      totales_agregar();
      totales();
      Agregar();
      limpiar();
    }
    
  }

  function limpiar()
  {
    $("#id_servicio").val("");
    $("#id_servicio_val").val(""); 
    $("#monto_ini").val(""); 
    $("#monto_val").val(""); 
    $("#servicio_val").val(""); 
    $("#facturado").val(""); 
    $("#costo").val(""); 
    $("#facturado_terminado").val(""); 
  }

  function totales()
  {
    $("#subtotal").html("$ " + total.toFixed(2));
    $("#subtotal_final").val(total.toFixed(2));

    porcentaje_iva = $("#porcentaje_iva").val();
    iva_final = total * (porcentaje_iva / 100);
    total_final = total + iva_final;

    $("#iva").html("$ " + iva_final.toFixed(2));
    $("#iva_final").val(iva_final.toFixed(2));

    $("#total").html("$ " + total_final.toFixed(2));
    $("#total_final").val(total_final.toFixed(2));
  }

  function totales_agregar()
  {
    total = monto + total;
    console.log(total);
  }

  function Agregar()
  {
    var formData = 
    {
        '_token': $('input[name=_token]').val(),
        monto: $('input[name=monto_ini]').val(),
        id_servicio: $('input[name=id_servicio_val]').val(),
        id_factura: $('input[name=id_factura]').val(),
        subtotal: $('input[name=subtotal_final]').val(),
        porcentaje_iva: $('input[name=porcentaje_iva]').val(),
        iva: $('input[name=iva_final]').val(),
        total: $('input[name=total]').val(),
        pagado: $('input[name=pagado]').val(),
        facturado: $('input[name=facturado]').val(),
        facturado_terminado: $('input[name=facturado_terminado]').val(),
        saldo: $('input[name=saldo]').val()
    }

    console.log(formData);

    $.ajax(
    {
        type: 'POST',
        dataType: 'json',
        url: '/admin/facturas/insertar-detalle',
        data: formData,
        success: function(data) 
        {
          toastr.success('Se agregó el servicio exitosamente');     
          $('#edtiarForm').submit();
        },
        error: function (data) 
        {
            console.log('Error:', data);
        }
    });
  }

  function guardarIVA()
  {
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

      //e.preventDefault(); 

      var id_factura = $('#id_factura').val();

      var formData = 
      {
          '_token': $('input[name=_token]').val(),
          subtotal: $('input[name=subtotal_final]').val(),
          iva: $('input[name=iva_final]').val(),
          porcentaje_iva: $('input[name=porcentaje_iva]').val(),
          total: $('input[name=total]').val(),
          pagado: $('input[name=pagado]').val(),
          saldo: $('input[name=saldo]').val()
      }

      $.ajax(
      {
          type: 'PUT',
          dataType: 'json',
          url: '/admin/facturas/actualizar-iva/' + id_factura,
          data: formData,
          success: function(data) 
          {
            toastr.success('Se actualizaron los totales de la factura.');    
          },
          error: function (data) 
          {
            toastr.error('No se pudo actualizar el IVA');
          }
      });
  }

  function eliminar(index)
  {
    
  }


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

      //ajax
      $.get('/admin/facturas/servicios/' + id_cliente, function(data)
      {
          console.log(data);

              $('#id_servicio').empty();
              $('#id_servicio').append('<option value ="">--Sin selección--</option>');

          $.each(data, function(index, subcatObj)
          {

              $('#id_servicio').append('<option value ="'+ subcatObj.id +'_'+subcatObj.costo+'_'+subcatObj.clave+'_'+subcatObj.servicio+'_'+subcatObj.tramite+'_'+subcatObj.clase+'_'+subcatObj.facturado+'">'+subcatObj.clave+' '+subcatObj.servicio+' '+subcatObj.tramite+' '+subcatObj.clase+'</option>');

          });
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