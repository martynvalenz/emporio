@extends('admin.layouts.app')
@section('title')
<title>Emporio Legal: Indicadores de Dirección</title>
@endsection
@section('styles')

@endsection
@section('main-content')
<div id="content" class="content">
    <div class="page-header-fixed" id="header"></div>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.emporio') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><i class="fas fa-tachometer-alt"></i> Trámites pendientes</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header"><i class="fas fa-list"></i> Trámites Pendientes</h1>
    
    <!-- end page-header -->
    <!-- begin row -->
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12" style="font-size: 16px">
            <div class="form-group">
                <label for="">Seleccionar Usuario</label>
                <div class="input-group">
                    <span class="input-group-addon"><i>#</i></span>
                    <select name="user" id="user" class="form-control">
                        <option value="todos">-Todos-</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->iniciales }} - {{ $usuario->nombre }} {{ $usuario->apellido }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="listado-tramites"></div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $('#liIndicadores').addClass("active");
    $('#subPendientes').addClass("active");
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
        user = $('#user').val();
        CargarServicios(user);
    });

    $('#user').change(function()
    {
        user = $(this).val();
        CargarServicios(user);
        /*$.ajax(
        {
            type: 'POST',
            url: '/admin/indicadores/tramites-list',
            data:{user:user},
            success: function(data)
            {
                //console.log(data);
                $('#listado-tramites').replaceWith(data);
                $(".tooltip").tooltip("hide");
                $(function()
                {
                    $('.headerfix').stickyTableHeaders();
                });
            }
        });*/
    });

    function CargarServicios(user)
    {
        console.log(user);
        if(user){
            $.ajax(
            {
                type: 'POST',
                url: '/admin/indicadores/tramites-list',
                data:{user:user},
                success: function(data)
                {
                    console.log(data);
                    $('#listado-tramites').empty().html(data);
                    $(".tooltip").tooltip("hide");
                    $(function()
                    {
                        $('.headerfix').stickyTableHeaders();
                    });
                }
            });   
        }
        
    }

    $(document).on("click", ".pagination li a", function(e)
    {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax(
        {
            type: 'get',
            url: url,
            success: function(data)
            {
                $('#listado-tramites').empty().html(data);
            }
        });
    });
</script>
@endsection






