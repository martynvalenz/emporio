@extends('emporium.app')

@section('title')
<title>Emporio Legal | Datos Fiscales</title>
@endsection

@section('styles')
    <!-- Bootstrap Spinner Css -->
    <link href="{{ asset('emporio/plugins/jquery-spinner/css/bootstrap-spinner.css') }}" rel="stylesheet">

    <!-- Bootstrap Tagsinput Css -->
    <link href="{{ asset('emporio/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{ asset('emporio/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

    <!-- noUISlider Css -->
    <link href="{{ asset('emporio/plugins/nouislider/nouislider.min.css') }}" rel="stylesheet" />
      <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('emporio/css/toastr.css') }}">

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
  <div class="block-header">
      <h2>Datos Fiscales</h2>
  </div>
  <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="header">
          <h2>
            
          </h2>
          <ul class="header-dropdown m-r--5">
              <li class="dropdown">
                  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      <i class="material-icons">more_vert</i>
                  </a>
                  <ul class="dropdown-menu pull-right">
                      <li><a href="javascript:void(0);">Action</a></li>
                      <li><a href="javascript:void(0);">Another action</a></li>
                      <li><a href="javascript:void(0);">Something else here</a></li>
                  </ul>
              </li>
          </ul>
        </div>
        <div class="body">
          <img src="{{ asset('images/ico/logo-full.png') }}" alt="logo">

          <hr>   
            {{ Form::Open(array('action'=>array('EmporioController@update', $emporio->id), 'method'=>'put')) }}
              <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <div class="form-group {{ $errors->has('nombre_comercial') ? ' has-error' : '' }}">
                    <div class="input-group">
                        <span class="input-group-addon">
                           <i class="material-icons">account_balance</i>
                        </span>
                        
                        <div class="form-line">
                            <input type="text" placeholder="Nombre comercial" class="form-control" name="nombre_comercial" value="@if(old('nombre_comercial')){{ old('nombre_comercial') }}@else{{ $emporio->nombre_comercial }}@endif">
                        </div>
                        @if ($errors->has('nombre_comercial'))
                            <span class="help-block col-pink">
                                <strong>{{ $errors->first('nombre_comercial') }}</strong>
                            </span>
                        @endif
                    </div>
                  </div>
                </div>
              </div>

              <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <div class="form-group {{ $errors->has('nombre_comercial') ? ' has-error' : '' }}">
                    <div class="input-group">
                        <span class="input-group-addon">
                           <i class="material-icons">account_balance</i>
                        </span>
                        
                        <div class="form-line">
                            <input type="text" placeholder="Nombre comercial" class="form-control" name="nombre_comercial" value="@if(old('nombre_comercial')){{ old('nombre_comercial') }}@else{{ $emporio->nombre_comercial }}@endif">
                        </div>
                        @if ($errors->has('nombre_comercial'))
                            <span class="help-block col-pink">
                                <strong>{{ $errors->first('nombre_comercial') }}</strong>
                            </span>
                        @endif
                    </div>
                  </div>
                </div>
              </div>

              <input name="_token" value="{{ csrf_token() }}" type="hidden">
              <a href="{{ route('admin.emporio') }}" type="button" class="btn btn-warning waves-effect"><i class="material-icons">backspace</i> Regresar
              </a>
              <button type="submit" class="btn btn-primary waves-effect">Guardar  <i class="material-icons">save</i></button>
            
            {{ Form::Close() }}
            </div>   
        </div>
      </div>
    </div>
  </div>
@endsection




@section('scripts')
<!-- Select Plugin Js -->
    <script src="{{ asset('emporio/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
<!-- Dropzone Plugin Js -->
    <script src="{{ asset('emporio/plugins/dropzone/dropzone.js') }}"></script>

    <!-- Input Mask Plugin Js -->
    <script src="{{ asset('emporio/plugins/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script>

    <!-- Multi Select Plugin Js -->
    <script src="{{ asset('emporio/plugins/multi-select/js/jquery.multi-select.js') }}"></script>

    <!-- Jquery Spinner Plugin Js -->
    <script src="{{ asset('emporio/plugins/jquery-spinner/js/jquery.spinner.js') }}"></script>

    <!-- Bootstrap Tags Input Plugin Js -->
    <script src="{{ asset('emporio/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>

    <!-- noUISlider Plugin Js -->
    <script src="{{ asset('emporio/plugins/nouislider/nouislider.js') }}"></script>

<!-- Toastr -->
<script src="{{ asset('emporio/js/toastr.js') }}"></script>
<script>
  $('#liAjustes').addClass("treeview active");
  $('#liFiscal').addClass("active");
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