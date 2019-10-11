@extends('admin.layouts.app')
@section('title')
<title>Emporio Legal: Proceso de Servicio</title>
@endsection
@section('styles')
    
@endsection
@section('main-content')
<div id="content" class="content">
    <div class="page-header-fixed" id="header"></div>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.emporio') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/admin/check-list/todos') }}">Servicios</a></li>
        <li class="breadcrumb-item active">Proceso</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Proceso de Servicio: {{ $servicio->id }}</h1>
    <input type="hidden" id="tipo" value="{{ $tipo }}">
    <input type="hidden" id="url_options" value="{{ $url_options }}">
    <input type="hidden" id="url_cargar_requisitos" value="{{ $url_cargar_requisitos }}">
    <input type="hidden" id="url_requisitos" value="{{ $url_requisitos }}">
    <input type="hidden" id="url_store" value="{{ $url_store }}">
    <input type="hidden" id="url_update" value="{{ $url_update }}">
    <input type="hidden" id="url_insertar" value="{{ $url_insertar }}">
    <input type="hidden" id="url_eliminar" value="{{ $url_eliminar }}">
    <input type="hidden" id="url_subir" value="{{ $url_subir }}">
    <input type="hidden" id="url_bajar" value="{{ $url_bajar }}">
    <input type="hidden" id="url_liberar_comisiones" value="{{ $url_liberar_comisiones }}">
    <!-- end page-header -->
    <!-- begin row -->
    <hr>

    <form>
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-title">Procesos</div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="requisito" class="control-label">Proceso <b style="color:red">*</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-list"></i></span>
                                <input type="text" class="form-control" name="requisito" id="requisito">
                            </div>
                            <span class="help-block">
                                <strong id="requisito_error" style="color:red"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="categoria" class="control-label">Área <b style="color:red">*</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
                                <select class="form-control" name="categoria" id="categoria">
                                    <option value="">-Sin selección-</option>
                                    <option value="Jurídico">Jurídico</option>
                                    <option value="Administración">Administración</option>
                                    <option value="Gestión">Gestión</option>
                                    <option value="Dirección">Dirección</option>
                                    <option value="Operaciones">Operaciones</option>
                                </select>
                            </div>
                            <span class="help-block">
                                <strong id="categoria_error" style="color:red"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label for="categoria" class="control-label">Estatus <b style="color:red">*</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-tag"></i></span>
                                <select class="form-control" name="estatus" id="estatus">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                            <span class="help-block">
                                <strong id="categoria_error" style="color:red"></strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <a class="btn btn-primary" id="btn-save-proceso"><i class="fas fa-save"></i> Guardar</a>
                        <a class="btn btn-grey" id="btn-cancelar-proceso"><i class="fas fa-times"></i> Cancelar</a>
                        <input type="hidden" id="id_requisito">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 centered">
                        <span>
                            <label style="color: #49ADAD; padding-right: 1.5em;">Jurídico</label>
                            <label style="color: #F49C31; padding-right: 1.5em;">Administración</label>
                            <label style="color: #EE5755; padding-right: 1.5em;">Gestión</label>
                            <label style="color: #2C353C; padding-right: 1.5em;">Dirección</label>
                            <label style="color: #2d5986; padding-right: 1.5em;">Operaciones</label>
                            <label style="color: #bfbfbf; padding-right: 1.5em;">Inactivo</label>
                        </span>
                    </div>
                </div>
                <hr>
                <div id="requisitos-options"></div>
            </div>
        </div>

        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-title">Pasos del servicio</div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div id="requisitos-listado"></div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <a href="{{ url('/admin/check-list/todos') }}" class="btn btn-warning btn-lg" id="btn-save"><i class="fas fa-arrow-left"></i> Ir a Catálogo</a>
                <input type="hidden" id="id_catalogo_servicio" value="{{ $servicio->id }}">
                <input type="hidden" id="avance_total" value="{{ $servicio->avance_total }}">
            </div>
        </div>
    
    </form>
</div>
@endsection
@section('scripts')
<script src="{{ asset('archivos/proceso-servicios.js') }}"></script>
<script>
    $(document).ready(function() {
        App.init();
        FormSliderSwitcher.init();
    });
</script>
<script>
    $('#liServicios').addClass("treeview active");
    $('#subProcesos').addClass("active");
</script>
@endsection