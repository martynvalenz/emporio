@extends('admin.layouts.app')
@section('title')
<title>Emporio Legal: Control de Servicios</title>
@endsection
@section('styles')
    
@endsection
@section('main-content')
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.emporio') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Administración</li>
    </ol>
    <h1 class="page-header">Administración</h1>
    <hr>
    <ul class="nav nav-pills">
        <li class="nav-items">
            <a href="#control-servicios" data-toggle="tab" class="nav-link active" onclick="ControlServicios()">
                <span class="d-sm-none"><i class="fas fa-crosshairs"></i> Control de Servicios</span>
                <span class="d-sm-block d-none"><i class="fas fa-crosshairs"></i> Control de Servicios</span>
            </a>
        </li>
        {{-- <li class="nav-items">
            <a href="#financiamientos" data-toggle="tab" class="nav-link">
                <span class="d-sm-none"><i class="fas fa-hand-holding-usd"></i> Financiamientos</span>
                <span class="d-sm-block d-none"><i class="fas fa-hand-holding-usd"></i> Financiamientos</span>
            </a>
        </li> --}}
        <li class="nav-items">
            <a href="#facturas" data-toggle="tab" class="nav-link" onclick="Facturas()">
                <span class="d-sm-none"><i class="fas fa-file-pdf"></i> Facturas</span>
                <span class="d-sm-block d-none"><i class="fas fa-file-pdf"></i> Facturas</span>
            </a>
        </li>
        <li class="nav-items">
            <a href="#recibos" data-toggle="tab" class="nav-link" onclick="Recibos()">
                <span class="d-sm-none"><i class="fas fa-receipt"></i> Recibos</span>
                <span class="d-sm-block d-none"><i class="fas fa-receipt"></i> Recibos</span>
            </a>
        </li>

        @if(Auth::user()->Role->Role->id == 1 || Auth::user()->Role->Role->id == 2 || Auth::user()->Role->Role->id == 3)
        <li class="nav-items">
            <a href="#ingresos" data-toggle="tab" class="nav-link" onclick="Ingresos()">
                <span class="d-sm-none"><i class="fas fa-money-bill-alt" style="color:green"></i> Ingresos</span>
                <span class="d-sm-block d-none"><i class="fas fa-money-bill-alt" style="color:green"></i> Ingresos</span>
            </a>
        </li>
        <li class="nav-items">
            <a href="#egresos" data-toggle="tab" class="nav-link" onclick="Egresos()">
                <span class="d-sm-none"><i class="fas fa-money-bill-alt" style="color:red"></i> Egresos</span>
                <span class="d-sm-block d-none"><i class="fas fa-money-bill-alt" style="color:red"></i> Egresos</span>
            </a>
        </li>
        <li class="nav-items">
            <a href="#bancos" data-toggle="tab" class="nav-link" onclick="Bancos()">
                <span class="d-sm-none"><i class="fas fa-piggy-bank"></i> Bancos</span>
                <span class="d-sm-block d-none"><i class="fas fa-piggy-bank"></i> Bancos</span>
            </a>
        </li>
        <!--<li class="nav-items">
            <a href="#tarjetas" data-toggle="tab" class="nav-link" onclick="Tarjetas()">
                <span class="d-sm-none"> <i class="fas fa-credit-card"></i> T.C.</span>
                <span class="d-sm-block d-none"> <i class="fas fa-credit-card"></i> T.C.</span>
            </a>
        </li>-->
        @endif
    </ul>

    <div class="tab-content">
        @include('admin.procesos.servicios.index')
        @include('admin.procesos.facturas.index')
        @include('admin.procesos.recibos.index')
        @include('admin.procesos.bancos.index')
        @include('admin.procesos.egresos.index')
        @include('admin.procesos.ingresos.index')
    </div>
    @include('admin.procesos.facturas.factura-detalles')
    @include('admin.procesos.facturas.razon')
    @include('admin.procesos.egresos.proveedor')
    @include('admin.procesos.egresos.nomina')
    @include('admin.procesos.egresos.nomina-edit')
    @include('admin.procesos.egresos.traspasos')
    @include('admin.procesos.servicios.clientes')
    @include('admin.procesos.recibos.recibo')
    @include('admin.procesos.recibos.pagar-recibo')
    @include('admin.procesos.ingresos.ingreso')
</div>
@endsection
@section('scripts')
    <script src="{{ asset('archivos/servicios.js') }}"></script>
    <script src="{{ asset('archivos/facturas.js') }}"></script>
    <script src="{{ asset('archivos/recibos.js') }}"></script>
    <script src="{{ asset('archivos/egresos.js') }}"></script>
    <script src="{{ asset('archivos/bancos.js') }}"></script>
    <script src="{{ asset('archivos/ingresos.js') }}"></script>
    <script src="{{ asset('admin/js/json-plugin.js') }}"></script>
    <script>
        $('#Administracion').addClass("active");
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

        $('#reservation_factura').daterangepicker();

        $('#reservation_factura').on('change', function()
        {
            FechaRango = document.getElementById('reservation_factura').value.split('  -  ');
            fecha_inicio = FechaRango[0];
            fecha_fin = FechaRango[1];
            //console.log(fecha_inicio);
            //console.log(fecha_fin);
        });

        $('#reservation_recibo').daterangepicker();

        $('#reservation_recibo').on('change', function()
        {
            FechaRango = document.getElementById('reservation_recibo').value.split('  -  ');
            fecha_inicio = FechaRango[0];
            fecha_fin = FechaRango[1];
            //console.log(fecha_inicio);
            //console.log(fecha_fin);
        });

        $('#reservation_ingresos').daterangepicker();

        $('#reservation_ingresos').on('change', function()
        {
            FechaRango = document.getElementById('reservation_ingresos').value.split('  -  ');
            fecha_inicio = FechaRango[0];
            fecha_fin = FechaRango[1];
            //console.log(fecha_inicio);
            //console.log(fecha_fin);
        });

        $('#reservation_egresos').daterangepicker();

        $('#reservation_egresos').on('change', function()
        {
            FechaRango = document.getElementById('reservation_egresos').value.split('  -  ');
            fecha_inicio = FechaRango[0];
            fecha_fin = FechaRango[1];
            //console.log(fecha_inicio);
            //console.log(fecha_fin);
        });

        $('#reservation_bancos').daterangepicker();

        $('#reservation_bancos').on('change', function()
        {
            FechaRango = document.getElementById('reservation_bancos').value.split('  -  ');
            fecha_inicio = FechaRango[0];
            fecha_fin = FechaRango[1];
            //console.log(fecha_inicio);
            //console.log(fecha_fin);
        });

        $('#reservation_tarjetas').daterangepicker();

        $('#reservation_tarjetas').on('change', function()
        {
            FechaRango = document.getElementById('reservation_bancos').value.split('  -  ');
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









