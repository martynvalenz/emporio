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
    <input type="hidden" value="{{ $servicio->id_catalogo_servicio }}" id="id_catalogo_servicio">
    <!-- end page-header -->
    <!-- begin row -->
    <hr>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <a class="btn btn-primary btn-lg" onclick="Generar({{ $servicio->id }})">Generar <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
    <br>
    <div id="listado"></div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('admin/js/json-plugin.js') }}"></script>
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
<script>
    $.ajaxSetup(
    {
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function()
    {
        id_catalogo_servicio = $('#id_catalogo_servicio').val();
        Listar(id_catalogo_servicio);
    });

    function Listar(id)
    {
        $.ajax(
        {
            type: 'get',
            url: '/admin/check-list/catalogo/' + id,
            success: function(data)
            {
                $('#listado').empty().html(data);
                $(".tooltip").tooltip("hide");
            }
        });
    }

    function Generar(id)
    {
        avance_total = $('#avance_total').val();
        token = $('#_token').val();
        formData = {avance_total}
        //location.href = '/admin/check-list/edit/' + id;

        if(avance_total == 0)
        {
            toastr.error('No se puede generar el proceso debido a que no tiene pasos, actualice el navegador o seleccione otro servicio.');
        }
        else
        {
            var TableData;
            TableData = $.toJSON(storeTableValues(id));

            $.ajax(
            {
                type: 'POST',
                headers:
                {
                    'X-CSRF-TOKEN': token
                },
                url: '/admin/procesos/insertarProceso',
                data: 'string=' + TableData,
                success: function(data)
                {
                    $.ajax(
                    {   
                        type: 'PUT',
                        headers:
                        {
                            'X-CSRF-TOKEN': token
                        },
                        url: '/admin/procesos/editar-avance-total/' + id,
                        data: formData,
                        success: function(data)
                        {
                            location.href = '/admin/check-list/edit/' + id;
                        },
                        error: function(data)
                        {
                            console.log(data);
                            toastr.error('No se pudo editar el avance total.');
                        }
                    });
                },
                error: function(data)
                {
                    toastr.error('No se pudo insertar el proceso del servicio.');
                    console.log(data);
                }
            });
        }
    }

    function storeTableValues(id)
    {
        var TableData = new Array();
        var dt = new Date();

        anio = dt.getFullYear();
        mes = dt.getMonth() + 1;
        dia = dt.getDate();
        hora = dt.getHours();
        minutos = dt.getMinutes();
        segundos = dt.getSeconds();

        var datetime = anio + '-' + mes + '-' + dia + ' ' + hora + ':' + minutos + ':' + segundos;

        //console.log(date);


        id = id;

        $('#process-list tr').each(function(row, tr)
        {
            TableData[row] = 
            {
                //'id' : + $(tr).find('td:eq(0)').text(), //<th>ID</th>
                'orden' :  $(tr).find('td:eq(1)').text(), //<th>Orden</th>
                'libera_venta' : $(tr).find('td:eq(9)').text(), //<th>Venta</th>
                'libera_operativa' : $(tr).find('td:eq(10)').text(), //<th>Operativa</th>
                'libera_gestion' : $(tr).find('td:eq(11)').text(), //<th>Gestión</th>
                //'id_servicio' : id_servicio,
                //'categoria' : $(tr).find('td:eq(5)').text(), //<th>Area</th>
                //'requisito' :  $(tr).find('td:eq(6)').text(), //<th>Requisitos</th>
                'id_requisitos' : $(tr).find('td:eq(12)').text(), //<th>Idreq</th>
                'registro' : $(tr).find('td:eq(13)').text(), //<th>Registro</th>
                //'id_catalogo_servicio' : $(tr).find('td:eq(8)').text() //<th>Idcat</th>
                'id_servicio' : id,
                'created_at' : datetime,
                'updated_at' : datetime
            }
        });

        TableData.shift(); //first row is the table header - so remove
        //console.log(TableData);
        return TableData;
    }

    function QuitarPaso(id)
    {
        avance_total = $('#avance_total').val();
        avance_total = (avance_total * 1) - 1;

        $('#requisito-' + id).remove();

        $('#avance_total').val(avance_total);
    }
        
</script>
@endsection








