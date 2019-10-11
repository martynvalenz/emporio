@extends('admin.app')
@section('title')
<title>Emporio Legal | Egresos</title>
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
            Exportar Egresos
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="{{ route('estados-cuenta.index') }}">Egresos</a></li>
            <li class="active">Exportar Egresos</li>
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
                        <div class="table-responsive">
                            <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
                                <thead style="font-size: 15px; color:white; background-color:#218CBF">
                                    <tr>
                                        <th hidden>ID</th>
                                        <th>Categoría</th>
                                        <th>Proveedor</th>
                                        <th>Cuenta</th>
                                        <th>Factura?</th>
                                        <th>Pago</th>
                                        <th>Total</th>
                                        <th>Usuario</th>
                                        <th>Fecha</th>
                                        <th>Estatus?</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 15px" id="list" name="list">
                                    @foreach($egresos as $key => $egreso)
                                    <tr id="egreso-{{ $egreso->id }}">
                                        <td hidden>{{ $egreso->id }}</td>
                                        <td style="width:15%;" valign="middle" align="left" title="{{ $egreso->concepto }}" data-tooltip="tooltip" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">
                                            @if($egreso->tipo == 'Despacho')
                                                <label class="label label-info">Despacho</label> {{ $egreso->categoria }}
                                            @elseif($egreso->tipo == 'Hogar')
                                                <label class="label label-success">Hogar</label> {{ $egreso->categoria }}
                                            @elseif($egreso->tipo == 'Personal')
                                                <label class="label label-warning">Personal</label> {{ $egreso->categoria }}
                                            @elseif($egreso->tipo == 'Comision')
                                                <label class="label label-default">Comisión</label> {{ $egreso->categoria }}
                                            @endif
                                        </td>
                                        @if($egreso->tipo == 'Comision')
                                            <td style="width:17%;" valign="middle" align="left" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal" data-tooltip="tooltip" title="">{{ $egreso->nombre }} {{ $egreso->apellido }}</td>
                                        @else
                                            <td style="width:17%;" valign="middle" align="left" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal" data-tooltip="tooltip" title="{{ $egreso->razon_social }} | {{ $egreso->rfc }}">{{ $egreso->nombre_comercial }}</td>
                                        @endif
                                        <td style="width:10%;" align="left" valign="middle" title="{{ $egreso->banco }}" data-tooltip="tooltip" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">{{ $egreso->alias }}</td>
                                        <td style="width:5%;" valign="middle" align="center" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">
                                            @if($egreso->con_iva == 1)
                                                <label for="con_iva" class="label label-success">SI</label>
                                            @else
                                                <label for="con_iva" class="label label-warning">NO</label>
                                            @endif
                                        </td>
                                        <td style="width:10%;" align="center" valign="middle"  data-tooltip="tooltip" title="{{ $egreso->codigo }} - {{ $egreso->forma_pago }}" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">{{ $egreso->forma_pago }}</td>
                                        <td style="width:10%;" align="right" valign="middle" data-tooltip="tooltip" title="Subtotal: {{ number_format($egreso->subtotal,2) }} | IVA: {{ number_format($egreso->iva,2) }}" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">{{ number_format($egreso->total,2) }}</td>
                                        <td style="width:5%;" align="center" valign="middle" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal" data-tooltip="tooltip" title="{{ $egreso->nombre }} {{ $egreso->apellido }}">{{ $egreso->iniciales }}</td>
                                        <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($egreso->fecha)->diffForHumans() }}" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal" data-tooltip="tooltip">{{ Carbon\Carbon::parse($egreso->fecha)->format('d/m/Y') }}</td>
                                        <td style="width:8%;" align="center" valign="middle" title="Detalles" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">
                                            @if($egreso->estatus == 'Pagado')
                                            <label class="label label-success">Pagado</label>
                                            @elseif($egreso->estatus == 'Cancelado')
                                            <label class="label label-danger" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($egreso->cancelado_at)->diffForHumans() }} | {{ Carbon\Carbon::parse($egreso->cancelado_at)->format('d/m/Y') }}">Cancelado</label>
                                            @elseif($egreso->estatus == 'Pendiente')
                                            <label class="label label-warning">Pendiente</label>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
    $('#liEgresos').addClass("treeview active");
    $('#subEgresos').addClass("active");
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