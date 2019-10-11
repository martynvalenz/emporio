@extends('admin.app')

@section('title')
<title>Emporio Legal | Editar: {{ $puesto->puesto }}</title>
@endsection

@section('styles')
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
     <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
     <!-- bootstrap wysihtml5 - text editor -->
     <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

    
@endsection
 
@section('main-content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Editar puesto: {{ $puesto->puesto }}
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.emporio') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="/admin/puestos">Puestos</a></li>
      <li class="active">Editar</li>
    </ol>
  </section>
  <section class="content">
    <div class="box box-default">
      <div class="box-header with-border">

          <div class="box-body">
            <form role="form" action="{{ route('puestos.update', $puesto->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="row">

              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group {{ $errors->has('puesto') ? ' has-error' : '' }}">
                  <label class="control-label" for="puesto">Nombre del Puesto *</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" placeholder="Puesto..." name="puesto" id="puesto" value="@if(old('puesto')){{ old('puesto') }}@else{{ $puesto->puesto }}@endif">
                  </div>
                  @if ($errors->has('puesto'))
                      <span class="help-block">
                          <strong>{{ $errors->first('puesto') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <div class="form-group">
                  <label for="estatus">Estatus</label>
                  <div class="checkbox">
                    <label>
                    {!! Form::checkbox('estatus', null, $puesto->estatus == 1 ? true : false, array('class'=> 'icheckbox_minimal-blue')) !!} Activa
                  </label>
                  </div>
                </div>
              </div>

            </div>

            <div class="row">

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="editor1" style="width: 100%; height: 600px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">@if(old('descripcion')){{ old('descripcion') }}@else{{ $puesto->descripcion }}@endif</textarea>
                <span class="fath-list form-control-feedback left" aria-hidden="true"></span>
              </div>

              <div class="form-group pull-right">
                <a href="{{ route('puestos.index') }}" type="button" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Regresar
                </a>
                <button type="submit" class="btn btn-info">Guardar  <i class="glyphicon glyphicon-floppy-disk"></i></button>
              </div>
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
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- CK Editor -->
<script src="{{ asset('admin/js/ckeditor/ckeditor.js') }}"></script>
<script>
  $('#liUsuarios').addClass("treeview active");
  $('#liPuestos').addClass("active");
</script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
  });
</script>
<!-- Page script -->
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