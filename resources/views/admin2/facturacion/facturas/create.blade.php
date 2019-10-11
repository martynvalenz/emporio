@extends('admin.app')

@section('title')
<title>Emporio Legal | Crear Factura</title>
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
      Crear Factura
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.emporio') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('facturas.index') }}">Facturas</a></li>
      <li class="active">Crear</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="box box-default">
      <div class="box-header with-border">
        
      </div>

      <div class="box-body">     

        <form role="form" action="{{ route('facturas.store') }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          
          <div class="row">
              <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                <div class="form-group {{ $errors->has('id_cliente') ? ' has-error' : '' }}">
                  <label for="id_cliente" class="control-label">Seleccionar Cliente *</label>
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <select class="form-control selectpicker" name="id_cliente" id="id_cliente" data-live-search="true">
                        <option value="">Sin selección</option>
                        @foreach($clientes as $cliente)
                          <option value="{{ $cliente->id }}">{{ $cliente->nombre_comercial }}</option>
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

              <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                <div class="form-group {{ $errors->has('id_cliente') ? ' has-error' : '' }}">
                  <label for="id_cliente" class="control-label">Fecha *</label>
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="date" id="fecha" name="fecha" class="form-control">
                  </div>
                  @if ($errors->has('id_cliente'))
                      <span class="help-block">
                          <strong>{{ $errors->first('id_cliente') }}</strong>
                      </span>
                  @endif
                </div>                
              </div>

              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="form-group {{ $errors->has('folio_factura') ? ' has-error' : '' }}">
                  <label for="folio_factura" class="control-label">Folio de Factura *</label>
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i></span>
                      <input type="text" class="form-control" name="folio_factura" value="{{ old('folio_factura') }}">
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
                      <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                      <select name="id_razon_social" id="id_razon_social" class="form-control">
                        <option value="">-Seleccionar opción-</option>
                      </select>
                      <div class="input-group-btn">
                        <a class="btn btn-info" title="Agregar nueva razón social" data-tooltip="tooltip" data-toggle="modal" data-target="#agregar_razon"><i class="fa fa-plus"></i></a>
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
            <hr>
            <div class="row">
              <div class="panel panel-primary">
                <div class="panel-body">
                  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="form-group {{ $errors->has('id_servicio') ? ' has-error' : '' }}">
                      <label for="id_servicio" class="control-label">Seleccionar Servicio *</label>
                      <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                          <select id="id_servicio" class="form-control">
                            <option value="">-Seleccionar opción-</option>
                          </select>
                          <div class="input-group-btn">  
                            <button type="button" class="btn btn-danger" id="btn_borrar" data-tooltip="tooltip" title="Borrar servicio" onclick="event.preventDefault();"><i class="glyphicon glyphicon-erase"></i></button>
                          </div>
                      </div>
                        <input type="hidden" id="id_servicio_val">
                        <input type="hidden" id="servicio_val">
                      @if ($errors->has('id_servicio'))
                          <span class="help-block">
                              <strong>{{ $errors->first('id_servicio') }}</strong>
                          </span>
                      @endif
                    </div>                
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="form-group {{ $errors->has('monto_ini') ? ' has-error' : '' }}">
                      <label for="monto_ini" class="control-label">Monto Pendiente *</label>
                      <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-money"></i></span>
                          <input type="text" id="monto_ini" class="form-control" style="text-align: center">
                          <div class="input-group-btn">  
                            <button type="button" class="btn btn-info" id="bt_add" data-tooltip="tooltip" title="Agregar servicio a la factura"><i class="fa fa-plus"></i></button>
                          </div>
                      </div>
                      <input type="hidden" id="monto_val">
                      @if ($errors->has('monto_ini'))
                          <span class="help-block">
                              <strong>{{ $errors->first('monto_ini') }}</strong>
                          </span>
                      @endif
                    </div>                
                  </div>
                  <br>
                  <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                      <table style="font-size: 16px" id="detalles" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
                          <thead style="background-color:#0D3798;color:white;">
                              <th>Quitar</th>
                              <th>Servicio</th>
                              <th>Monto</th>
                          </thead>
                          <tbody>
                             
                          </tbody>
                      </table>
                   </div>
                   <div class="col-md-offset-8 col-md-4">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
                        <tbody style="font-size: 18px">
                          <tr id="totales-carrito">
                            <td>Subtotal</td>
                            <td align="right" id="subtotal"></td>
                            <input type="hidden" id="subtotal_final" name="subtotal">
                          </tr>
                          <tr id="totales-carrito">
                            <td>Porcentaje IVA</td>
                            <td name="porcentaje_iva">
                              <div class="input-group pull-right" style="width:80%">
                                <input style="text-align: right; font-size: 16px" type="text" id="porcentaje_iva" name="porcentaje_iva" value="{{ $porcentaje_iva->porcentaje_iva }}" class="form-control">
                                <div class="input-group-btn">  
                                  <button type="button" class="btn btn-warning" id="btn_actualizar_iva" data-tooltip="tooltip" title="Actualizar montos" onclick="event.preventDefault();"><i class="glyphicon glyphicon-refresh"></i></button>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr id="totales-carrito">
                            <td>IVA</td>
                            <td align="right" id="iva"></td>
                            <input type="hidden" id="iva_final" name="iva">
                          </tr>
                          <tr id="totales-carrito">
                            <td>Total</td>
                            <td align="right" id="total"></td>
                            <input type="hidden" id="total_final" name="total">
                          </tr>
                        </tbody>
                      </table>
                    </div>
                   </div>
                </div>
              </div>
            </div>

          <hr>
          
          <div class="form-group pull-right">
            <input name="_token" value="{{ csrf_token() }}" type="hidden">
            <input type="hidden" value="Pendiente" name="estatus">
            <input type="hidden" value="{{ Auth::user()->id }}" name="id_admin">
            <a href="{{ route('facturas.index') }}" type="button" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Regresar
            </a>
            <button type="submit" id="guardar" class="btn btn-azul">Guardar <i class="glyphicon glyphicon-floppy-disk"></i></button>
          </div>
        </form>

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
<script>
  $('#liFacturas').addClass("treeview active");
  $('#subFacturas').addClass("active");
</script>9
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
  
  $(document).ready(function()
  {
    $('#bt_add').click(function()
    {
      agregarValor();
    });

    $("#btn_actualizar_iva").click(function() 
    {
      totales();
    });

    $("#btn_borrar").click(function() 
    {
      limpiar();
    });
  });

  var cont=0;
  total=0;
  iva=0;
  subtotal=[];
  $("#id_servicio").change(mostrarValores);
  $("#guardar").hide();


  function mostrarValores()
  {
    datosServicio=document.getElementById('id_servicio').value.split('_');
    $("#id_servicio_val").val(datosServicio[0]); 
    //$("#monto").val(datosServicio[1]); 
    //$("#monto_val").val(datosServicio[1]); 
    costo=datosServicio[1];
    facturado=datosServicio[6];
    costo=costo*1;
    facturado=facturado*1;

    clave= datosServicio[2];
    servicio=datosServicio[3];
    tramite=datosServicio[4];
    clase=datosServicio[5];
    servicio_val=clave+' '+servicio+' '+tramite+' '+clase;
    $("#servicio_val").val(servicio_val);


    monto_pendiente=costo-facturado;
    $("#monto_ini").val(monto_pendiente);
    $("#monto_val").val(monto_pendiente);

  }

  function agregarValor()
  {
    monto = $("#monto_ini").val();
    monto_val = $("#monto_val").val();
    id_servicio = $("#id_servicio_val").val();
    servicio = $("#servicio_val").val();


    monto = monto *1;
    monto_val = monto_val*1;

    if(id_servicio == "")
    {
      toastr.error('No se ha seleccionado un servicio');
    }
    else if(monto_val < monto)
    {
      toastr.error('El monto del servicio no puede ser mayor al saldo del mismo!');
    }
    
    else
    {

      subtotal[cont] = monto;
      total = total + subtotal[cont];

      var fila = '<tr class="selected" id="fila'+cont+'">'+
                    '<td style="width:5%;" align="center">'+
                      '<button type="button" class="btn btn-danger btn-xs" onclick="eliminar('+cont+');">'+
                        '<i class="glyphicon glyphicon-remove"></i>'+
                      '</button>'+
                    '</td>'+
                    '<td style="width:85%;" align="left" input type="hidden" name="id_servicio[]" value="'+id_servicio+'">'+
                      servicio+
                    '</td>'+
                    '<td style="width:10%;">'+
                      '<input type="number" name="monto[]" style="text-align:right" value="'+parseFloat(monto).toFixed(2)+'" max="'+monto_val+'">'+
                    '</td>'+
                  '</tr>';

      cont++;
      limpiar();
      totales();
      evaluar();
      $("#detalles").append(fila);

    }
    
  }

  function limpiar()
  {
    $("#id_servicio").val("");
    $("#id_servicio_val").val(""); 
    $("#monto_ini").val(""); 
    $("#monto_val").val(""); 
    $("#servicio_val").val(""); 
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
    
    /*Calcumos el impuesto
    if ($("#impuesto").is(":checked"))
    {
        por_impuesto=18;
    }
    else
    {
        por_impuesto=0;   
    }
    total_impuesto=total*por_impuesto/100;
    total_pagar=total+total_impuesto;
    $("#total_impuesto").html("S/. " + total_impuesto.toFixed(2));
    $("#total_pagar").html("S/. " + total_pagar.toFixed(2));*/
  }

  function evaluar()
  {
    if(total>0)
    {
      $("#guardar").show();
    }
    else
    {
      $("#guardar").hide();
    }
  }

  function eliminar(index)
  {
    total=total-subtotal[index]; 
    totales();  
    $("#fila" + index).remove();
    evaluar();
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
              $('#id_razon_social').append('<option value =""></option>');

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