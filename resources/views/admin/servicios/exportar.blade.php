@extends('admin.layouts.app')
@section('title')
<title>Emporio Legal: Catálogo de Servicios</title>
@endsection
@section('styles')
    <link href="{{ asset('admin/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
@endsection
@section('main-content')
<div id="content" class="content">
    <div class="page-header-fixed" id="header"></div>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.emporio') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Catálogo</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Catálogo de Servicios</h1>
    <!-- end page-header -->
    <!-- begin row -->
    <hr>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @if(count($catalogos) > 0)
            <table id="data-table-buttons" class="table display table-responsive no-wrap table-bordered table-striped table-hover cell-border" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th hidden>ID</th>
                        <th>Clave</th>
                        <th>Servicio</th>
                        <th>Categoría</th>
                        <th>Bitácora</th>
                        <th>Moneda</th>
                        <th>Costo</th>
                        <th>Precio</th>
                        <th>Estatus?</th>
                        <th hidden>Venta</th>
                        <th hidden>Monto/Porcentaje</th>
                        <th hidden>Operativa</th>
                        <th hidden>Monto/Porcentaje</th>
                        <th hidden>Gestion</th>
                        <th hidden>Monto/Porcentaje</th>
                    </tr>
                    {{ csrf_field() }}
                </thead>
                <tbody id="list" name="list">
                    @foreach($catalogos as $key => $catalogo)
                    <tr id="catalogo-{{ $catalogo->id }}">
                        <td hidden>{{ $catalogo->id }}</td>
                        <td style="width:10%;" valign="left">{{ $catalogo->clave }}</td>
                        <td style="width:25%;" valign="middle" title="{{ $catalogo->comentarios }}" data-tooltip="tooltip">{{ $catalogo->servicio }}</td>
                        <td style="width:15%;" valign="middle">@if($catalogo->id_categoria_servicios == null)@else{{ $catalogo->categoria }}@endif
                        </td>
                        <td style="width:15%;" valign="middle">@if($catalogo->id_categoria_bitacora == null)@else{{ $catalogo->bitacora }}@endif
                        </td>
                        <td style="width:5%;" valign="middle" align="center">{{ $catalogo->moneda }}</td>
                        <td style="width:12%;" align="right" valign="middle">
                            $ {{ number_format($catalogo->costo_servicio,2) }}
                        </td>
                        <td style="width:12%;" align="right" valign="middle">
                            @if($catalogo->concepto == 'Neto')
                                $ {{ number_format($catalogo->costo,2) }}
                            @elseif($catalogo->concepto == 'Porcentaje')
                                % {{ number_format($catalogo->costo,2) }}
                            @elseif($catalogo->concepto == 'por Proyecto')
                                <label class="label label-purple">{{ $catalogo->concepto }}</label>
                            @endif
                        </td>
                        <td style="width:6%;" align="center" valign="middle">
                            @if($catalogo->estatus == 1)
                                <label class="label label-success">Activo</label>
                            @elseif($catalogo->estatus == 0)
                                <label class="label label-danger">Inactivo</label>
                            @endif
                        </td>
                        <td hidden>{{ $catalogo->comision_venta }}</td>
                        <td hidden>
                            @if($catalogo->comision_venta == 'Porcentaje' || $catalogo->comision_venta == 'Porcentaje Utilidad')
                                % {{ $catalogo->porcentaje_venta }}
                            @elseif($catalogo->comision_operativa == 'Monto Fijo')
                                $ {{ $catalogo->comision_venta_monto }}
                            @else

                            @endif
                        </td>
                        <td hidden>{{ $catalogo->comision_operativa }}</td>
                        <td hidden>
                            @if($catalogo->comision_operativa == 'Porcentaje' || $catalogo->comision_operativa == 'Porcentaje Utilidad')
                                % {{ $catalogo->porcentaje_operativa }}
                            @elseif($catalogo->comision_operativa == 'Monto Fijo')
                                $ {{ $catalogo->comision_operativa_monto }}
                            @else

                            @endif
                        </td>
                        <td hidden>{{ $catalogo->comision_gestion }}</td>
                        <td hidden>
                            @if($catalogo->comision_gestion == 'Porcentaje' || $catalogo->comision_gestion == 'Porcentaje Utilidad')
                                % {{ $catalogo->porcentaje_gestion }}
                            @elseif($catalogo->comision_operativa == 'Monto Fijo')
                                $ {{ $catalogo->comision_gestion_monto }}
                            @else

                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <h4>No hay registros encontrados con el criterio de búsqueda</h4>
            @endif
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('admin/plugins/DataTables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/extensions/Buttons/js/jszip.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/js/demo/table-manage-buttons.demo.min.js') }}"></script>
    <script>
        $('#liServicios').addClass("treeview active");
        $('#liCatalogo').addClass("active");
    </script>
    <script>
        $(document).ready(function() {
            //App.init();
            TableManageButtons.init();
        });
    </script>
@endsection