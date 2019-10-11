@extends('admin.app')
@section('title')
<title>Emporio Legal | Dirección</title>
@endsection
@section('styles')
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
<link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
<!-- Light Gallery Plugin Css -->
<link href="{{ asset('admin/emporio/plugins/light-gallery/css/lightgallery.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/lightbox2.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
<!-- Chosen select -->
<link rel="stylesheet" href="{{ asset('css/chosen.min.css') }}">
<!-- Styled Checkboxes -->
<link rel="stylesheet" href="{{ asset('css/checkbox.css') }}">
<!-- Date Range Picker -->
<link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datepicker/datepicker3.css') }}">

<!-- Morris charts -->
<link rel="stylesheet" href="{{ asset('admin/plugins/morris/morris.css') }}">

<!-- Data Tables -->
<style type="text/css">
    .minusculas{
    text-transform:lowercase;
    } 
    .mayusculas{
    text-transform:uppercase;
    }
    .modal 
    { 
    overflow: auto !important; 
    }
</style>
@endsection
@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Indicadores de Dirección
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
            <li class="active">Dirección</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div id="crud" class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Seleccionar año 
                                    <select name="" id="anio">
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                    </select>
                                </h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body chart-responsive">
                                <div class="chart" id="bar-chart" style="height: 400px;"></div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section('scripts')
<!-- Bootstrap 3.3.6 -->
<!-- Slimscroll -->
<script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>

 Morris.js charts 
<script src="{{ asset('admin/plugins/morris/raphael-min.js') }}"></script>
<script src="{{ asset('admin/plugins/morris/morris.min.js') }}"></script>
<script src="{{ asset('admin/plugins/chartjs/Chart.min.js') }}"></script>

<!-- FastClick -->
<script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('admin/js/toastr.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('admin/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
<script src="{{ asset('js/lightbox.js') }}"></script>
<!-- Light Gallery Plugin Js -->
<script src="{{ asset('admin/emporio/plugins/light-gallery/js/lightgallery-all.js') }}"></script>
<!-- Custom Js -->
<script src="{{ asset('admin/emporio/js/pages/medias/image-gallery.js') }}"></script>
<!-- sticky headers -->
<script src="{{ asset('js/jquery.stickytableheaders.min.js') }}"></script>
<!-- Chosen Jquery select -->
<script src="{{ asset('js/chosen.jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>

<!-- bootstrap datepicker -->
<script src="{{ asset('admin/plugins/daterangepicker/moment.js') }}"></script>
<script src="{{ asset('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('admin/plugins/datepicker/locales/bootstrap-datepicker.es.js') }}"></script>



<script>
    $(document).ready(function() {
        $('body').tooltip({
            selector: "[data-tooltip=tooltip]",
            container: "body"
        });
    });
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
<script>
    $('#liDireccion').addClass("treeview active");
    $('#subDireccion').addClass("active");
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
    $(document).ready(function()
    {
        var router = "/admin/direccion/anio";
        
        $.get(router, function(data)
        {
            console.log(data);
            $('#anio').val(data).change();

            cargarMeses(data);
        });
    });

    $('#anio').on('change', function()
    {
        cargarMeses($(this).val());
    });

    function cargarMeses(anio)
    {
        var route = '/admin/direccion/mensual/' + anio;
        
        //console.log(id);

        $.get(route, function(data)
        {
            console.log(data);
            enero_ingresos = data.enero_ingresos;
            febrero_ingresos = data.febrero_ingresos;
            marzo_ingresos = data.marzo_ingresos;
            abril_ingresos = data.abril_ingresos;
            mayo_ingresos = data.mayo_ingresos;
            junio_ingresos = data.junio_ingresos;
            julio_ingresos = data.julio_ingresos;
            agosto_ingresos = data.agosto_ingresos;
            septiembre_ingresos = data.septiembre_ingresos;
            octubre_ingresos = data.octubre_ingresos;
            noviembre_ingresos = data.noviembre_ingresos;
            diciembre_ingresos = data.diciembre_ingresos;

            enero_egresos = data.enero_egresos;
            febrero_egresos = data.febrero_egresos;
            marzo_egresos = data.marzo_egresos;
            abril_egresos = data.abril_egresos;
            mayo_egresos = data.mayo_egresos;
            junio_egresos = data.junio_egresos;
            julio_egresos = data.julio_egresos;
            agosto_egresos = data.agosto_egresos;
            septiembre_egresos = data.septiembre_egresos;
            octubre_egresos = data.octubre_egresos;
            noviembre_egresos = data.noviembre_egresos;
            diciembre_egresos = data.diciembre_egresos;

            GraficaMeses(enero_ingresos, febrero_ingresos, marzo_ingresos, abril_ingresos, mayo_ingresos, junio_ingresos, julio_ingresos, agosto_ingresos, septiembre_ingresos, octubre_ingresos, noviembre_ingresos, diciembre_ingresos, enero_egresos, febrero_egresos, marzo_egresos, abril_egresos, mayo_egresos, junio_egresos, julio_egresos, agosto_egresos, septiembre_egresos, octubre_egresos, noviembre_egresos, diciembre_egresos);
        });
    }

    function GraficaMeses(enero_ingresos, febrero_ingresos, marzo_ingresos, abril_ingresos, mayo_ingresos, junio_ingresos, julio_ingresos, agosto_ingresos, septiembre_ingresos, octubre_ingresos, noviembre_ingresos, diciembre_ingresos, enero_egresos, febrero_egresos, marzo_egresos, abril_egresos, mayo_egresos, junio_egresos, julio_egresos, agosto_egresos, septiembre_egresos, octubre_egresos, noviembre_egresos, diciembre_egresos)
    {
        "use strict";

        //BAR CHART
        var bar = new Morris.Bar({
          element: 'bar-chart',
          resize: true,
          data: [
            {y: 'Ene', a: enero_ingresos, b: enero_egresos},
            {y: 'Feb', a: febrero_ingresos, b: febrero_egresos},
            {y: 'Mar', a: marzo_ingresos, b: marzo_egresos},
            {y: 'Abr', a: abril_ingresos, b: abril_egresos},
            {y: 'May', a: mayo_ingresos, b: mayo_egresos},
            {y: 'Jun', a: junio_ingresos, b: junio_egresos},
            {y: 'Jul', a: julio_ingresos, b: julio_egresos},
            {y: 'Ago', a: agosto_ingresos, b: agosto_egresos},
            {y: 'Sep', a: septiembre_ingresos, b: septiembre_egresos},
            {y: 'Oct', a: octubre_ingresos, b: octubre_egresos},
            {y: 'Nov', a: noviembre_ingresos, b: noviembre_egresos},
            {y: 'Dic', a: diciembre_ingresos, b: diciembre_egresos}
          ],
          barColors: ['#00a65a', '#f56954'],
          xkey: 'y',
          ykeys: ['a', 'b'],
          labels: ['Ingresos', 'Egresos'],
          hideHover: 'auto'
        });

    }
</script>

@endsection












