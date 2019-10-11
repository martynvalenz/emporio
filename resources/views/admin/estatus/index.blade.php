@extends('admin.layouts.app')
@section('title')
<title>Emporio Legal: Estatus</title>
@endsection
@section('styles')
    
@endsection
@section('main-content')
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.emporio') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Estatus</li>
    </ol>
    <h1 class="page-header">Estatus de Trámites</h1>
    <a class="btn btn-primary" onclick="CreateEstatus()" data-toggle="modal" data-target="#modal-estatus"><i class="fas fa-plus"></i> Agregar Registro</a>
    @include('admin.estatus.registro')
    @include('admin.clientes.contactos.contactos')
    <hr>
    <div class="row">
        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Estado Vigencia</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fab fa-font-awesome-flag"></i></span>
                    <select name="vigencia" id="vigencia" class="form-control">
                        <option value="todos">TODOS</option>
                        <option value="1" selected>Vigentes</option>
                        <option value="0">Cancelados</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Estatus Trámite</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fab fa-font-awesome-flag"></i></span>
                    <select name="filtro_estatus" id="filtro_estatus" class="form-control">
                        <option value="todos">TODOS</option>
                        @foreach($listado_estatus as $estatus)
                            <option value="{{ $estatus->id }}">{{ $estatus->estatus }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-xs-12">
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
    <input type="hidden" name="url_actualizar" id="url_actualizar" value="{{ $url_actualizar }}">
    <input type="hidden" id="listado-parametro" value="signos-distintivos">

    <hr>
    <ul class="nav nav-pills">
        <li class="nav-items">
            <a href="#signos-distintivos" data-toggle="tab" onclick="SignosDistintivos()" class="nav-link active" title="Signos Distintivos" data-tooltip="tooltip">
                <span class="d-sm-none"><i class="far fa-registered"></i> SD</span>
                <span class="d-sm-block d-none"><i class="far fa-registered"></i> SD</span>
            </a>
        </li>

        <li class="nav-items">
            <a href="#declaracion-uso" data-toggle="tab" onclick="DeclaracionUso()" class="nav-link" title="Declaración de Uso" data-tooltip="tooltip">
                <span class="d-sm-none"><i class="fas fa-exclamation-triangle" style="color: orange"></i> DUSO</span>
                <span class="d-sm-block d-none"><i class="fas fa-exclamation-triangle" style="color: orange"></i> DUSO</span>
            </a>
        </li>

        <li class="nav-items">
            <a href="#busqueda-tecnica" data-toggle="tab" onclick="BusquedaTecnica()" class="nav-link" title="Búsqueda Técnica" data-tooltip="tooltip">
                <span class="d-sm-none"><i class="fas fa-search"></i> BT</span>
                <span class="d-sm-block d-none"><i class="fas fa-search"></i> BT</span>
            </a>
        </li>

        <li class="nav-items">
            <a href="#invenciones" data-toggle="tab" onclick="Invenciones()" class="nav-link" title="Invenciones" data-tooltip="tooltip">
                <span class="d-sm-none"><i class="fab fa-accusoft"></i> INV</span>
                <span class="d-sm-block d-none"><i class="fab fa-accusoft"></i> INV</span>
            </a>
        </li>

        <li class="nav-items">
            <a href="#dictamen-previo" data-toggle="tab" onclick="DictamenPrevio()" class="nav-link" title="Dictamen Previo" data-tooltip="tooltip">
                <span class="d-sm-none"><i class="fas fa-file-alt"></i> DP</span>
                <span class="d-sm-block d-none"><i class="fas fa-file-alt"></i> DP</span>
            </a>
        </li>
        <li class="nav-items">
            <a href="#codigos-barra" data-toggle="tab" onclick="CodigosBarra()" class="nav-link" title="Códigos de Barra" data-tooltip="tooltip">
                <span class="d-sm-none"><i class="fas fa-barcode"></i> CBAR</span>
                <span class="d-sm-block d-none"><i class="fas fa-barcode"></i> CBAR</span>
            </a>
        </li>
        <li class="nav-items">
            <a href="#registro-obras" data-toggle="tab" onclick="RegistroObras()" class="nav-link" title="Registro de Obras" data-tooltip="tooltip">
                <span class="d-sm-none"><i class="fas fa-mosque"></i> RO</span>
                <span class="d-sm-block d-none"><i class="fas fa-mosque"></i> RO</span>
            </a>
        </li>
        <li class="nav-items">
            <a href="#reserva-derechos" data-toggle="tab" onclick="ReservaDerechos()" class="nav-link" title="Reserva de Derechos" data-tooltip="tooltip">
                <span class="d-sm-none"><i class="fas fa-balance-scale"></i> RD</span>
                <span class="d-sm-block d-none"><i class="fas fa-balance-scale"></i> RD</span>
            </a>
        </li>
        <li class="nav-items">
            <a href="#juicios" data-toggle="tab" onclick="Juicios()" class="nav-link" title="Juicios" data-tooltip="tooltip">
                <span class="d-sm-none"><i class="fas fa-gavel"></i> JU</span>
                <span class="d-sm-block d-none"><i class="fas fa-gavel"></i> JU</span>
            </a>
        </li>
        <li class="nav-items">
            <a href="#franquicias" data-toggle="tab" onclick="Franquicias()" class="nav-link" title="Franquicias" data-tooltip="tooltip">
                <span class="d-sm-none"><i class="fas fa-store-alt"></i> FRAN</span>
                <span class="d-sm-block d-none"><i class="fas fa-store-alt"></i> FRAN</span>
            </a>
        </li>
    </ul>

    <div class="tab-content">
        @include('admin.estatus.signos-distintivos')
        @include('admin.estatus.declaracion-uso')
        @include('admin.estatus.busqueda-tecnica')
        @include('admin.estatus.invenciones')
        @include('admin.estatus.dictamen-previo')
        @include('admin.estatus.codigos-barra')
        @include('admin.estatus.registro-obras')
        @include('admin.estatus.reserva-derechos')
        @include('admin.estatus.juicios')
        @include('admin.estatus.franquicias')
    </div>
    @include('admin.estatus.comentarios')
@endsection
@section('scripts')
    <script src="{{ asset('archivos/estatus.js') }}"></script>
    {{-- <script src="{{ asset('archivos/clientes.js') }}"></script> --}}
    <script src="{{ asset('admin/js/json-plugin.js') }}"></script>
    <script>
        $('#Estatus').addClass("active");
    </script>
    <script>
        //Date range picker
        $('#reservation').daterangepicker();

        $('#reservation').on('change', function()
        {
            FechaRango = document.getElementById('reservation').value.split('  -  ');
            fecha_inicio = FechaRango[0];
            fecha_fin = FechaRango[1];
            //console.log(fecha_inicio);
            //console.log(fecha_fin);
        });

        //Date picker
        $('.datepicker').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd'
          //format: 'dd-mm-yyyy'
        });
    </script>
    <script>
    $(function() {
      $('input[name="daterange"]').daterangepicker({
        opens: 'left'
      }, function(start, end, label) {
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
      });
    });
    </script>
    <script>
        //Logo
        jQuery("#logo_url").on("change", function() 
        {
            formdata = new FormData();
            var id = $('#id_servicio_logo_modal').val();
            var route = '/admin/bitacoras/logo-insertar/' + id;
            var file = this.files[0];
            if (formdata) 
            {
                formdata.append("logo_url", file);
                jQuery.ajax(
                {
                    url: route,
                    type: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success:function(data)
                    {
                        $("#logo_url_error").fadeOut();
                        var logo_url = '{{ URL::asset('/images/logos/') }}' + '/' + data.logo_url;
                        $('#logo_url_bitacora').attr('src', logo_url);
                        $(".tooltip").tooltip("hide");
                        toastr.info('Imagen cargada con éxito');
                    },
                    error: function(data)
                    {
                        console.clear();
                        if (data.responseJSON.errors.logo_url)
                        {
                            $("#logo_url_error").html(data.responseJSON.errors.logo_url);
                            $("#logo_url_error").fadeIn();
                        }
                        else
                        {
                            $("#logo_url_error").fadeOut();
                        }
                    }
                });
            }                       
        });

    </script>
@endsection









