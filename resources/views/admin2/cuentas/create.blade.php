@extends('admin.app')

@section('title')
<title>Emporio Legal | Cuentas</title>
@endsection

@section('styles')
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">

    
@endsection
 
@section('main-content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Agregar Cuenta
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.emporio') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('cuentas.index') }}">Cuentas</a></li>
      <li class="active">Agregar</li>
    </ol>
  </section>
  <section class="content">
    <div class="box box-default">
      <div class="box-header with-border">

        <div class="box-body">
          <form role="form" action="{{ route('cuentas.store') }}" method="post">
            {{ csrf_field() }}
            <div class="row">

              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="form-group {{ $errors->has('tipo') ? ' has-error' : '' }}">
                  <label for="tipo" class="control-label">Seleccione el tipo de Cuenta</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
                    <select name="tipo" id="tipo" value="{{ old('tipo') }}" class="form-control">
                      <option value="Crédito">Crédito</option>
                      <option value="Fiscal">Empresarial</option>
                      <option value="Fiscal">Fiscal</option>
                      <option value="Efectivo">Efectivo</option>
                      <option value="Debito">Débito</option>
                      <option value="Departamental">Departamental</option>
                    </select>
                  </div>
                  @if ($errors->has('tipo'))
                      <span class="help-block">
                          <strong>{{ $errors->first('tipo') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="form-group {{ $errors->has('alias') ? ' has-error' : '' }}">
                  <label for="alias" class="control-label">Alias de cuenta</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-piggy-bank"></i></span>
                    <input type="text" class="form-control" placeholder="Nombre o alias de cuenta..." name="alias" id="alias" value="{{old('alias')}}">
                  </div>
                  @if ($errors->has('alias'))
                      <span class="help-block">
                          <strong>{{ $errors->first('alias') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="form-group {{ $errors->has('id_banco') ? ' has-error' : '' }}">
                  <label for="id_banco">Banco</label>
                  <div class="input-group">
                    <span class="input-group-addon btn btn-invertido" style="background-color: #207e94; color:white" title="Agregar Banco">
                        <i class="fa fa-university"></i>
                    </span>
                    <select class="form-control" name="id_banco" id="id_banco" style="width: 100%;">
                      @foreach ($bancos as $banco)
                        <option value="{{ $banco->id }}">{{ $banco->banco }}</option>
                      @endforeach
                    </select>
                  </div>
                  @if ($errors->has('id_banco'))
                      <span class="help-block">
                          <strong>{{ $errors->first('id_banco') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="form-group {{ $errors->has('saldo_inicial') ? ' has-error' : '' }}">
                  <label for="saldo_inicial" class="control-label">Saldo inicial</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                    <input type="number" step="any" class="form-control" placeholder="Saldo inicial de cuenta..." name="saldo_inicial" id="saldo_inicial" value="0">
                  </div>
                  @if ($errors->has('saldo_inicial'))
                      <span class="help-block">
                          <strong>{{ $errors->first('saldo_inicial') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

            </div>

            <div class="row">

              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group {{ $errors->has('cuenta') ? ' has-error' : '' }}">
                  <label for="cuenta" class="control-label">Número de Cuenta</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i><b>#</b></i></span>
                    <input type="text" class="form-control" placeholder="123456789..." name="cuenta" id="cuenta" value="{{old('cuenta')}}">
                  </div>
                  @if ($errors->has('cuenta'))
                      <span class="help-block">
                          <strong>{{ $errors->first('cuenta') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group {{ $errors->has('clabe') ? ' has-error' : '' }}">
                  <label for="clabe" class="control-label">CLABE</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-suitcase" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="18 o 20 Dígitos..." name="clabe" id="clabe" value="{{old('clabe')}}">
                  </div>
                  @if ($errors->has('clabe'))
                      <span class="help-block">
                          <strong>{{ $errors->first('clabe') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group {{ $errors->has('tarjeta') ? ' has-error' : '' }}">
                  <label for="tarjeta" class="control-label">Número de tarjeta</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-credit-card-alt"></i></span>
                    <input type="text" class="form-control" placeholder="16 Dígitos..." name="tarjeta" id="tarjeta" value="{{old('tarjeta')}}" data-inputmask='"mask": "#### #### #### ####"' data-mask>
                  </div>
                  @if ($errors->has('tarjeta'))
                      <span class="help-block">
                          <strong>{{ $errors->first('tarjeta') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                <label for="comentarios">Comentarios</label>
                <textarea rows="3" class="form-control has-feedback-left" placeholder="Anote una descripción para la Cuenta..." name="comentarios" id="comentarios" value="{{ old('comentarios') }}"></textarea>
                <span class="fath-list form-control-feedback left" aria-hidden="true"></span>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="form-group">
                  <label for="estatus">Estatus</label>
                  <div class="checkbox">
                    <label>
                      <input class="icheckbox_minimal-blue" type="checkbox" name="estatus"
                      @if (old('estatus') == 1)
                        checked
                      @else
                        unchecked
                      @endif
                      checked="checked"> Activo
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group pull-right">
              <input name"_token" value="{{ csrf_token() }}" type="hidden">
              <a href="{{ route('cuentas.index') }}" type="button" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Regresar
              </a>
              <button type="submit" class="btn btn-azul">Guardar <i class="glyphicon glyphicon-floppy-disk"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection

@section('scripts')
<!-- Select2 -->
<script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('admin/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<!-- bootstrap time picker -->
<script src="{{ asset('admin/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script>
<!-- Page script -->
<script>
  $('#liAjustes').addClass("treeview active");
  $('#liCuentas').addClass("active");
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
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
@endsection