@extends('admin.layouts.app')
@section('title')
<title>Emporio Legal | Usuarios</title>
@endsection
@section('styles')

@endsection
@section('main-content')
<div class="content">
    <div class="page-header-fixed" id="header"></div>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.emporio') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Usuarios</li>
    </ol>

    <h1 class="page-header">Usuarios del Sistema</h1>
    <div >
        <a onclick="CreateUser()" data-toggle="modal" data-target="#modal-user" class="btn btn-primary" title="Agregar usuario" data-tooltip="tooltip"><i class="fas fa-user-plus"></i> Agregar</a>
        @include('admin.users.user')
        <a data-target="#puestos" data-toggle="modal" class="btn btn-success" title="Agregar puesto" data-tooltip="tooltip"><i class="fa fa-plus" onclick="AgregarPuesto()"></i> Puesto</a>
        @include('admin.users.puestos')
    </div>
    <hr>

    <div class="row">
        <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12" hidden>
            <div class="form-group">
                <label>Buscar</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-briefcase"></i></span>
                    <input type="text" name="buscar" id="buscar" placeholder="Buscar..." title="Buscar usuario..." class="form-control">
                    <span class="input-group-btn">
                    <a id="btn-buscar" class="btn btn-default" data-tooltip="tooltip" title="Iniciar búsqueda"><i class="fas fa-search" aria-hidden="true"></i> Buscar</a>
                    <a id="btn-borrar" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fas fa-eraser" aria-hidden="true"></i> Borrar</a>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-5 col-sm-6 col-xs-6">
          <div class="form-group">
            <label>Estatus</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fas fa-flag"></i></span>
              <select name="estatus_select" id="estatus_select" class="form-control">
                <option value="todos">Todos</option>
                <option value="1" selected>Activos</option>
                <option value="0">Inactivos</option>
              </select>
              <div class="input-group-btn">
                <a onclick="Listar()" class="btn btn-grey" title="Actualizar listado" data-tooltip="tooltip"><i class="fas fa-sync"></i></a>
              </div>
            </div>
          </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="listado"></div>
        </div>
    </div>
    @include('admin.users.contra')
</div>
@endsection


@section('scripts')
<!-- InputMask -->
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
<script src="{{ asset('archivos/users.js') }}"></script>
<script>
    $('#liUsuarios').addClass("treeview active");
    $('#liAdmin').addClass("active");
</script>
<script>
    
    //Data Mask
    $("[data-mask]").inputmask();
</script>
<script>
    $(function() {
        $('#example1').stickyTableHeaders();
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