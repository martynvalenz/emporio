@extends('admin.app')
@section('title')
<title>Emporio Legal | Catálogo de Servicios</title>
@endsection
@section('styles')
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
<link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
<link rel="stylesheet" href="{{ asset('admin/dataTables/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/dataTables/css/fixedHeader.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/dataTables/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/dataTables/css/responsive.dataTables.min.css') }}">
<style type="text/css">
    .minusculas{
    text-transform:lowercase;
    } 
    .mayusculas{
    text-transform:uppercase;
    }
    .modal { 
    overflow: auto !important; 
    }
</style>
@endsection
@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Exportar Servicios
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="{{ route('servicios.index') }}">Catálogo de Servicios</a></li>
            <li class="active">Exportar Servicios</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div id="crud" class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if(count($comisiones) > 0)
                        <table id="example1" class="table display responsive no-wrap table-bordered table-striped table-hover cell-border" cellspacing="0" width="100%">
                            <thead style="font-size: 15px; color:white; background-color:#218CBF">
                                <tr>
                                    <th hidden>Id</th>
                                    <th style="width:10%;">Clave</th>
                                    <th style="width:15%;">Servicio</th>
                                    <th hidden>Comentarios</th>
                                    <th hidden>Categoría</th>
                                    <th hidden>Bitácora</th>
                                    <th hidden>Bitácora Estatus</th>
                                    <th style="width:5%;">Moneda</th>
                                    <th hidden>Concepto</th>
                                    <th style="width:8%;">Precio</th>
                                    <th style="width:8%;">Costo Emporio</th>
                                    <th hidden>Comision Venta</th>
                                    <th>Venta</th>
                                    <th hidden>Comisión Gestion</th>
                                    <th>Gestion</th>
                                    <th hidden>Comision Operativa</th>
                                    <th>Operativa</th>
                                    <th>Estatus?</th>
                                    <th hidden>Creado</th>
                                    <th hidden>Último cambio</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 15px">
                                @foreach($comisiones as $key => $catalogo)
                                    <td hidden>{{ $catalogo->id }}</td>
                                    <td style="width:10%;" valign="left">{{ $catalogo->clave }}</td>
                                    <td style="width:25%;" valign="middle">{{ $catalogo->servicio }}</td>
                                    <td hidden>{{ $catalogo->comentarios }}</td>
                                    <td hidden>{{ $catalogo->categoria }}</td>
                                    <td hidden>{{ $catalogo->bitacora }}</td>
                                    <td hidden>{{ $catalogo->bit_estatus }}</td>
                                    <td style="width:5%;" valign="middle" align="center">{{ $catalogo->moneda }}</td>
                                    <td hidden>{{ $catalogo->concepto }}</td>
                                    <td style="width:8%;" align="right" valign="middle">
                                        @if($catalogo->concepto == 'por Proyecto')
                                            <label class="label label-default">{{ $catalogo->concepto }}</label>
                                        @else
                                            {{ number_format($catalogo->costo,2) }}
                                        @endif
                                    </td>
                                    <td style="width:8%;" align="right">{{  number_format($catalogo->costo_servicio,2) }}</td>
                                    <td hidden>{{ $catalogo->comision_venta }}</td>
                                    <td style="width:8%;" align="right" valign="middle">
                                       {{ number_format($catalogo->comision_venta_monto,2) }}
                                    </td>
                                    <td hidden>{{ $catalogo->comision_gestion }}</td>
                                    <td style="width:8%;" align="right" valign="middle">
                                        {{ number_format($catalogo->comision_gestion_monto,2) }}
                                    </td>
                                    <td hidden>{{ $catalogo->comision_operativa }}</td>
                                    <td style="width:8%;" align="right" valign="middle">
                                        {{ number_format($catalogo->comision_operativa_monto,2) }}
                                    </td>
                                    <td style="width:5%;" align="center" valign="middle">
                                        @if($catalogo->estatus == 1)
                                            <label class="label label-success">Activo</label>
                                        @elseif($catalogo->estatus == 0)
                                            <label class="label label-danger">Inactivo</label>
                                        @endif
                                    </td>
                                    <td hidden align="center" valign="middle">{{ Carbon\Carbon::parse($catalogo->created_at)->diffForHumans() }}</td>
                                    <td hidden align="center" valign="middle">{{ Carbon\Carbon::parse($catalogo->updated_at)->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
<!-- Datatables -->
<!-- Slimscroll -->
<script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('admin/js/toastr.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script>
<!-- Data Tables -->
<script src="{{ asset('admin/dataTables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/dataTables/js/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('admin/dataTables/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/dataTables/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/dataTables/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('admin/dataTables/js/jszip.min.js') }}"></script>
<script src="{{ asset('admin/dataTables/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin/dataTables/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin/dataTables/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin/dataTables/js/buttons.print.min.js') }}"></script>

<script>
    $('#liServicios').addClass("treeview active");
    $('#liCatalogo').addClass("active");
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

    $(document).ready(function() {
        var table = $('#example1').DataTable( {
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                { extend:'copy', attr: { id: 'allan' } }, 'csv', 'excel', 'pdf', 'print'
            ]
        } );
     
        new $.fn.dataTable.FixedHeader( table );
    } );
</script>
@endsection