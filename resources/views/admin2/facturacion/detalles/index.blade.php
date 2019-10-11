
@extends('admin.app')

@section('title')
<title>Emporio Legal | Detalles de Facturas</title>
@endsection

@section('styles')
    <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
  <!-- Datatables 
  <link href="{{ asset('admin/dataTable Bootstrap/datatables.css') }}" rel="stylesheet">-->
    <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
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
        Detalles de Facturas
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.emporio') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Detalles de Facturas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div id="crud" class="row">
        <div class="col-xs-12">
          <div class="box">
              <div class="box-header">
                <div class="btn-group">
                  <a class="btn btn-azul" data-toggle="modal" data-target="#agregar" data-tooltip="tooltip" title="Agregar una nueva Factura"><i class="fa fa-plus"></i> Agregar Factura
                  </a>
                  @include('admin.facturacion.facturas.factura')
                  <a class="fancybox btn btn-default" rel="group" href="{{ asset('images/institucional/diagrama.png') }}" title="Ver diagrama de procesos" data-tooltip="tooltip"><i class="fa fa-sitemap"></i></a>
                  <a class="various fancybox.iframe btn btn-default" rel="group" href="https://www.youtube.com/embed/-gWUHa5kIlw?autoplay=1" title="Video-tutorial" data-tooltip="tooltip">?</a>
                </div>
              </div>

              <hr>

              <div class="container">
                <div class="row">
                  <div class="col-lg-6 div col-md-6 col-sm-12 col-xs-12">
                    {!! Form::open(array('url'=>'admin/detalle-facturas','method'=>'GET','autocomplete'=>'on','role'=>'search')) !!}
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}" title="Buscar detalle de factura por Nombre Comercial, Razon Social, RFC, montos, servicio, etc...">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-default" data-tooltip="tooltip" title="Dar clic para iniciar búsqueda..."><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                          <a href="{{ route('detalle-facturas.index') }}" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fa fa-refresh" aria-hidden="true"></i> Borrar</a>
                        </span>
                      </div>
                    </div>

                    {{Form::close()}}
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                {{$detalles->render()}}
              @if(count($detalles) > 0)
                <div class="table-responsive">
                  <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
                    <thead style="font-size: 15px">
                      <tr>
                        <th hidden>ID</th>
                        <th hidden>Id_factura</th>
                        <th hidden>Id_Servicio</th>
                        <th>Factura</th>
                        <th>Recibo</th>
                        <th>Cliente - Servicio</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Usuario</th>
                        <th>Estatus?</th>
                        <th colspan ="1">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody style="font-size: 15px" id="list" name="list">
                    @foreach($detalles as $key => $detalle)
                      <tr id="detalle{{ $detalle->id }}">
                        <td hidden>{{ $detalle->id }}</td>
                        <td hidden>{{ $detalle->id_factura }}</td>
                        <td hidden>{{ $detalle->id_servicio }}</td>
                        <td style="width:8%;" valign="middle" align="center" data-target="#modal-detalles-{{ $detalle->id }}" data-toggle="modal" title="Detalles">{{ $detalle->folio_factura }}</td>
                        <td style="width:8%;" valign="middle" align="center" data-target="#modal-detalles-{{ $detalle->id }}" data-toggle="modal" title="Detalles">{{ $detalle->folio_recibo }}</td>
                        <td style="width:37%;" valign="middle" align="left" data-target="#modal-detalles-{{ $detalle->id }}" data-toggle="modal" title="{{ $detalle->razon_social }} {{ $detalle->rfc }}" data-tooltip="tooltip">{{ $detalle->nombre_comercial }} - {{ $detalle->clave }} {{ $detalle->servicio }} {{ $detalle->marca }} {{ $detalle->tramite }} {{ $detalle->clase }}</td>
                        <td style="width:8%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($detalle->created_at)->diffForHumans() }}" data-target="#modal-detalles-{{ $detalle->id }}" data-toggle="modal" data-tooltip="tooltip">{{ Carbon\Carbon::parse($detalle->created_at)->format('d/m/Y') }}</td>
                       <td style="width:8%;" valign="middle" align="right" data-target="#modal-detalles-{{ $detalle->id }}" data-toggle="modal">{{ number_format($detalle->monto,2) }}</td>
                        <td style="width:5%;" align="center" valign="middle" data-target="#modal-detalles-{{ $detalle->id }}" data-toggle="modal" data-tooltip="tooltip" title="{{ $detalle->nombre }} {{ $detalle->apellido }}">{{ $detalle->iniciales }}</td>
                        <td style="width:8%;" align="center" valign="middle" title="Detalles" data-target="#modal-detalles-{{ $detalle->id }}" data-toggle="modal">
                          @if($detalle->pagado_det == 1)
                            <label class="label label-success">Pagado</label>
                          @elseif($detalle->pagado_det == 0)
                            <label class="label label-warning">Pendiente</label>
                          @endif
                        </td>
                        <td hidden>{{ $detalle->id }}</td>
                        <td style="width:10%;" align="center">
                          @if($detalle->estatus == 'Pagado' || $detalle->pagado > 0)
                            <a class="btn btn-xs btn-warning" data-target="#modal-editar-detalles-{{ $detalle->id }}" data-toggle="modal" data-tooltip="tooltip" title="Editar detalle: #{{ $detalle->id }}">
                              <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a class="btn btn-xs btn-default" title="No se puede cancelar un detalle de una factura que tiene pagos asociados" data-tooltip="tooltip" disabled>
                              <i class="glyphicon glyphicon-remove"></i>
                            </a> 
                          @elseif($detalle->estatus == 'Pendiente')
                            <a class="btn btn-xs btn-warning" data-target="#modal-editar-detalles-{{ $detalle->id }}" data-toggle="modal" data-tooltip="tooltip" title="Editar detalle: # {{ $detalle->id }}">
                              <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a class="btn btn-xs btn-danger" data-target="#modal-eliminar-detalles-{{ $detalle->id }}" data-toggle="modal" title="Cancelar detalle: # {{ $detalle->id }}" data-tooltip="tooltip">
                              <i class="glyphicon glyphicon-remove"></i>
                            </a>  
                          @elseif($detalle->estatus == 'Cancelado')
                            <a class="btn btn-xs btn-default" data-tooltip="tooltip" title="No se puede editar un detalle que ya está eliminado." disabled>
                              <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a class="btn btn-xs btn-success" data-target="#modal-activar-detalle-{{ $detalle->id }}" data-toggle="modal" title="Activar detalle: # {{ $detalle->id }}" data-tooltip="tooltip">
                              <i class="glyphicon glyphicon-ok"></i>
                            </a>  
                          @endif
                        </td>
                      </tr>
                      @include('admin.facturacion.detalles.eliminar')
                      @include('admin.facturacion.detalles.edit-detalles')
                      @include('admin.facturacion.detalles.detalles')
                    @endforeach
                    </tbody>
                  </table>
                </div>

              {{$detalles->render()}}
              @else
                <h4>No hay registros encontrados, inicie por crear uno nuevo.</h4>
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
    $('#liFacturas').addClass("treeview active");
    $('#subDetallesFact').addClass("active");
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
<!--<script>
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
</script>-->
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