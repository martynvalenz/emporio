@extends('admin.layouts.app')
@section('title')
<title>Emporio Legal | Honorarios</title>
@endsection
@section('styles')
@endsection
@section('main-content')
<div class="content">
    <div class="page-header-fixed" id="header"></div>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.emporio') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Honorarios</li>
    </ol>
    <h1 class="page-header">Pago de servicios en el IMPI/INDAUTOR</h1>
    <hr>
    <ul class="nav nav-pills">
        <li class="nav-items">
            <a href="#pagar-honorarios" data-toggle="tab" onclick="Listar()" class="nav-link active">
                <span class="d-sm-none"><i class="fas fa-file-alt"></i> Servicios a pagar</span>
                <span class="d-sm-block d-none"><i class="fas fa-file-alt"></i> Servicios a pagar</span>
            </a>
        </li>
          
        <li class="nav-items">
            <a href="#seleccionar-honorarios" data-toggle="tab" onclick="Seleccionar()" class="nav-link">
                <span class="d-sm-none"><i class="fas fa-file-alt"></i> Seleccionar servicios</span>
                <span class="d-sm-block d-none"><i class="fas fa-file-alt"></i> Seleccionar servicios</span>
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="pagar-honorarios">
            <a class="btn btn-success" data-toggle="modal" data-target="#modal-pagar" onclick="Pagar()"><i class="fas fa-money-bill-alt"></i> Pagar Honorarios</a>
            @include('admin.honorarios.pagar')
            <a class="btn btn-grey" onclick="Listar()"><i class="fas fa-sync"></i></a>
            <hr>
            <div id="listado"></div>
        </div>

        <div class="tab-pane fade" id="seleccionar-honorarios">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Buscar</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-briefcase"></i></span>
                            <input type="text" name="buscar" id="buscar" placeholder="Buscar por cliente, marca o # de servicio..." title="Buscar por Servicio, cliente, responsable, trámite o marca" class="form-control">
                            <span class="input-group-btn">
                            <div class="btn-group">
                                <a id="btn-buscar" class="btn btn-default" data-tooltip="tooltip" title="Iniciar búsqueda"><i class="fas fa-search" aria-hidden="true"></i></a>
                                <a id="btn-borrar" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fas fa-eraser" aria-hidden="true"></i></a>
                            </div>
                            <a class="btn btn-grey" onclick="Seleccionar()" title="Refrescar listado" data-tooltip="tooltip"><i class="fas fa-sync"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div id="listado-pendientes"></div>
        </div>
    </div>
    <br>
</div>
@endsection
@section('scripts')
<script src="{{ asset('archivos/honorarios.js') }}"></script>
<script>
    $('#liServicios').addClass("treeview active");
    $('#subReporteHonorarios').addClass("active");
</script>
<script>
    $(function() {
        $('#example1').stickyTableHeaders();
    });
</script>
@endsection