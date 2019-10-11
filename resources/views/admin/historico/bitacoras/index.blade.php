@extends('admin.layouts.app')
@section('title')
<title>Emporio Legal: Bitácoras</title>
@endsection
@section('styles')
    <style>
        .bitacora_selected
        {
            color:white !important;
            background-color: #ff9900 !important;
        }
    </style>
@endsection
@section('main-content')
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.emporio') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Bitácoras</li>
    </ol>
    <h1 class="page-header">Bitácoras</h1>
    <hr>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="btn-group">
                <a data-target="#agregar-cliente" data-toggle="modal" class="btn btn-info" title="Agregar cliente nuevo" data-tooltip="tooltip"><i class="fa fa-user-plus"></i> Agregar Cliente <i class="glyphicon glyphicon-circle-arrow-right"></i></a>
                @include('admin.procesos.servicios.clientes')
                <a class="btn btn-primary" data-toggle="modal" data-target="#agregar-servicio" data-tooltip="tooltip" title="Agregar servicio" id="btn-agregar-servicio"><i class="fa fa-plus"></i> Servicio Nuevo <i class="glyphicon glyphicon-copy"></i>
                </a>
                @include('admin.procesos.servicios.servicio')
                <a class="fancybox btn btn-default" rel="group" href="{{ asset('images/institucional/diagrama.png') }}" title="Ver diagrama de procesos" data-tooltip="tooltip"><i class="fa fa-sitemap"></i></a>
                <a class="various fancybox.iframe btn btn-default" rel="group" href="https://www.youtube.com/embed/9xYpITZRCk0?autoplay=1" title="Video-tutorial" data-tooltip="tooltip"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
    <br>
    <div class="row" hidden>
        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
            <label>Búsqueda por Fechas</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                <input type="text" class="form-control pull-right centered" id="reservation" value="{{ $fecha_inicio }}  -  {{ $fecha_fin }}" autocomplete="off">
                <input type="hidden" name="fecha_inicio_reset" id="fecha_inicio_reset" value="{{ $fecha_inicio }}">
                <input type="hidden" name="fecha_fin_reset" id="fecha_fin_reset" value="{{ $fecha_fin }}">
            </div>
            <span class="help-block">
                <strong id="reservation_error" style="color:red"></strong>
            </span>
        </div>
    </div>
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
                        <option value="todos">Todos</option>
                        <option value="Terminado">Terminados</option>
                        <option value="Pendiente" selected>Pendientes</option>
                        <option value="No Registro">No Registro</option>
                        <option value="Cancelado">Cancelados</option>
                    </select>
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
    <input type="hidden" name="url_actualizar" id="url_actualizar" value="{{ $url_actualizar }}">
    <input type="hidden" id="listado-parametro" value="tramite-nuevo">

    <hr>
    <ul class="nav nav-pills">
        <li class="nav-items">
            <a href="#tramites-nuevos" data-toggle="tab" onclick="TramitesNuevos()" class="nav-link active">
                <span class="d-sm-none"><i class="fas fa-file-alt"></i> Tramites Nuevos</span>
                <span class="d-sm-block d-none"><i class="fas fa-file-alt"></i> Tramites Nuevos</span>
            </a>
        </li>
        <li class="nav-items">
            <a href="#estudios-factibilidad" data-toggle="tab" onclick="EstudiosFactibilidad()" class="nav-link">
                <span class="d-sm-none"><i class="fas fa-search"></i> Estudios de Factibilidad</span>
                <span class="d-sm-block d-none"><i class="fas fa-search"></i> Estudios de Factibilidad</span>
            </a>
        </li>
        <li class="nav-items">
            <a href="#negativas" data-toggle="tab" onclick="Negativas()" class="nav-link">
                <span class="d-sm-none"><i class="fas fa-times" style="color:red"></i> Negativas</span>
                <span class="d-sm-block d-none"><i class="fas fa-times" style="color:red"></i> Negativas</span>
            </a>
        </li>
        <li class="nav-items">
            <a href="#requisitos" data-toggle="tab" onclick="Requisitos()" class="nav-link">
                <span class="d-sm-none"><i class="far fa-comment-alt"></i> Requisitos y Objeciones</span>
                <span class="d-sm-block d-none"><i class="far fa-comment-alt"></i> Requisitos y Objeciones</span>
            </a>
        </li>
        <li class="nav-items">
            <a href="#titulos-y-certificados" data-toggle="tab" onclick="TitulosyCertificados()" class="nav-link">
                <span class="d-sm-none"><i class="far fa-folder-open"></i> Títulos y Certificados</span>
                <span class="d-sm-block d-none"><i class="far fa-folder-open"></i> Títulos y Certificados</span>
            </a>
        </li>
    </ul>

    <div class="tab-content">
        @include('admin.bitacoras.tramites-nuevos')
        @include('admin.bitacoras.estudios-factibilidad')
        @include('admin.bitacoras.negativas')
        @include('admin.bitacoras.requisitos')
        @include('admin.bitacoras.titulos-y-certificados')
    </div>
    @include('admin.procesos.servicios.menu')
    @include('admin.bitacoras.proceso-bitacoras')
    @include('admin.bitacoras.enviar-estatus')
    @include('admin.bitacoras.estatus')
    @include('admin.bitacoras.logo')
    @include('admin.bitacoras.vencimiento')
</div>
@endsection
@section('scripts')
    <script src="{{ asset('archivos/servicios.js') }}"></script>
    <script src="{{ asset('archivos/bitacoras.js') }}"></script>
    <script src="{{ asset('admin/js/json-plugin.js') }}"></script>
    <script>
        $('#Bitacoras').addClass("active");
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









