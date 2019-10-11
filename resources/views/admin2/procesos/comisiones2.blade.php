@extends('admin.app')

@section('title')
<title>Emporio Legal | Comisiones</title>
@endsection

@section('styles')
    <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
  <!-- Datatables 
  <link href="{{ asset('admin/dataTable Bootstrap/datatables.css') }}" rel="stylesheet">-->
    <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
    <style type="text/css">
      .minusculas{
        text-transform:lowercase;
      } 
      .mayusculas{
        text-transform:uppercase;
      }
    </style>

@endsection
@section('main-content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Servicio: {{ $servicio->CatalogoServicios->clave }} {{ $servicio->Clientes->nombre_comercial }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="{{ route('procesos.index') }}"></i> Control de Servicios</a></li>
        <li class="active">{{ $servicio->CatalogoServicios->clave }}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div id="crud" class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="btn-group">
                <a href="{{ route('procesos.index') }}" data-tooltip="tooltip" title="Regresar al Control de Servicios" class="btn btn-warning"><i class="glyphicon glyphicon-chevron-left"></i> Regresar a Control</a>
                @if($servicio->aplica_comision_venta == 0 && $servicio->aplica_comision_operativa == 0 && $servicio->aplica_comision_gestion == 0)
                  <a class="btn btn-gris" data-tooltip="tooltip" title="Este servicio no tiene comisiones aplicadas, debe editar el servicio y seleccionar los tipos de comisiones a aplicar." disabled><i class="fa fa-plus"></i> Agregar Comisión
                  </a>
                @else
                  <a class="btn btn-azul" data-target="#agregar_comision" data-toggle="modal" data-tooltip="tooltip" title="Asignar comisión a un usuario"><i class="fa fa-plus"></i> Agregar Comisión
                  </a>
                  @include('admin.comisiones.procesos-comision')
                @endif
              </div>
            </div>

            <hr>
            <div class="container">
              @if($servicio->aplica_comision_venta == 1)
                <div class="row">
                  <div class="col-lg-3 div col-md-3 col-sm-8 col-xs-8">
                    <div class="form-group">
                      <label class="control-label">Comisión Restante</label>
                      <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                          <input type="text" name="concepto_venta" class="form-control" value="Venta" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 div col-md-2 col-sm-4 col-xs-4">
                    <div class="form-group">
                      <label class="control-label">Monto</label>
                      <div class="input-group">
                          <span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
                          <input type="text" name="comision_venta_restante" id="comision_venta_restante_principal" class="form-control" value="{{ $servicio->comision_venta_restante }}" disabled>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
              @if($servicio->aplica_comision_operativa == 1)
                <div class="row">
                  <div class="col-lg-3 div col-md-3 col-sm-8 col-xs-8">
                    <div class="form-group">
                      <label class="control-label">Comisión Restante</label>
                      <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                          <input type="text" name="concepto_operativo" class="form-control" value="Operativa" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 div col-md-2 col-sm-4 col-xs-4">
                    <div class="form-group">
                      <label class="control-label">Monto</label>
                      <div class="input-group">
                          <span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
                          <input type="text" name="comision_operativa_restante" id="comision_operativa_restante_principal" class="form-control" value="{{ $servicio->comision_operativa_restante }}" disabled>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
              @if($servicio->aplica_comision_gestion == 1)
                <div class="row">
                  <div class="col-lg-3 div col-md-3 col-sm-8 col-xs-8">
                    <div class="form-group">
                      <label class="control-label">Comisión Restante</label>
                      <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                          <input type="text" name="concepto_gestion" class="form-control" value="Gestión" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 div col-md-2 col-sm-4 col-xs-4">
                    <div class="form-group">
                      <label class="control-label">Monto</label>
                      <div class="input-group">
                          <span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
                          <input type="text" name="comision_gestion_restante" id="comision_gestion_restante_principal" class="form-control" value="{{ $servicio->comision_gestion_restante }}" disabled>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($comisiones) > 0)
              <div class="table-responsive">
                <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
                  <thead style="font-size: 15px">
                    <tr>
                      <th hidden>Id</th>
                      <th>Usuario</th>
                      <th>Tipo</th>
                      <th>Agregada</th>
                      <th>Monto</th>
                      <th data-tooltip="tooltip" title="Fecha en que se libera la comisión por terminar su participación en la bitácora">Liberada</th>
                      <th>Pagada</th>
                      <th>Estatus?</th>
                      <th colspan ="1">&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody style="font-size: 15px" id="list" name="list">
                  @foreach($comisiones as $key => $comision)
                    <tr id="comision{{ $comision->id }}">
                      <th hidden>{{ $comision->id }}</th>
                      <td style="width:25%;" valign="left" title="{{ $comision->comentarios }}" data-tooltip="tooltip">{{ $comision->Admin->nombre }} {{ $comision->Admin->apellido }}</td>
                      <td style="width:15%;" valign="middle" title="{{ $comision->comentarios }}" data-tooltip="tooltip">{{ $comision->tipo_comision }}</td>
                      <td style="width:10%;" align="center" valign="middle" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($comision->created_at)->diffForHumans() }}">{{ Carbon\Carbon::parse($comision->created_at)->format('d/m/Y') }}</td>
                      <td style="width:10%;" valign="middle" align="right">{{ number_format($comision->monto,2) }}</td>
                      @if($comision->fecha_aplicada == null)
                        <td style="width:10%;" align="center" valign="middle"></td>
                      @else
                        <td style="width:10%;" align="center" valign="middle" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($comision->fecha_aplicada)->diffForHumans() }}">{{ Carbon\Carbon::parse($comision->fecha_aplicada)->format('d/m/Y') }}</td>
                      @endif
                      @if($comision->fecha_pagado == null)
                        <td style="width:10%;" align="center" valign="middle"></td>
                      @else
                        <td style="width:10%;" align="center" valign="middle" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($comision->fecha_pagado)->diffForHumans() }}">{{ Carbon\Carbon::parse($comision->fecha_pagado)->format('d/m/Y') }}</td>
                      @endif
                      <td style="width:10%;" align="center" valign="middle">
                        @if($comision->estatus == 'Pagado')
                          <label class="label label-success">Pagado</label>
                        @elseif($comision->estatus == 'Pendiente')
                          <label class="label label-warning">Pendiente</label>
                        @elseif($comision->estatus == 'Cancelado')
                          <label class="label label-danger">Cancelado</label>
                        @elseif($comision->estatus == 'Liberada')
                          <label class="label label-primary">Liberada</label>
                        @else
                          <label></label>
                        @endif
                      </td>
                      <td style="width:10%;" align="center">
                        @if($comision->estatus == 'Pagado')
                          <a class="btn btn-xs btn-default" data-tooltip="tooltip" title="No se puede Editar una comisión ya Pagada, primero debe Cancelar el pago en el módulo de Nóminas" disabled>
                            <i class="glyphicon glyphicon-edit"></i>
                          </a>
                          <a class="btn btn-xs btn-default" data-tooltip="tooltip" title="No se puede cancelar una comisión Pagada, debe cancelar primero el pago en el módulo de Nóminas ." disabled>
                            <i class="glyphicon glyphicon-remove"></i>
                          </a>
                        @elseif($comision->estatus == 'Cancelado')
                          <a class="btn btn-xs btn-default" data-tooltip="tooltip" title="No se puede Editar una comisión ya Cancelada, primero debe Cancelar el pago en el módulo de Nóminas" disabled>
                            <i class="glyphicon glyphicon-edit"></i>
                          </a>
                          <a class="btn btn-xs btn-default" data-tooltip="tooltip" title="La comisión ya está Cancelada" disabled>
                            <i class="glyphicon glyphicon-remove"></i>
                          </a>
                        @else
                          <a class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modal-editar-comision-{{ $comision->id }}" data-tooltip="tooltip" title="Editar comision: {{ $comision->tipo_comision }}-{{ $comision->Admin->nombre }} {{ $comision->Admin->apellido }}">
                            <i class="glyphicon glyphicon-edit"></i>
                          </a>
                          <a class="btn btn-xs btn-danger" data-target="#modal-cancelar-comision-{{ $comision->id }}" data-toggle="modal" data-tooltip="tooltip" title="Cancelar comisión" >
                            <i class="glyphicon glyphicon-remove"></i>
                          </a>
                          
                        @endif
                      </td>
                    </tr>
                    @include('admin.comisiones.cancelar')
                    @include('admin.comisiones.edit')
                  @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <h4>No hay registros encontrados, inicie por crear uno registro nuevo.</h4>
            @endif
            <a href="{{ route('procesos.index') }}" data-tooltip="tooltip" title="Regresar al Control de Servicios" class="btn btn-warning"><i class="glyphicon glyphicon-chevron-left"></i> Regresar a Control</a>
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
  <!-- Datatables 
    <script src="{{ asset('admin/dataTable Bootstrap/datatables.js') }}"></script>-->
  <!-- Slimscroll -->
  <script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script>
  <!-- Toastr -->
  <script src="{{ asset('admin/js/toastr.js') }}"></script>
  <!-- Vue y Axios-->
  <script src="{{ asset('js/vue.js') }}"></script>
  <script src="{{ asset('js/axios.js') }}"></script>
  <!-- SlimScroll 1.3.0 -->
  <script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <!-- bootstrap color picker -->
  <script src="{{ asset('admin/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
  <!-- iCheck 1.0.1 -->
  <script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>
  <!-- InputMask -->
  <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
  <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

  <script>
    $(document).ready(function() {
        $('body').tooltip({
            selector: "[data-tooltip=tooltip]",
            container: "body"
        });
    });
  </script>

  <script>
    $('#liServicios').addClass("treeview active");
    $('#subControl_Servicios').addClass("active");
  </script>
  <script>
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });

    //Data Mask
    $("[data-mask]").inputmask();
</script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
<script>
  $(document).ready(function()
  {
    $("#tipo_comision_select").change(mostrarValores);
    //$("#id_bitacoras").change(avance_total_bitacoras);


    $("#btn_agregar").click(function(e) 
    {
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

      e.preventDefault(); 

      monto_select = $("#monto_select").val();
      monto = $("#monto").val();
      tipo_comision_select = $("#tipo_comision_select").val();
      id_admin = $("#id_admin").val();

      if(tipo_comision_select == '')
      {
        toastr.error('Seleccione un tipo de comisión.');
      }
      else if(id_admin == '')
      {
        toastr.error('No se seleccionó usuario a quien aplicar la comisión.');
      }
      else
      {
        if(monto_select > 0 && monto > 0)
        {
          monto_restante = monto_select - monto;

          if(monto_restante<0)
          {
            //no se arma
            toastr.error('El monto de la comisión no puede ser mayor al monto disponible.');
          }
          else
          {
            $('#monto_restante').val(monto_restante);
            Agregar();
            
          }
        }
        else
        {
          toastr.error('El monto de comisión y el monto disponible deben ser valores numéricos mayores a Cero.');
        }
      }
      
    });
  });

  function mostrarValores()
  {
    datosValor=document.getElementById('tipo_comision_select').value.split('_');
    $('#monto_select').val(datosValor[0]);
    $('#monto').val(datosValor[0]);
    $('#tipo_comision_val').val(datosValor[1]);
    monto_select = datosValor[0];
    monto = datosValor[0];
    monto_restante = monto_select - monto;
    $('#monto_restante').val(monto_restante);
  }

  function Agregar()
  {
    var formData = 
    {
        '_token': $('input[name=_token]').val(),
        tipo_comision: $('input[name=tipo_comision]').val(),
        monto_restante: $('input[name=monto_restante]').val(),
        id_admin: $('select[name=id_admin]').val(),
        id_servicio: $('input[name=id_servicio]').val(),
        id: $('input[name=id_servicio]').val(),
        comentarios: $('textarea[name=comentarios]').val(),
        monto: $('input[name=monto]').val(),
        concepto: $('input[name=concepto]').val(),
        estatus: $('input[name=estatus]').val(),
        listo_comision_venta: $('input[name=listo_comision_venta]').val(),
        listo_comision_operativa: $('input[name=listo_comision_operativa]').val(),
        listo_comision_gestion: $('input[name=listo_comision_gestion]').val(),

    }

    console.log(formData);

    $.ajax(
    {
        type: 'POST',
        dataType: 'json',
        url: '/admin/procesos/crear-comisiones',
        data: formData,
        success: function(data) 
        {
          toastr.success('Se creó el registro exitosamente');          

          var nada='';
          $('#tipo_comision_select').val(nada);
          $('#tipo_comision_val').val(nada);
          $('#id_admin').val(nada);
          $('#monto_select').val(nada);
          $('#monto').val(nada);
          $('#monto_restante').val(nada);
          $('#comentarios').val(nada);

          $('#agregar_comision').modal('toggle'); 
          

          $( "#agregarForm" ).submit();

          
        },
        error: function (data) 
        {
            console.log('Error:', data);
        }
    });
  }
</script>
<script>
  /*$(document).ready(function() 
  {
    $('#example1').DataTable( 
    {

      dom: 'Bfrtip',
        buttons: 
        [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,



      "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) 
      {
          if(aData[6] == "Activo")
          {
              $('td:eq(6)', nRow).css("background-color", "#c6efce");
              $('td:eq(6)', nRow).css("color", "#006100");
          }
          else if (aData[6] == "Inactivo")
          {
              $('td:eq(6)', nRow).css("background-color", "#ffc7ce");
              $('td:eq(6)', nRow).css("color", "#9c0006");
          }
        }
    });
    
  });*/
  function cellStyle(value, row, index) {
    var classes = ['active', 'success', 'info', 'warning', 'danger'];
    if (index % 6 === 0 && index / 2 < classes.length) {
        return {
            //classes: classes[index / 2]
            css: {
                "background-color": "red",
            }
        };
    }
    return {};
}
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