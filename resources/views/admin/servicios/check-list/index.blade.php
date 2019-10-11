@extends('admin.layouts.app')
@section('title')
<title>Emporio Legal: Servicios</title>
@endsection
@section('styles')
    
@endsection
@section('main-content')
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.emporio') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Servicios</li>
    </ol>
    <h1 class="page-header">Servicios</h1>
    <hr>
    <div class="row">
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Estatus Cobranza</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fab fa-font-awesome-flag"></i></span>
                    <select name="servicios_select" id="servicios_select" class="form-control">
                        <option value="todos" selected>Todos</option>
                        <option value="Pagado">Pagados</option>
                        <option value="Pendiente">Pendientes</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Estatus Trámite</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fab fa-font-awesome-flag"></i></span>
                    <select name="servicios_tramite" id="servicios_tramite" class="form-control">
                        <option value="todos" selected>Todos</option>
                        <option value="Terminado">Terminados</option>
                        <option value="Pendiente">Pendientes</option>
                        <option value="No Registro">No Registro</option>
                        <option value="Cancelado">Cancelados</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Pendientes en Bitácora</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fab fa-font-awesome-flag"></i></span>
                    <select name="pendiente_proceso" id="pendiente_proceso" class="form-control">
                        <option value="todos">Todos</option>
                        <option value="Jurídico">Jurídicos</option>
                        <option value="Gestión">Gestión</option>
                        <option value="Operaciones">Operaciones</option>
                    </select>
                    <input type="hidden" id="variable" value={{ $variable }}>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label>Buscar</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-briefcase"></i></span>
                    <input type="text" name="buscar" id="buscar" placeholder="Buscar..." title="Buscar por Servicio, cliente, responsable, trámite o marca" class="form-control">
                    <span class="input-group-btn">
                    <a id="btn-buscar" class="btn btn-default" data-tooltip="tooltip" title="Iniciar búsqueda"><i class="fas fa-search" aria-hidden="true"></i> Buscar</a>
                    <a id="btn-borrar" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fas fa-eraser" aria-hidden="true"></i> Borrar</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <input type="hidden" name="url_listar" id="url_listar" value="{{ $url_listar }}">
    <input type="hidden" name="url_buscar" id="url_buscar" value="{{ $url_buscar }}">

    <hr>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="listado"></div>
        </div>
    </div>
    @include('admin.servicios.check-list.detalles')
</div>
@endsection
@section('scripts')
    <script src="{{ asset('archivos/check-list.js') }}"></script>
    <script>
        $('#liServicios').addClass("active");
        $('#subProcesos').addClass("active");
    </script>
    <script>

        //Date picker
        $('.datepicker').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd'
          //format: 'dd-mm-yyyy'
        });
    </script>
@endsection









