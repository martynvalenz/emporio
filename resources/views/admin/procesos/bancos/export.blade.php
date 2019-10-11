@extends('admin.layouts.app')
@section('title')
<title>Emporio Legal: Exportar Estados de Cuenta</title>
@endsection
@section('styles')
    
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('admin/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/plugins/DataTables/extensions/AutoFill/css/autoFill.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/plugins/DataTables/extensions/ColReorder/css/colReorder.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/plugins/DataTables/extensions/KeyTable/css/keyTable.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/plugins/DataTables/extensions/RowReorder/css/rowReorder.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/plugins/DataTables/extensions/Select/css/select.bootstrap.min.css') }}" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ asset('admin/plugins/pace/pace.min.js') }}"></script>
</head>
<body>

@endsection
@section('main-content')

    <div id="content" class="content">
        <!-- begin page-header -->
        {{-- <h1 class="page-header">Exportar Estados de Cuenta</h1> --}}
        <!-- end page-header -->
        <!-- begin row -->
        <div class="row">
            <!-- begin col-10 -->
            <div class="col-lg-12">
                <div class="panel panel-inverse">
                    <!-- begin panel-heading -->
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Exportar Estados de Cuenta</h4>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin panel-body -->
                    <div class="panel-body">
                        <table id="data-table-combine" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Fecha</th>
                                    <th>Forma de Pago</th>
                                    <th>Cuenta</th>
                                    <th>Cliente</th>
                                    <th>Proveedor</th>
                                    <th>Cheque</th>
                                    <th>Subtotal</th>
                                    <th>IVA</th>
                                    <th>Total</th>
                                    <th>Depósito</th>
                                    <th>Retiro</th>
                                    <th>Estatus</th>
                                    <th>Usuario</th>
                                    <th>Cancelado?</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($estados_cuenta as $estado)
                                    <tr>
                                        <td>{{ $estado->tipo }}</td>
                                        <td>{{ $estado->fecha }}</td>
                                        <td>{{ $estado->forma_pago }}</td>
                                        <td>{{ $estado->alias }}</td>
                                        <td>{{ $estado->cliente }}</td>
                                        <td>{{ $estado->proveedor }}</td>
                                        <td>{{ $estado->cheque }}</td>
                                        <td>{{ $estado->subtotal }}</td>
                                        <td>{{ $estado->iva }}</td>
                                        <td>{{ $estado->total }}</td>
                                        <td>{{ $estado->deposito }}</td>
                                        <td>{{ $estado->retiro }}</td>
                                        <td>{{ $estado->estatus }}</td>
                                        <td>{{ $estado->iniciales }}</td>
                                        <td>{{ $estado->cancelado_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- end panel-body -->
                </div>
            </div>
            <!-- end col-10 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end #content -->
@endsection
@section('scripts')
    
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{ asset('admin/plugins/DataTables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/extensions/Buttons/js/jszip.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/extensions/AutoFill/js/dataTables.autoFill.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/extensions/ColReorder/js/dataTables.colReorder.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/extensions/KeyTable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/extensions/RowReorder/js/dataTables.rowReorder.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/extensions/Select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('admin/js/demo/table-manage-combine.demo.min.js') }}"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    
    <script>
        $(document).ready(function() {
            // App.init();
            TableManageCombine.init();
        });
    </script>
@endsection