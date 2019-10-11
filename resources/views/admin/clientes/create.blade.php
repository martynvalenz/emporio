@extends('admin.app')

@section('title')
<title>Emporio Legal | Crear Clientes</title>
@endsection

@section('styles')
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
      <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

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
  <section class="content-header">
    <h1>
      Agregar Cliente
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
      <li><a href="{{ route('clientes.index') }}">Clientes</a></li>
      <li class="active">Crear</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="box box-default">
      <div class="box-header with-border">
        
      </div>

      <div class="box-body">     

        <form role="form" action="{{ route('clientes.store') }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          
          <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
              <div class="form-group {{ $errors->has('nombre_comercial') ? ' has-error' : '' }}">
                <label for="nombre_comercial" class="control-label">Nombre Comercial *</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-knight"></i></span>
                  <input type="text" class="form-control" placeholder="Nombre comercial de la Empresa..." name="nombre_comercial" id="nombre_comercial" value="{{old('nombre_comercial')}}">
                </div>
                @if ($errors->has('nombre_comercial'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nombre_comercial') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
              <div class="form-group {{ $errors->has('id_estrategia') ? ' has-error' : '' }}">
                <label for="id_estrategia">Estrategia</label>
                <div class="input-group">
                  <span class="input-group-addon btn btn-invertido" style="background-color: #207e94; color:white" title="Agregar estrategia" data-target="#agregar-estrategia" data-toggle="modal">
                      <i class="fas fa-chart-line"></i>
                  </span>
                  <select class="form-control" name="id_estrategia" id="id_estrategia" style="width: 100%;" title="Estrategia">
                    @foreach ($estrategias as $estrategia)
                      <option value="{{ $estrategia->id }}">{{ $estrategia->estrategia }}</option>
                    @endforeach
                  </select>
                </div>
                @if ($errors->has('id_estrategia'))
                    <span class="help-block">
                        <strong>{{ $errors->first('id_estrategia') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            
          </div>

          <hr>

          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="form-group {{ $errors->has('pagina_web') ? ' has-error' : '' }}">
                <label for="pagina_web" class="control-label">Página web</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                  <input type="text" class="form-control minusculas" placeholder="http://..." name="pagina_web" id="pagina_web" value="{{ old('pagina_web') }}">
                </div>
              </div>
              @if ($errors->has('pagina_web'))
                  <span class="help-block">
                      <strong>{{ $errors->first('pagina_web') }}</strong>
                  </span>
              @endif
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group {{ $errors->has('logo') ? ' has-error' : '' }}">
                <label for="logo" class="control-label">Logo (max: 300kb)</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                  <input type="file" class="form-control minusculas" placeholder="http://..." name="logo" id="logo">
                </div>
              </div>
              @if ($errors->has('logo'))
                  <span class="help-block">
                      <strong>{{ $errors->first('logo') }}</strong>
                  </span>
              @endif
            </div>

            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
              <div class="form-group {{ $errors->has('carpeta') ? ' has-error' : '' }}">
                <label for="carpeta" class="control-label">Carpeta</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-folder-open"></i></span>
                  <input type="text" class="form-control" placeholder="http://... Google Drive ..." name="carpeta" id="carpeta" value="{{ old('carpeta') }}" title="Carpeta de Google Drive">
                </div>
              </div>
              @if ($errors->has('carpeta'))
                  <span class="help-block">
                      <strong>{{ $errors->first('carpeta') }}</strong>
                  </span>
              @endif
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group has-feedback">
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

          <hr>

          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <label for="comentarios">Comentarios</label>
              <textarea name="comentarios" id="editor1" class="form-control" style="width: 100%; height: 600px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('comentarios') }}</textarea>
            </div>
          </div>

          <hr>

          <div class="form-group pull-right">
            <input name="_token" value="{{ csrf_token() }}" type="hidden">
            <input type="hidden" value="{{ Auth::user()->id }}" name="id_admin" id="id_admin">
            <a href="{{ route('clientes.index') }}" type="button" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Regresar
            </a>
            <button type="submit" class="btn btn-azul">Guardar <i class="glyphicon glyphicon-floppy-disk"></i></button>
          </div>

          @include('admin.clientes.estrategia-crear')
        </form>

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
<script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script><!-- Page script -->
<!-- Toastr -->
<script src="{{ asset('admin/js/toastr.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- CK Editor -->
<script src="{{ asset('admin/js/ckeditor/ckeditor.js') }}"></script>
<script>
  $('#liClientes').addClass("treeview active");
  $('#subClientes').addClass("active");
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