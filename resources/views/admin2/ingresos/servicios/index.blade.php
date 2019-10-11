@extends('admin.app')

@section('title')
<title>Emporio Legal | Control de Cobranza</title>
@endsection

@section('styles')
    <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
  <!-- Datatables 
  <link href="{{ asset('admin/dataTable Bootstrap/datatables.css') }}" rel="stylesheet">-->
    <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
    
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
    <!-- Light Gallery Plugin Css -->
    <link href="{{ asset('admin/emporio/plugins/light-gallery/css/lightgallery.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/lightbox2.css') }}">
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
        Control de Servicios, Facturas y Recibos
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
        <li class="active">Control de Servicios</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div id="crud" class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="btn-group">
                  @include('admin.procesos.agregar-servicio')
                <a data-target="#agregar-cliente" data-toggle="modal" class="btn btn-info btn-flat" title="Agregar cliente nuevo" data-tooltip="tooltip"><i class="fa fa-user-plus"></i> Agregar Cliente <i class="glyphicon glyphicon-circle-arrow-right"></i></a>
                @include('admin.procesos.clientes')
                <a data-target="#agregar-marca" data-toggle="modal" class="btn btn-info btn-flat" title="Agregar marca, obra o nombre comercial (Es opcional para crear un Servicio)" data-tooltip="tooltip"><i class="fa fa-plus"></i> Agregar Trámite <i class="glyphicon glyphicon-circle-arrow-right"></i></a>
                  @include('admin.procesos.marcas')
                <a class="btn btn-azul btn-flat" href="{{ route('procesos.create') }}" target="_blank" data-tooltip="tooltip" title="Agregar servicio"><i class="fa fa-plus"></i> Servicio Nuevo <i class="glyphicon glyphicon-copy"></i>
                </a>
                <a class="fancybox btn btn-default" rel="group" href="{{ asset('images/institucional/diagrama.png') }}" title="Ver diagrama de procesos" data-tooltip="tooltip"><i class="fa fa-sitemap"></i></a>
                <a class="various fancybox.iframe btn btn-default" rel="group" href="https://www.youtube.com/embed/-gWUHa5kIlw?autoplay=1" title="Video-tutorial" data-tooltip="tooltip"><i class="fab fa-youtube"></i></a>
              </div>

              <br>
              <br>
              <div class="btn-group">
                <a class="btn btn-warning btn-flat" href="{{ route('procesos.index') }}"><i class="glyphicon glyphicon-minus"></i> Pendientes</a>
                <a class="btn btn-success btn-flat" href="{{ route('procesos-pagados.index') }}"><i class="glyphicon glyphicon-ok"></i> Pagados</a>
                <a class="btn btn-danger btn-flat" href="{{ route('procesos-cancelados.index') }}"><i class="glyphicon glyphicon-remove"></i> Cancelados</a>
              </div>
              <br>
              <br>
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  {!! Form::open(array('url'=>'admin/cobranza-servicios','method'=>'GET','autocomplete'=>'on','role'=>'search')) !!}
                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}" title="Buscar Servicio...">
                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-default" data-tooltip="tooltip" title="Dar clic para iniciar búsqueda..."><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                        <a href="{{ route('cobranza-servicios.index') }}" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fas fa-eraser" aria-hidden="true"></i> Borrar</a>
                      </span>
                    </div>
                  </div>

                  {{Form::close()}}
                </div>
              </div>
            </div>

            <hr>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($servicios) > 0)
            {{$servicios->render()}}
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
                  <thead style="font-size: 15px">
                    <tr>
                      <th hidden>ID</th>
                      <th>Resp.</th>
                      <th>Servicio</th>
                      <th>Trámite</th>
                      <th>Cliente</th>
                      <th>Fecha</th>
                      <th>Factura</th>
                      <th>Recibo</th>
                      <th>Costo</th>
                      <th>Importe</th>
                      <th>Presentación</th>
                      <th>Estatus</th>
                      <th colspan ="1">&nbsp;</th>
                    </tr>
                  </thead> 
                  <tbody style="font-size: 15px" id="list" name="list">
                  @foreach($servicios as $key => $servicio)
                    <tr id="servicio{{ $servicio->id }}">
                      <td hidden>{{ $servicio->id }}</td>
                      <td style="width:5%;" valign="middle" align="center" title="{{ $servicio->nombre }} {{ $servicio->apellido }}" data-target="#modal-detalles-{{ $servicio->id }}" data-toggle="modal" data-tooltip="tooltip">{{ $servicio->iniciales }}</td>
                      <td style="width:5%;" valign="middle" align="left" data-target="#modal-detalles-{{ $servicio->id }}" title="{{ $servicio->clave }} - {{ $servicio->servicio }}" data-toggle="modal" data-tooltip="tooltip">{{ $servicio->clave }}</td>
                      <td style="width:15%;" valign="left" data-target="#modal-detalles-{{ $servicio->id }}" title="Detalles de {{ $servicio->clave }} - {{ $servicio->tramite }}" data-toggle="modal">{{ $servicio->tramite }} {{ $servicio->marca }} {{ $servicio->clase }}</td>
                      <td style="width:15%;" valign="middle" title="" data-target="#modal-detalles-{{ $servicio->id }}" data-toggle="modal" data-tooltip="tooltip">{{ $servicio->nombre_comercial }}</td>
                      <td style="width:8%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($servicio->created_at)->diffForHumans() }}" data-target="#modal-detalles-{{ $servicio->id }}" data-toggle="modal" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->created_at)->format('d-m-Y') }}</td>
                      <td style="width:8%;" align="center" valign="middle" title="Abrir factura" data-toggle="modal" data-tooltip="tooltip"><a target="_blank" href="{{ route('facturas.edit', $servicio->id_fact) }}">{{ $servicio->folio_factura }}</a></td>
                      <td style="width:8%;" align="center" valign="middle" title="Abrir recibo" data-tooltip="tooltip"><a target="_blank" href="{{ route('facturas.edit', $servicio->id_fact) }}">{{ $servicio->folio_recibo }}</a></td>
                      <td style="width:8%;" valign="middle" align="right" title="Detalles de {{ $servicio->tramite }} {{ $servicio->clave }}" data-target="#modal-detalles-{{ $servicio->id }}" data-toggle="modal">{{ number_format($servicio->costo_servicio,2) }}</td>
                      <td style="width:8%;" valign="middle" align="right" title="Detalles de {{ $servicio->tramite }} {{ $servicio->clave }}" data-target="#modal-detalles-{{ $servicio->id }}" data-toggle="modal">{{ number_format($servicio->costo,2) }}</td>
                      @if($servicio->presentacion_fecha == null)
                        <td align="center" style="width:8%;">
                          <label class="label label-warning">Pendiente</label>
                        </td>
                      @else
                        <td style="width:8%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($servicio->presentacion_fecha)->diffForHumans() }}" data-target="#modal-detalles-{{ $servicio->id }}" data-toggle="modal" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->presentacion_fecha)->format('d-m-Y') }}</td>
                      @endif
                      <td style="width:5%;" align="center" valign="middle" title="Facturado: $ {{ number_format($servicio->facturado,2) }} | Cobrado: $ {{ number_format($servicio->cobrado,2) }} | Saldo: $ {{ number_format($servicio->saldo,2) }}" data-target="#modal-detalles-{{ $servicio->id }}" data-toggle="modal" data-tooltip="tooltip">
                        @if($servicio->estatus_cobranza != 'Cancelado' && $servicio->saldo > '0')
                          <label class="label label-warning">Pendiente</label>
                        @elseif($servicio->estatus_cobranza != 'Cancelado' && $servicio->saldo == '0')
                          <label class="label label-success">Pagado</label>
                        @elseif($servicio->estatus_cobranza == 'Cancelado')
                          <label class="label label-danger">{{ $servicio->estatus_cobranza }}</label>
                        @endif
                      </td>
                      <td style="width:14%;" align="center">
                        <a
                          class="btn btn-info btn-xs btn-detalle btn-flat" 
                          title="Ver Facturas y Recibos asociados." 
                          data-tooltip="tooltip" 
                          data-toggle="modal" 
                          data-target="#modal-detalles-facturas" 
                          data-id="{{ $servicio->id }}"
                          data-path="{{ route('procesos.detalles') }}"
                          data-token="{{ csrf_token() }}">
                          <i class="glyphicon glyphicon-list-alt"></i>
                        </a>
                        <a class="btn btn-xs btn-success btn-flat" data-tooltip="tooltip" title="Menú de Facturas, Recibos o Cobros" data-toggle="modal" data-target="#menu"><i class="far fa-money-bill-alt"></i></a>
                        
                        @include('admin.ingresos.servicios.menu')
                      </td>
                    </tr>
                    @include('admin.procesos.detalles')
                    @include('admin.ingresos.servicios.factura-agregar')
                    @include('admin.ingresos.servicios.cobranza-agregar')
                    
                  @endforeach
                  </tbody>
                </table>
              </div>
              {{$servicios->render()}}
            @else
              <h4>No se encontraron registros.</h4>
            @endif
            </div>
            @include('admin.ingresos.servicios.detalles-facturas')
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
  <script src="{{ asset('js/lightbox.js') }}"></script>
  <!-- Light Gallery Plugin Js -->
  <script src="{{ asset('admin/emporio/plugins/light-gallery/js/lightgallery-all.js') }}"></script>

  <!-- Custom Js -->
  <script src="{{ asset('admin/emporio/js/pages/medias/image-gallery.js') }}"></script>
  <!-- bootstrap datepicker -->
  <script src="{{ asset('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
  <script src="{{ asset('admin/plugins/datepicker/locales/bootstrap-datepicker.es.js') }}"></script>
  </script>-->

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
                          '<i class="fas fa-spinner fa-spin"></i> Cargando datos' +
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
                fila += '<td style="width:25%;" align="middle">' + data[i].folio_factura + '</td>';
                fila += '<td style="width:25%;" align="middle">' + data[i].folio_recibo + '</td>';
                fila += '<td style="width:25%;" align="middle">' + data[i].created_at_formated + '</td>';
                fila += '<td style="width:20%;" align="right">' + parseFloat(data[i].monto).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString() + '</td>';
                fila += '</tr>';

                table.append(fila);  
                console.log(fila);
              }
            }, 
            'json'
          );
        });

        /*$(".btn-agregar-factura").on('click', function(e)
        {
          $(".modal-menu").toggle('modal');
          $(".modal-agregar-factura").show('modal');
        });*/
      });
  </script>
  

  <script>
    $('#liServicios').addClass("treeview active");
    $('#subCobranzaServicios').addClass("active");
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