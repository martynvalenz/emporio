
@extends('admin.app')

@section('title')
<title>Emporio Legal | Recibos</title>
@endsection

@section('styles')
    <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
  <!-- Datatables 
  <link href="{{ asset('admin/dataTable Bootstrap/datatables.css') }}" rel="stylesheet">-->
    <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
    <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/datepicker/datepicker3.css') }}">
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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Recibos
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
        <li class="active">Recibos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div id="crud" class="row">
        <div class="col-xs-12">
          <div class="box">
              <div class="box-header">
                <div class="btn-group">
                  <a class="btn btn-azul btn-flat" data-toggle="modal" data-target="#agregar" data-tooltip="tooltip" title="Agregar un nuevo recibo"><i class="fa fa-plus"></i> Agregar Recibo
                  </a>
                  @include('admin.facturacion.recibos.recibo')
                  <a class="fancybox btn btn-default" rel="group" href="{{ asset('images/institucional/diagrama.png') }}" title="Ver diagrama de procesos" data-tooltip="tooltip"><i class="fa fa-sitemap"></i></a>
                  <a class="various fancybox.iframe btn btn-default" rel="group" href="https://www.youtube.com/embed/-gWUHa5kIlw?autoplay=1" title="Video-tutorial" data-tooltip="tooltip"><i class="fab fa-youtube"></i></a>
                </div>
              </div>

              <hr>

              <div class="container">
                <div class="row">
                  <div class="col-lg-6 div col-md-6 col-sm-12 col-xs-12">
                    {!! Form::open(array('url'=>'admin/recibos','method'=>'GET','autocomplete'=>'on','role'=>'search')) !!}
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}" title="Buscar recibo por Nombre Comercial del cliente">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-default" data-tooltip="tooltip" title="Dar clic para iniciar búsqueda..."><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                          <a href="{{ route('recibos.index') }}" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fas fa-eraser" aria-hidden="true"></i> Borrar</a>
                        </span>
                      </div>
                    </div>

                    {{Form::close()}}
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
              @if(count($recibos) > 0)
                <div class="table-responsive">
                  <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
                    <thead style="font-size: 15px">
                      <tr>
                        <th>Folio</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Subtotal</th>
                        <th>IVA</th>
                        <th>Total</th>
                        <th>Saldo</th>
                        <th>Creado</th>
                        <th>Estatus?</th>
                        <th hidden>Id</th>
                        <th colspan ="1">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody style="font-size: 15px" id="list" name="list">
                    @foreach($recibos as $key => $recibo)
                      <tr id="recibo{{ $recibo->id }}">
                        <td style="width:8%;" valign="middle" align="left" title="{{ $recibo->comentarios }}" data-tooltip="tooltip" data-target="#modal-detalles-recibo-{{ $recibo->id }}" data-toggle="modal">
                          @if($recibo->estatus == 'Pagado')
                            <label class="label label-success" style="font-size: 15px">{{ $recibo->folio_recibo }}</label>
                          @elseif($recibo->estatus == 'Cancelado')
                            <label class="label label-danger" style="font-size: 15px">{{ $recibo->folio_recibo }}</label>
                          @elseif($recibo->estatus == 'Pendiente')
                            <label class="label label-warning" style="font-size: 15px">{{ $recibo->folio_recibo }}</label>
                          @endif
                        </td>
                        <td style="width:17%;" valign="middle" align="left" data-target="#modal-detalles-recibo-{{ $recibo->id }}" data-toggle="modal" title="{{ $recibo->razon }} {{ $recibo->rfc_cliente }}" data-tooltip="tooltip">{{ $recibo->nombre_comercial }}</td>
                        <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($recibo->fecha)->diffForHumans() }}" data-target="#modal-detalles-recibo-{{ $recibo->id }}" data-toggle="modal" data-tooltip="tooltip">{{ Carbon\Carbon::parse($recibo->fecha)->format('d/m/Y') }}</td>
                        <td style="width:10%;" valign="middle" align="right" data-target="#modal-detalles-recibo-{{ $recibo->id }}" data-toggle="modal">{{ number_format($recibo->subtotal,2) }}</td>
                       <td style="width:10%;" valign="middle" align="right" data-target="#modal-detalles-recibo-{{ $recibo->id }}" data-toggle="modal">{{ number_format($recibo->iva,2) }}</td>
                       <td style="width:10%;" valign="middle" align="right" data-target="#modal-detalles-recibo-{{ $recibo->id }}" data-toggle="modal">{{ number_format($recibo->total,2) }}</td>
                       <td style="width:10%;" valign="middle" align="right" data-target="#modal-detalles-recibo-{{ $recibo->id }}" data-toggle="modal" title="Pagado: {{ number_format($recibo->pagado,2) }}" data-tooltip="tooltip">{{ number_format($recibo->saldo,2) }}</td>
                        <td style="width:7%;" align="center" valign="middle" data-target="#modal-detalles-recibo-{{ $recibo->id }}" data-toggle="modal" data-tooltip="tooltip" title="{{ $recibo->nombre }} {{ $recibo->apellido }}">{{ $recibo->iniciales }}</td>
                        <td style="width:8%;" align="center" valign="middle" title="Detalles" data-target="#modal-detalles-recibo-{{ $recibo->id }}" data-toggle="modal">
                          @if($recibo->estatus == 'Pagado')
                            <label class="label label-success">Pagado</label>
                          @elseif($recibo->estatus == 'Cancelado')
                            <label class="label label-danger">Cancelado</label>
                          @elseif($recibo->estatus == 'Pendiente')
                            <label class="label label-warning">Pendiente</label>
                          @endif
                        </td>
                        <td hidden>{{ $recibo->id }}</td>
                        <td style="width:10%;" align="center">
                          <a 
                            class="btn btn-info btn-xs btn-detalle" 
                            title="Ver detalles de recibo {{ $recibo->folio_recibo }}" 
                            data-tooltip="tooltip" 
                            data-toggle="modal" 
                            data-target="#modal-detalles" 
                            data-id="{{ $recibo->id }}"
                            data-path="{{ route('facturas.detalles') }}"
                            data-token="{{ csrf_token() }}">
                            <i class="glyphicon glyphicon-th-list"></i>
                          </a>
                          @if($recibo->estatus == 'Pagado' || $recibo->pagado > 0)
                            <a class="btn btn-xs btn-warning" href="{{ route('recibos.edit', $recibo->id) }}" data-tooltip="tooltip" title="Editar recibo: # {{ $recibo->folio_recibo }}">
                              <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a class="btn btn-xs btn-default" title="No se puede cancelar una recibo que tiene pagos asociados" data-tooltip="tooltip" disabled>
                              <i class="glyphicon glyphicon-remove"></i>
                            </a> 
                          @elseif($recibo->estatus == 'Pendiente')
                            <a class="btn btn-xs btn-warning" href="{{ route('recibos.edit', $recibo->id) }}" data-tooltip="tooltip" title="Editar recibo: # {{ $recibo->folio_recibo }}">
                              <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a class="btn btn-xs btn-danger" data-target="#modal-cancelar-recibo-{{ $recibo->id }}" data-toggle="modal" title="Cancelar recibo: # {{ $recibo->folio_recibo }}" data-tooltip="tooltip">
                              <i class="glyphicon glyphicon-remove"></i>
                            </a>  
                          @elseif($recibo->estatus == 'Cancelado')
                            <a class="btn btn-xs btn-default" data-tooltip="tooltip" title="No se puede editar una recibo que ya está cancelada, tiene que activarla primero." disabled>
                              <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a class="btn btn-xs btn-success" data-target="#modal-activar-recibo-{{ $recibo->id }}" data-toggle="modal" title="Activar recibo: # {{ $recibo->folio_recibo }}" data-tooltip="tooltip">
                              <i class="glyphicon glyphicon-ok"></i>
                            </a>  
                          @endif
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                
                @include('admin.facturacion.recibos.detalles')
              {{$recibos->render()}}
              @else
                <h4>No hay registros encontrados, inicie por crear uno   nuevo.</h4>
              @endif
              </div>
              <!-- /.box-body -->
            </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

@endsection

@section('scripts')
  <!-- Bootstrap 3.3.6 -->
  <!-- Datatables 
    <script src="{{ asset('admin/dataTable Bootstrap/datatables.js') }}"></script>-->
  <!-- Slimscroll -->
  <script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script>
  <!-- Toastr -->
  <script src="{{ asset('admin/js/toastr.js') }}"></script>
  <!-- SlimScroll 1.3.0 -->
  <script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <!-- bootstrap color picker -->
  <script src="{{ asset('admin/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
  <!-- iCheck 1.0.1 -->
  <script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>
  <!-- InputMask -->
  <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
  <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
  <!-- bootstrap datepicker -->
  <script src="{{ asset('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
  <script src="{{ asset('admin/plugins/datepicker/locales/bootstrap-datepicker.es.js') }}"></script>

  <script>
    $(document).ready(function() {
        $('body').tooltip({
            selector: "[data-tooltip=tooltip]",
            container: "body"
        });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() 
    {
      $(".fancybox").fancybox();
    });
  </script>
  <script>
    $(document).ready(function() {
      $(".various").fancybox({
        maxWidth  : 1280,
        maxHeight : 1000,
        fitToView : true,
        width   : '100%',
        height    : '100%',
        autoSize  : false,
        closeClick  : false,
        openEffect  : 'none',
        closeEffect : 'none'
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
    $('#liFacturas').addClass("treeview active");
    $('#subRecibos').addClass("active");
  </script>
  <script>
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });

    //Data Mask
    $("[data-mask]").inputmask();
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
  $(document).ready(function()
  {

    $("#btn_agregar").click(function(e) 
    {
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

      e.preventDefault(); 

      id_cliente = $("#id_cliente").val();
      folio_factura = $("#folio_factura").val();

      if(id_cliente == '')
      {
        toastr.error('Seleccione un cliente.');
      }
      else if(folio_factura == '')
      {
        toastr.error('Anote el folio de la factura.');
      }
      else
      {
        $('#agregar').modal('toggle'); 
        $( "#agregarForm" ).submit();
      }
      
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
          //console.log(data);

              $('#id_razon_social').empty();

          $.each(data, function(index, subcatObj)
          {

              $('#id_razon_social').append('<option value ="'+ subcatObj.id +'">'+subcatObj.razon_social+' | '+ subcatObj.rfc +'</option>');

          });
      });
  });

  /*$('#btn-detalle').on('click', function (e)
    {
      var id_factura = $(this).data('id');
      console.log(id_factura);

      $('#detalles-list').empty();

      $.post('/admin/facturas/ver-detalles/' + id_factura, function(data)
      {
        $.each(data, function(index, det)
        {
          $('#detalles-list').append('<tr>' +
                                        '<td style="width:80%;" valign="left">' + det.clave + ' ' + det.servicio + ' ' + det.tramite  + ' ' + det.clase + '</td>' + 
                                        '<td style="width:20%;" valign="middle" align="right">' + parseFloat(det.monto).toFixed(2) + '</td>' +
                                      '</tr>');

          console.log(data);
        });
      });
    });*/
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
        var id_cliente_razon="";

        id_cliente_razon = $('select[name=id_cliente]').val();

        if(id_cliente_razon == '')
        {
          id_cliente_razon = $('input[name=id_cliente]').val();
        }

        $("#id_cliente_razon").val(id_cliente_razon);
        id_cliente_razon = '';

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
          Agregar();
        }
      }
    });
  });

  function Agregar()
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
  /*$(document).ready(function() 
  {
    $('#example1').DataTable( 
    {

      dom: 'Bfrtip',
        buttons: 
        [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,



      "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) 
      {
          if(aData[6] == "Activo")
          {
              $('td:eq(6)', nRow).css("background-color", "#c6efce");
              $('td:eq(6)', nRow).css("color", "#006100");
          }
          else if (aData[6] == "Inactivo")
          {
              $('td:eq(6)', nRow).css("background-color", "#ffc7ce");
              $('td:eq(6)', nRow).css("color", "#9c0006");
          }
        }
    });
    
  });*/
  function cellStyle(value, row, index) {
    var classes = ['active', 'success', 'info', 'warning', 'danger'];
    if (index % 6 === 0 && index / 2 < classes.length) {
        return {
            //classes: classes[index / 2]
            css: {
                "background-color": "red",
            }
        };
    }
    return {};
}
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