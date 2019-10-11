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
        <li class="breadcrumb-item active"><i class="fas fa-tachometer-alt"></i> Indicadores de Dirección</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header --> 
    <h1 class="page-header"><i class="fas fa-tachometer-alt"></i> Indicadores de Dirección</h1>
    
    <!-- end page-header -->
    <!-- begin row -->
    <div class="row">
        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-6" style="font-size: 16px">
            <div class="form-group">
                <label for="">Seleccionar Año</label>
                <div class="input-group">
                    <span class="input-group-addon"><i>#</i></span>
                    <select name="anio" id="anio" class="form-control">
                        @foreach($metas as $meta)
                            <option value="{{ $meta->anio }}">{{ $meta->anio }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" id="anio_actual" value="{{ $anio_actual }}">
                </div>
            </div>
            
            
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="index-1">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        {{-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> --}}
                        <a onclick="getEstadosCuenta()" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Ingresos vs Egresos</h4>
                </div>
                <div class="panel-body">
                    <div id="interactive-chart" class="height-md"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    {{-- <script src="{{ asset('admin/js/demo/dashboard.js') }}"></script> --}}
    <script src="{{ asset('admin/plugins/flot/jquery.flot.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/flot/jquery.flot.time.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/flot/jquery.flot.resize.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/flot/jquery.flot.pie.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/sparkline/jquery.sparkline.js') }}"></script>
    <script src="{{ asset('admin/plugins/jquery-jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('admin/js/demo/dashboard.min.js') }}"></script>

<script>
    $(document).ready(function()
    {
        anio_actual = $('#anio_actual').val();
        //console.log(anio_actual);
        $('#anio').val(anio_actual).change();
    });
</script>
<script>
    $(document).ready(function() {
        //Chart.init();
        //handleMorrisLineChart();
        getEstadosCuenta();
        //Dashboard.init();
    });

    

    var handleMorrisLineChart = function () {
        var tax_data = [
            {"period": "2011 Q3", "licensed": 3407, "sorned": 660},
            {"period": "2011 Q2", "licensed": 3351, "sorned": 629},
            {"period": "2011 Q1", "licensed": 3269, "sorned": 618},
            {"period": "2010 Q4", "licensed": 3246, "sorned": 661},
            {"period": "2009 Q4", "licensed": 3171, "sorned": 676},
            {"period": "2008 Q4", "licensed": 3155, "sorned": 681},
            {"period": "2007 Q4", "licensed": 3226, "sorned": 620},
            {"period": "2006 Q4", "licensed": 3245, "sorned": null},
            {"period": "2005 Q4", "licensed": 3289, "sorned": null}
        ];
        Morris.Line({
            element: 'morris-line-chart',
            data: tax_data,
            xkey: 'period',
            ykeys: ['licensed', 'sorned'],
            labels: ['Licensed', 'Off the road'],
            resize: true,
            pointSize: 5,
            lineWidth: 2.5,
            gridLineColor: [COLOR_GREY_LIGHTER],
            gridTextFamily: FONT_FAMILY,
            gridTextColor: FONT_COLOR,
            gridTextWeight: FONT_WEIGHT,
            gridTextSize: FONT_SIZE,
            lineColors: [COLOR_GREEN, COLOR_BLUE]
        });
    };
</script>
<script>
    $('#liIndicadores').addClass("active");
    $('#subIndicadores').addClass("active");
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






