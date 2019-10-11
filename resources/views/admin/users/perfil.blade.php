@extends('admin.layouts.app')
@section('title')
<title>Emporio Legal | Perfil de Usuarios</title>
@endsection
@section('styles')
@endsection
@section('main-content')
<div class="content">
    <div class="page-header-fixed" id="header"></div>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.emporio') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><i class="fas fa-user"></i> {{ Auth::user()->iniciales }}</li>
    </ol>
    <h1 class="page-header">Perfil de: {{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</h1>
    <hr>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @if(count($errors))
                @foreach($errors->all() as $error)
                    <span class="text-danger">{{ $error }}</span>
                @endforeach
            @endif
        </div>
    </div>
    <br>
    <div class="row">  
        <form action="{{ route('usuarios.upload',Auth::user()->id) }}" enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <img src="{{ asset('images/users/'.Auth::user()->imagen) }}" alt="Imagen de {{ Auth::user()->usuario }}" height="150">
            </div>
            <br>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="imagen">Cambiar imagen de perfil</label>
                <span class="input-group">
                    <input type="file" name="imagen" class="form-control">
                </span>
                <br>
                <button type="submit" class="btn btn-success"><i class="fas fa-image"></i> Guardar</button>
            </div>
        </form>
    </div>
    <hr>
    <form action="{{ route('admin.perfil_update', Auth::user()->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="form-group">
                    <label>Creado</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" value="{{ Auth::user()->created_at->diffForHumans() }}" class="form-control" disabled style="background-color: white; color:black" data-tooltip="tooltip" title="{{ Auth::user()->created_at->format('d-m-Y') }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="form-group">
                    <label>Última actualización</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" value="{{ Auth::user()->updated_at->diffForHumans() }}" class="form-control" disabled style="background-color: white; color:black" data-tooltip="tooltip" title="{{ Auth::user()->updated_at->format('d-m-Y') }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="form-group {{ $errors->has('usuario') ? ' has-error' : '' }}">
                    <label for="usuario" class="control-label">Usuario de acceso</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                        <input type="text" class="form-control" placeholder="Alias o nombre corto..." name="usuario" id="usuario" value="@if(old('usuario')){{ old('usuario') }}@else{{ Auth::user()->usuario }}@endif">
                    </div>
                    @if ($errors->has('usuario'))
                        <span class="help-block">
                            <strong>{{ $errors->first('usuario') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label">Contraseña Nueva *</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input type="text" class="form-control" placeholder="Contraseña..." name="password" id="password">
                    </div>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password_confirmation" class="control-label">Confirmar Contraseña *</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input type="text" class="form-control" placeholder="Contraseña..." name="password_confirmation" id="password_confirmation">
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="telefono" class="control-label">Teléfono</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <input type="text" class="form-control centered" name="telefono" id="telefono" value="@if(old('telefono')){{ old('telefono') }}@else{{ Auth::user()->telefono }}@endif" data-inputmask='"mask": "(###) ###-####"' data-mask>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="oficina" class="control-label">Teléfono de Oficina</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <input type="text" class="form-control centered" name="oficina" id="oficina" value="@if(old('oficina')){{ old('oficina') }}@else{{ Auth::user()->oficina }}@endif" data-inputmask='"mask": "(###) ###-####"' data-mask>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="celular" class="control-label">Celular</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fas fa-mobile-alt"></i></span>
                        <input type="text" class="form-control centered" 
                        name="celular" id="celular" value="@if(old('celular')){{ old('celular') }}@else{{ Auth::user()->celular }}@endif" data-inputmask='"mask": "(###) ###-####"' data-mask>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <span class="fas fa-save"></span> Actualizar
            </button>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<!-- InputMask -->
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
<script>
    
    //Data Mask
    $("[data-mask]").inputmask();
</script>
<script>
    // $('#liUsuarios').addClass("treeview active");
    // $('#liAdmin').addClass("active");
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