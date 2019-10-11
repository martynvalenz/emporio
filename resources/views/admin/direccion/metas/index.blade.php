@extends('admin.layouts.app')
@section('title')
<title>Emporio Legal: Metas e Indicadores</title>
@endsection
@section('styles')

@endsection
@section('main-content')
<div id="content" class="content">
    <div class="page-header-fixed" id="header"></div>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.emporio') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Metas de Indicadores</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Metas de Indicadores</h1>
    
    <!-- end page-header -->
    <!-- begin row -->
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6">
            <div class="input-group">
                {{-- <span class="input-group-prepend"><i></i></span>
                <input type="text" class="form-control centered" type="number" placeholder="Año..." title="Agregar año contable" data-tooltip="tooltip" id="anio">
                <div class="input-group-btn" style="padding-right: 1em">
                    <a onclick="" class="btn btn-info"><i class="fa fa-plus"></i></a>
                </div> --}}
                <a onclick="" class="btn btn-primary" style="padding-left: 1em"><i class="fas fa-tachometer-alt"></i> Agregar Año y Metas de Indicador</a>
            </div>
            
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @if(count($metas) > 0)
            {{-- {{$metas->render()}} --}}

            <div class="table-responsive">
                <table class="table headerfix table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
                    <thead style="font-size: 15px; color:white; background-color:#218CBF">
                        <tr class="centered">
                            <th hidden>ID</th>
                            <th>Año</th>
                            <th>Servicios</th>
                            <th>Ingresos</th>
                            <th>Egresos</th>
                            <th>Histórico</th>
                            <th>Actualizado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 15px" id="list-meta" name="list-meta">
                        @foreach($metas as $key => $meta)
                        <tr id="listado-meta-{{ $meta->id }}">
                            <td hidden>{{ $meta->id }}</td>
                            <td style="width: 10%; "align="center">
                                {{ $meta->anio }}
                            </td>
                            <td style="width: 10%" align="center">{{ $meta->servicios }}</td>
                            <td style="width: 20%" align="right">$ {{ number_format($meta->ingresos,2) }}</td>
                            <td style="width: 20%" align="right">$ {{ number_format($meta->egresos,2) }}</td>
                            <td style="width: 10%" align="center">
                                @if($meta->historico == '1')
                                    <label class="label label-warning">Histórico</label>
                                @elseif($meta->historico == '0')
                                    <label class="label label-success">Abierto</label>
                                @endif
                            </td>
                            <td style="width: 15%">
                                {{ Carbon\Carbon::parse($meta->updated_at)->diffForHumans() }}
                            </td>
                            <td style="width: 15%" align="center">
                                <a class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-info"><i class="fas fa-history"></i></a>
                                <a class="btn btn-danger"><i class="fas fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- {{$metas->render()}} --}}
            @else
            <h4>No se encontraron registros con el criterio de búsqueda.</h4>
            @endif
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $('#liDireccion').addClass("active");
    $('#liMetas').addClass("active");
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
    //Date picker
    $('.datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
      //format: 'dd-mm-yyyy'
    });
</script>
<script type="text/javascript">
    $(document).ready(function() 
    {
      $(".fancybox").fancybox();
    });
</script>
<script>
    $(document).ready(function() {
      $(".various").fancybox({
        maxWidth  : 1280,
        maxHeight : 1000,
        fitToView : true,
        width   : '100%',
        height    : '100%',
        autoSize  : false,
        closeClick  : false,
        openEffect  : 'none',
        closeEffect : 'none'
      });
    });
</script>
@endsection






