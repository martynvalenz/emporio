@extends('admin.app')

@section('title')
<title>Emporio Legal | Editar Servicio</title>
@endsection

@section('styles')
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
      <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
    <!-- Chosen select -->
    <link rel="stylesheet" href="{{ asset('css/chosen.min.css') }}">

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
      Editar Servicio
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
      <li><a href="{{ route('procesos.index') }}">Control de Servicios</a></li>
      <li class="active">Editar</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="box box-default">
      <div class="box-header with-border">
        
      </div>

      <div class="box-body">     

        <form role="form" action="{{ route('procesos.update', $servicio->id) }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('PUT') }}

          <div class="form-group pull-right">
            <a href="{{ route('procesos.index') }}" type="button" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Regresar al Control de Servicios
            </a>
            <button type="submit" class="btn btn-azul">Guardar y asignar Comisiones <i class="glyphicon glyphicon-floppy-disk"></i></button>
          </div>
          
          <div class="row">
              <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group {{ $errors->has('id_cliente') ? ' has-error' : '' }}">
                  <label for="id_cliente" class="control-label">Seleccionar Cliente <b style="color:red">*</b></label>
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fas fa-trophy"></i></span>
                      <select class="form-control selectpicker" name="id_cliente" id="id_cliente" data-live-search="true">
                        <option value="">Sin selección</option>
                        @foreach ($clientes as $cliente)
                           @if ($cliente->id == $servicio->id_cliente)
                             <option value="{{ $cliente->id }}" selected>{{ $cliente->nombre_comercial }}</option>
                           @else
                             <option value="{{ $cliente->id }}">{{ $cliente->nombre_comercial }}</option>
                           @endif
                         @endforeach
                      </select>
                  </div>
                  @if ($errors->has('id_cliente'))
                      <span class="help-block">
                          <strong>{{ $errors->first('id_cliente') }}</strong>
                      </span>
                  @endif
                </div>                
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group {{ $errors->has('tramite') ? ' has-error' : '' }}">
                  <label for="tramite" class="control-label">Descripción del Servicio</label>
                  <div class="input-group">
                      <span class="input-group-addon"><i class="far fa-comment-alt"></i></span>
                      <input type="text" class="form-control" name="tramite" value="@if(old('tramite')){{ old('tramite') }}@else{{ $servicio->tramite }}@endif">
                  </div>
                  @if ($errors->has('tramite'))
                      <span class="help-block">
                          <strong>{{ $errors->first('tramite') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="form-group {{ $errors->has('id_control') ? ' has-error' : '' }}">
                  <label for="id_control" class="control-label">Trámite, Marca, Obra o Patente</label>
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-registered"></i></span>
                      <select class="form-control" name="id_control" id="id_control" data-live-search="true">
                        <option value="">-Sin selección-</option>
                        @foreach ($controles as $control)
                           @if ($control->id == $servicio->id_control)
                             <option value="{{ $control->id }}" selected>{{ $control->nombre }}</option>
                           @else
                             <option value="{{ $control->id }}">{{ $control->nombre }}</option>
                           @endif
                         @endforeach
                      </select>
                      <div class="input-group-btn">  
                        <a type="button" class="btn btn-info btn-flat" id="btn-marca" data-tooltip="tooltip" title="Agregar marca" onclick="event.preventDefault();" data-toggle="modal" data-target="#agregar-marca"><i class="glyphicon glyphicon-plus"></i></a>
                        <!-- Modal para agregar marca -->
                      </div>
                  </div>
                  @if ($errors->has('id_control'))
                      <span class="help-block">
                          <strong>{{ $errors->first('id_control') }}</strong>
                      </span>
                  @endif
                </div>                
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="form-group {{ $errors->has('clase') ? ' has-error' : '' }}">
                  <label for="clase" class="control-label">Clase</label>
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
                      <select class="form-control" name="clase">
                        <option value="">Sin selección</option>
                        @foreach ($clases as $clase)
                           @if ($clase->clave == $servicio->clase)
                             <option value="{{ $clase->clave }}" title="{{ $clase->clase }}" data-tooltip="tooltip" selected>{{ $clase->clave }}</option>
                           @else
                             <option value="{{ $clase->clave }}" title="{{ $clase->clase }}" data-tooltip="tooltip">{{ $clase->clave }}</option>
                           @endif
                         @endforeach
                      </select>
                  </div>
                  @if ($errors->has('clase'))
                      <span class="help-block">
                          <strong>{{ $errors->first('clase') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group {{ $errors->has('id_catalogo_servicio') ? ' has-error' : '' }}">
                  <label for="id_catalogo_servicio" class="control-label">Seleccionar Servicio <b style="color:red">*</b></label>
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-suitcase"></i></span>
                      <select class="form-control" id="id_cat" name="id_catalogo_servicio">
                        <option value="">Sin selección</option>
                        @foreach ($catalogo_servicios as $cat)
                           @if ($cat->id == $servicio->id_catalogo_servicio)
                             <option value="{{ $cat->id }}" selected><b>{{ $cat->clave }}</b> - {{ $cat->servicio }}</option>
                           @else
                             <option value="{{ $cat->id }}_{{ $cat->concepto }}_{{ $cat->moneda }}_{{ $cat->costo }}_{{ $cat->comision_venta }}_{{ $cat->comision_venta_monto }}_{{ $cat->comision_operativa }}_{{ $cat->comision_operativa_monto }}_{{ $cat->comision_gestion }}_{{ $cat->comision_gestion_monto }}_{{ $cat->Monedas->conversion }}_{{ $cat->id_categoria_bitacora }}_{{ $cat->costo_servicio }}"><b>{{ $cat->clave }}</b> - {{ $cat->servicio }}</option>
                           @endif
                         @endforeach
                      </select>
                      <input type="hidden" name="id_catalogo_servicio" id="id_catalogo_servicio" value="@if(old('id_catalogo_servicio')){{ old('id_catalogo_servicio') }}@else{{ $servicio->id_catalogo_servicio }}@endif">
                  </div>
                  @if ($errors->has('id_catalogo_servicio'))
                      <span class="help-block">
                          <strong>{{ $errors->first('id_catalogo_servicio') }}</strong>
                      </span>
                  @endif
                </div>                
              </div>
          </div>
          <hr>

          <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group">
                <label class="control-label">Concepto de costo <b style="color:red">*</b></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                    <select class="form-control" id="concepto_costo" name="concepto_costo">
                      @if ($servicio->concepto_costo=='Neto')
                        <option value="Neto" selected>Neto</option>
                        <option value="Porcentaje">Porcentaje</option>
                        <option value="por Proyecto">por Proyecto</option>
                      @elseif ($servicio->concepto_costo=='Porcentaje')
                         <option value="Neto">Neto</option>
                        <option value="Porcentaje" selected>Porcentaje</option>
                        <option value="por Proyecto">por Proyecto</option>
                      @elseif ($servicio->concepto_costo=='por Proyecto')
                         <option value="Neto">Neto</option>
                        <option value="Porcentaje">Porcentaje</option>
                        <option value="por Proyecto" selected>por Proyecto</option>
                      @endif
                    </select>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group {{ $errors->has('moneda') ? ' has-error' : '' }}">
                <label for="moneda" class="control-label">Moneda <b style="color:red">*</b></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-hand-holding-usd"></i></span>
                    <select class="form-control" id="moneda" disabled>
                      @foreach ($monedas as $moneda)
                         @if ($moneda->clave == $servicio->moneda)
                           <option value="{{ $moneda->clave }}" selected>{{ $moneda->clave }} {{ $moneda->moneda }}</option>
                         @else
                           <option value="{{ $moneda->clave }}">{{ $moneda->clave }} {{ $moneda->moneda }}</option>
                         @endif
                       @endforeach
                    </select>
                    <input type="hidden" name="moneda" id="moneda_val" value="@if(old('moneda')){{ old('moneda') }}@else{{ $servicio->moneda }}@endif">
                </div>
                @if ($errors->has('moneda'))
                    <span class="help-block">
                        <strong>{{ $errors->first('moneda') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group">
                <label class="control-label">Tipo de cambio</label>
                <div class="input-group" title="Conversión de moneda" data-tooltip="tooltip">
                    <span class="input-group-addon"><i class="fas fa-dollar-sign"></i></span>
                    <input type="number" step="any" id="tipo_cambio" name="tipo_cambio" min="1" class="form-control" value="@if(old('tipo_cambio')){{ old('tipo_cambio') }}@else{{ $servicio->tipo_cambio }}@endif" style="text-align: center">
                    <input type="hidden" id="tipo_cambio_anterior" value="@if(old('tipo_cambio')){{ old('tipo_cambio') }}@else{{ $servicio->tipo_cambio }}@endif">
                    <div class="input-group-btn">
                      <button type="button" class="btn btn-warning" id="btn_tipo_cambio" data-tooltip="tooltip" title="Aplicar cambio" onclick="event.preventDefault();"><i class="far fa-money-bill-alt"></i></button>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group">
                <label for="costo_servicio" class="control-label">Costo Emporio</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
                    <input type="number" step="any" id="costo_servicio" name="costo_servicio" class="form-control" title="Costo del servicio" value="@if(old('costo_servicio')){{ old('costo_servicio') }}@else{{ $servicio->costo_servicio }}@endif" style="text-align: center">
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group">
                <label for="costo" class="control-label">Precio del Servicio</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
                    <input type="number" step="any" id="costo_ini" class="form-control" disabled value="@if(old('costo_ini')){{ old('costo_ini') }}@else{{ $servicio->costo_ini }}@endif" style="text-align: center">
                    <input type="hidden" id="costo_ini_val" name="costo_ini" class="form-control" value="@if(old('costo_ini')){{ old('costo_ini') }}@else{{ $servicio->costo_ini }}@endif">
                </div>
              </div>
            </div>
          </div> 
          <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
              <div class="form-group {{ $errors->has('id_bitacoras') ? ' has-error' : '' }}">
                <label for="id_bitacoras" class="control-label">Bitácora <b style="color:red">*</b></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-book"></i></span>
                    <select class="form-control" name="id_bitacoras" id="id_bitacoras">
                      @foreach ($bitacoras as $bitacora)
                         @if ($bitacora->id == $servicio->id_bitacoras)
                           <option value="{{ $bitacora->id }}" selected>{{ $bitacora->clave }} - {{ $bitacora->bitacora }}</option>
                         @else
                           <option value="{{ $bitacora->id }}">{{ $bitacora->clave }} - {{ $bitacora->bitacora }}</option>
                         @endif
                       @endforeach

                    </select>
                </div>
                @if ($errors->has('id_bitacoras'))
                    <span class="help-block">
                        <strong>{{ $errors->first('id_bitacoras') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
              <div class="form-group {{ $errors->has('id_admin') ? ' has-error' : '' }}">
                <label for="id_admin" class="control-label">Responsable</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-user"></i></span>
                    <select class="form-control" name="id_admin" id="id_admin">
                      @foreach($admins as $admin)
                          @if ($admin->id == $servicio->id_admin)
                            <option value="{{ $admin->id }}" selected>{{ $admin->iniciales }} - {{ $admin->nombre }} {{ $admin->apellido }}</option>
                          @else
                            <option value="{{ $admin->id }}">{{ $admin->iniciales }} - {{ $admin->nombre }} {{ $admin->apellido }}</option>
                          @endif
                      @endforeach
                    </select>
                </div>
                @if ($errors->has('id_admin'))
                    <span class="help-block">
                        <strong>{{ $errors->first('id_admin') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group {{ $errors->has('porcentaje_descuento') ? ' has-error' : '' }}">
                <label for="porcentaje_descuento" class="control-label">%Descuento</label>
                <div class="input-group">
                  <span class="input-group-addon"><i>%</i></span>
                  <input type="number" step="any" max="100" min="0" name="porcentaje_descuento" id="porcentaje_descuento" class="form-control" style="text-align: center" value="@if(old('porcentaje_descuento')){{ old('porcentaje_descuento') }}@else{{ $servicio->porcentaje_descuento }}@endif" style="text-align: center">
                  <div class="input-group-btn">  
                    <button type="button" class="btn btn-warning" id="btn_porcentaje_descuento" data-tooltip="tooltip" title="Aplicar el descuento" onclick="event.preventDefault();"><i class="glyphicon glyphicon-refresh"></i></button>
                  </div>
                </div>
                @if ($errors->has('porcentaje_descuento'))
                    <span class="help-block">
                        <strong>{{ $errors->first('porcentaje_descuento') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group {{ $errors->has('descuento') ? ' has-error' : '' }}">
                <label for="descuento" class="control-label">Descuento</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
                  <input type="number" step="any" name="descuento" id="descuento" class="form-control" value="@if(old('descuento')){{ old('descuento') }}@else{{ $servicio->descuento }}@endif" style="text-align: center">
                  <div class="input-group-btn">  
                    <button type="button" class="btn btn-warning" id="btn_descuento" data-tooltip="tooltip" title="Aplicar el descuento" onclick="event.preventDefault();"><i class="glyphicon glyphicon-refresh"></i></button>
                  </div>
                </div>
                @if ($errors->has('descuento'))
                    <span class="help-block">
                        <strong>{{ $errors->first('descuento') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group {{ $errors->has('costo') ? ' has-error' : '' }}">
                <label for="costo" class="control-label">Precio sin IVA <b style="color:red">*</b></label>
                <div class="input-group">
                  <span class="input-group-addon" style="background-color: green"><i style="color:white" class="far fa-money-bill-alt"></i></span>
                  <input type="number" step="any" name="costo" id="costo" class="form-control" value="@if(old('costo')){{ old('costo') }}@else{{ $servicio->costo }}@endif" style="text-align: center">
                  <input type="hidden" id="costo_final" class="form-control" value="@if(old('costo')){{ old('costo') }}@else{{ $servicio->costo }}@endif">
                  <div class="input-group-btn">  
                    <button type="button" class="btn btn-warning" id="bt_actualizar" data-tooltip="tooltip" title="Actualizar montos de comisiones" onclick="event.preventDefault();"><i class="glyphicon glyphicon-refresh"></i></button>
                  </div>
                </div>
                @if ($errors->has('costo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('costo') }}</strong>
                    </span>
                @endif
              </div>
            </div>
          </div>
          <hr> 
          
          <div class="row">
            <div class="col-lg-12">
              <h2>Comisiones</h2>
              <br>
            </div>
          </div>
          <div class="row">

            <!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group {{ $errors->has('responsable_venta') ? ' has-error' : '' }}">
                <label for="responsable_venta" class="control-label">Responsable de Venta</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <select class="form-control" name="responsable_venta">
                      <option value=""></option>
                      @foreach($admins as $admin)
                          @if ($admin->id == $servicio->responsable_venta)
                            <option value="{{ $admin->id }}" selected>{{ $admin->iniciales }} - {{ $admin->nombre }} {{ $admin->apellido }}</option>
                          @else
                            <option value="{{ $admin->id }}">{{ $admin->iniciales }} - {{ $admin->nombre }} {{ $admin->apellido }}</option>
                          @endif
                      @endforeach
                    </select>
                </div>
                @if ($errors->has('responsable_venta'))
                    <span class="help-block">
                        <strong>{{ $errors->first('responsable_venta') }}</strong>
                    </span>
                @endif
              </div>
            </div>-->
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group">
                <label class="control-label">Concepto de costo</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" id="concepto_venta" value="@if(old('concepto_venta')){{ old('concepto_venta') }}@else{{ $servicio->concepto_venta }}@endif" disabled>
                    <input type="hidden" id="concepto_venta_val" name="concepto_venta" value="@if(old('concepto_venta')){{ old('concepto_venta') }}@else{{ $servicio->concepto_venta }}@endif">
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
              <div class="form-group {{ $errors->has('comision_venta') ? ' has-error' : '' }}">
                <label for="comision_venta" class="control-label">Comisión de Venta</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
                    <input type="number" id="comision_venta" class="form-control" disabled value="@if(old('comision_venta')){{ old('comision_venta') }}@else{{ $servicio->comision_venta }}@endif">
                    <input type="hidden" name="comision_venta" id="comision_venta_val" value="@if(old('comision_venta')){{ old('comision_venta') }}@else{{ $servicio->comision_venta }}@endif">
                </div>
                @if ($errors->has('comision_venta'))
                    <span class="help-block">
                        <strong>{{ $errors->first('comision_venta') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
              <div class="form-group">
                  <label for="aplica_comision_venta">¿Aplica comisión?</label>
                  <div class="checkbox">
                    <label>
                      <input class="" type="checkbox" name="aplica_comision_venta"
                      @if ($servicio->aplica_comision_venta == 1)
                        checked
                      @else
                        unchecked
                      @endif
                      > Aplica
                    </label>
                  </div>
              </div>
            </div>
          </div>

          <div class="row">

            <!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group {{ $errors->has('responsable_operativo') ? ' has-error' : '' }}">
                <label for="responsable_operativo" class="control-label">Responsable Operativo</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <select class="form-control" name="responsable_operativo">
                      <option value=""></option>
                      @foreach($admins as $admin)
                          @if ($admin->id == $servicio->responsable_operativo)
                            <option value="{{ $admin->id }}" selected>{{ $admin->iniciales }} - {{ $admin->nombre }} {{ $admin->apellido }}</option>
                          @else
                            <option value="{{ $admin->id }}">{{ $admin->iniciales }} - {{ $admin->nombre }} {{ $admin->apellido }}</option>
                          @endif
                      @endforeach
                    </select>
                </div>
                @if ($errors->has('responsable_operativo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('responsable_operativo') }}</strong>
                    </span>
                @endif
              </div>
            </div>-->
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group">
                <label class="control-label">Concepto de costo</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" id="concepto_operativo" value="@if(old('concepto_operativo')){{ old('concepto_operativo') }}@else{{ $servicio->concepto_operativo }}@endif" disabled>
                    <input type="hidden" id="concepto_operativo_val" name="concepto_operativo" value="@if(old('concepto_operativo')){{ old('concepto_operativo') }}@else{{ $servicio->concepto_operativo }}@endif">
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
              <div class="form-group {{ $errors->has('comision_operativa') ? ' has-error' : '' }}">
                <label for="comision_operativa" class="control-label">Comisión Operativa</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
                    <input type="number" id="comision_operativa" class="form-control" disabled value="@if(old('comision_operativa')){{ old('comision_operativa') }}@else{{ $servicio->comision_operativa }}@endif">
                    <input type="hidden" name="comision_operativa" id="comision_operativa_val" value="@if(old('comision_operativa')){{ old('comision_operativa') }}@else{{ $servicio->comision_operativa }}@endif">
                </div>
                @if ($errors->has('comision_operativa'))
                    <span class="help-block">
                        <strong>{{ $errors->first('comision_operativa') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
              <div class="form-group">
                  <label for="aplica_comision_operativa">¿Aplica comisión?</label>
                  <div class="checkbox">
                    <label>
                      <input class="" type="checkbox" name="aplica_comision_operativa"
                      @if ($servicio->aplica_comision_operativa == 1)
                        checked
                      @else
                        unchecked
                      @endif
                      > Aplica
                    </label>
                  </div>
              </div>
            </div>
          </div>

          <div class="row">

            <!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group {{ $errors->has('responsable_gestion') ? ' has-error' : '' }}">
                <label for="responsable_gestion" class="control-label">Responsable de Gestión</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <select class="form-control" name="responsable_gestion">
                      <option value=""></option>
                      @foreach($admins as $admin)
                          @if ($admin->id == $servicio->responsable_gestion)
                            <option value="{{ $admin->id }}" selected>{{ $admin->iniciales }} - {{ $admin->nombre }} {{ $admin->apellido }}</option>
                          @else
                            <option value="{{ $admin->id }}">{{ $admin->iniciales }} - {{ $admin->nombre }} {{ $admin->apellido }}</option>
                          @endif
                      @endforeach
                    </select>
                </div>
                @if ($errors->has('responsable_gestion'))
                    <span class="help-block">
                        <strong>{{ $errors->first('responsable_gestion') }}</strong>
                    </span>
                @endif
              </div>
            </div>-->
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group">
                <label class="control-label">Concepto de costo</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" id="concepto_gestion" value="@if(old('concepto_gestion')){{ old('concepto_gestion') }}@else{{ $servicio->concepto_gestion }}@endif" disabled>
                    <input type="hidden" id="concepto_gestion_val" name="concepto_gestion" value="@if(old('concepto_gestion')){{ old('concepto_gestion') }}@else{{ $servicio->concepto_gestion }}@endif">
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
              <div class="form-group {{ $errors->has('comision_gestion') ? ' has-error' : '' }}">
                <label for="comision_gestion" class="control-label">Comisión por Gestión</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
                    <input type="number" id="comision_gestion" class="form-control" disabled value="@if(old('comision_gestion')){{ old('comision_gestion') }}@else{{ $servicio->comision_gestion }}@endif">
                    <input type="hidden" name="comision_gestion" id="comision_gestion_val" value="@if(old('comision_gestion')){{ old('comision_gestion') }}@else{{ $servicio->comision_gestion }}@endif">
                </div>
                @if ($errors->has('comision_gestion'))
                    <span class="help-block">
                        <strong>{{ $errors->first('comision_gestion') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
              <div class="form-group">
                  <label for="aplica_comision_gestion">¿Aplica comisión?</label>
                  <div class="checkbox">
                    <label>
                      <input class="" type="checkbox" name="aplica_comision_gestion"
                      @if ($servicio->aplica_comision_gestion == 1)
                        checked
                      @else
                        unchecked
                      @endif
                      > Activo
                    </label>
                  </div>
              </div>
            </div>
          </div>


          <hr>
          
          <div class="form-group pull-right">
            <input name="_token" value="{{ csrf_token() }}" type="hidden">
            <input name="cobrado" value="{{ $servicio->cobrado }}" type="hidden">
            <input name="tipo" value="Control" type="hidden">
            <input name="cobrado_terminado" value="{{ $servicio->costo - $servicio->cobrado }}" type="hidden">
            <a href="{{ route('procesos.index') }}" type="button" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Regresar
            </a>
            <button type="submit" class="btn btn-azul">Guardar y asignar Comisiones <i class="glyphicon glyphicon-floppy-disk"></i></button>
          </div>
        </form>

      </div>
    </div>
    @include('admin.procesos.marca-agregar')
  </section>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/vue.js') }}"></script>
<script src="{{ asset('js/axios.js') }}"></script>
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
<!-- Chosen Jquery select -->
<script src="{{ asset('js/chosen.jquery.min.js') }}"></script>
<!-- Bootstrap WYSIHTML5 
<script src="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>-->
<!-- CK Editor 
<script src="{{ asset('admin/js/ckeditor/ckeditor.js') }}"></script>-->
<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
<script>
  $('#liServicios').addClass("treeview active");
    $('#subControl_Servicios').addClass("active");
</script>
<script type="text/javascript">
      $(".chosen").chosen();
</script>
<!--<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
  });
</script>-->
<script>
  $(document).ready(function() {
      $('body').tooltip({
          selector: "[data-tooltip=tooltip]",
          container: "body"
      });
  });
</script>
</script>
<script>
  
  $(document).ready(function()
  {
    $("#id_cat").change(mostrarValores);
    //$("#id_bitacoras").change(avance_total_bitacoras);
    $('#bt_actualizar').click(function()
    {
      actualizarValores();
    });

    $('#btn_tipo_cambio').click(function()
    {
      tipo_cambio = $('#tipo_cambio_val').val();
      //console.log(tipo_cambio);
      
      if(tipo_cambio == '')
      {
        toastr.error('El campo tipo de cambio no puede estar vacío');
        $('#tipo_cambio_val').focus();
      }
      else if(tipo_cambio == 0)
      {
        toastr.error('No puede aplicar el tipo de cambio con valor de "cero" ');
        $('#tipo_cambio_val').focus();
      }
      else
      {
        actualizarValores();
        aplicarPorcentajeDescuento();
        //actualizarValores();
      }
      
    });

    $('#btn_porcentaje_descuento').click(function()
    {
      aplicarPorcentajeDescuento();
      //actualizarValores();
      
    });

    $('#btn_descuento').click(function()
    {
      aplicarDescuento();
      //actualizarValores();
    });
  });

  function mostrarValores()
  {
    datosServicio=document.getElementById('id_cat').value.split('_');
    $("#id_catalogo_servicio").val(datosServicio[0]); 
    $("#concepto_costo").val(datosServicio[1]); 
    $("#moneda").val(datosServicio[2]);  
    $("#moneda_val").val(datosServicio[2]);  
    $("#costo_servicio").val(datosServicio[12]); 
    //$("#costo").val(datosServicio[3]);
    $("#id_bitacoras").val(datosServicio[11]); 

    $("#tipo_cambio_anterior").val(datosServicio[10]);  
    $("#tipo_cambio_val").val(datosServicio[10]);  
    concepto= datosServicio[1];

    $("#porcentaje_comision_venta").val(datosServicio[5]);
    $("#porcentaje_comision_operativa").val(datosServicio[7]);
    $("#porcentaje_comision_gestion").val(datosServicio[9]);

    if(concepto == 'Neto')
    {
        tipo_cambio = datosServicio[10];
        costo = datosServicio[3];
        conversion = tipo_cambio * costo;
        $("#costo").val(conversion);
        $("#costo_final").val(conversion);
        $("#costo_ini").val(costo);
        $("#costo_ini_val").val(costo);
    }
    else
    {
        tipo_cambio = datosServicio[10];
        $("#costo_ini").val(concepto),
        conversion= 0;
        $("#costo").val(conversion);
        $("#costo_final").val(conversion);
    }

    //Comisiones Ventas
    $("#concepto_venta").val(datosServicio[4]); 
    $("#concepto_venta_val").val(datosServicio[4]); 
    concepto_venta = datosServicio[4];
    if(concepto_venta == 'Monto Fijo' || concepto_venta == 'Dolares')
    {
      comision_venta = datosServicio[5] * tipo_cambio;
      $("#comision_venta").val(comision_venta); 
      $("#comision_venta_val").val(comision_venta);
    }
    else if((concepto_venta == 'Porcentaje' || concepto_venta == 'Porcentaje Utilidad') && conversion > 0)
    {
      porcentaje = datosServicio[5];
      comision_venta = tipo_cambio * conversion * (porcentaje / 100);
      $("#comision_venta").val(comision_venta); 
      $("#comision_venta_val").val(comision_venta); 
      
    }
    else
    {
      comision_venta = 0;
      $("#comision_venta").val(comision_venta); 
      $("#comision_venta_val").val(comision_venta);
    }

    //Comisiones Operativas
    $("#concepto_operativo").val(datosServicio[6]); 
    $("#concepto_operativo_val").val(datosServicio[6]); 
    concepto_operativo = datosServicio[6];
    if(concepto_operativo == 'Monto Fijo' || concepto_venta == 'Dolares')
    {
      comision_operativa = datosServicio[7] * tipo_cambio;
      $("#comision_operativa").val(comision_operativa); 
      $("#comision_operativa_val").val(comision_operativa); 
    }
    else if((concepto_operativo == 'Porcentaje' || concepto_operativo == 'Porcentaje Utilidad') && conversion > 0)
    {
      porcentaje_operativo = datosServicio[7];
      comision_operativa = tipo_cambio * conversion * (porcentaje_operativo / 100);
      $("#comision_operativa").val(comision_operativa); 
      $("#comision_operativa_val").val(comision_operativa); 
    }
    else
    {
      comision_operativa = 0;
      $("#comision_operativa").val(comision_operativa); 
      $("#comision_operativa_val").val(comision_operativa); 
    }

    //Comisiones Gestion
    $("#concepto_gestion").val(datosServicio[8]); 
    $("#concepto_gestion_val").val(datosServicio[8]); 
    concepto_gestion = datosServicio[8];
    if(concepto_gestion == 'Monto Fijo' || concepto_venta == 'Dolares')
    {
      comision_gestion = datosServicio[9] * tipo_cambio;
      $("#comision_gestion").val(comision_gestion); 
      $("#comision_gestion_val").val(comision_gestion); 
    }
    else if((concepto_gestion == 'Porcentaje' || concepto_gestion == 'Porcentaje Utilidad') && conversion > 0)
    {
      porcentaje_gestion = datosServicio[9];
      comision_gestion = tipo_cambio * conversion * (porcentaje_gestion / 100);
      $("#comision_gestion").val(comision_gestion); 
      $("#comision_gestion_val").val(comision_gestion); 
    }
    else
    {
      comision_gestion = 0;
      $("#comision_gestion").val(comision_gestion); 
      $("#comision_gestion_val").val(comision_gestion); 
    }
    
     
  }

  function aplicarPorcentajeDescuento()
  {
    porcentaje_descuento = $('#porcentaje_descuento').val();
    costo_final = $('#costo_final').val();
    descuento = 0;

    if(costo_final == 0)
    {
      costo = $('#costo').val();
      $('#costo_final').val(costo);
      costo_final = costo;
    }

    if(porcentaje_descuento == '')
    {
      toastr.error('Anote un porcentaje de descuento.');
      $('#porcentaje_descuento').focus(); 
    }
    else if(porcentaje_descuento > 100)
    {
      toastr.error('El porcentaje no puede ser mayor al 100%');
      $('#porcentaje_descuento').focus();
    }
    else if(porcentaje_descuento < 0)
    {
      toastr.error('El porcentaje no puede ser menor a 0%');
      $('#porcentaje_descuento').focus();
    }
    else
    {
      descuento = costo_final * (porcentaje_descuento / 100);
      descuento = Math.round(descuento, 2);
      costo = costo_final - descuento
      $('#descuento').val(descuento);
      $('#costo').val(costo);
    }
  }

  function aplicarDescuento()
  {
    descuento = $('#descuento').val();
    costo_final = $('#costo_final').val();

    if(costo_final == 0)
    {
      costo = $('#costo').val();
      $('#costo_final').val(costo);
      costo_final = costo;
    }
    porcentaje_descuento = 0;

    descuento = descuento * 1;
    costo_final = costo_final * 1;
    
    if(descuento == '')
    {
      costo_final = costo_final - descuento;
      porcentaje_descuento = descuento / (descuento + costo_final) * 100;
      porcentaje_descuento = Math.round(porcentaje_descuento);
      $('#porcentaje_descuento').val(porcentaje_descuento);
      $('#costo').val(costo_final);
    }
    else if(descuento > costo_final)
    {
      toastr.error('El descuento no puede ser mayor al costo del servicio.');
      descuento = 0;
      $('#descuento').val(descuento); 
      $('#costo').val(costo_final); 
      $('#descuento').focus(); 
    }
    else
    {
      costo_final = costo_final - descuento;
      porcentaje_descuento = descuento / (descuento + costo_final) * 100;
      porcentaje_descuento = Math.round(porcentaje_descuento);
      $('#porcentaje_descuento').val(porcentaje_descuento);
      $('#costo').val(costo_final);
    }
  }

  function actualizarValores()
  {
    costo=$('#costo').val();

    if (costo == '')
    {
      toastr.error('El costo no puede estar vacío, anote un valor.');
      $('#costo').focus();
    }
    else if(costo == 0)
    {
      comision_venta = 0;
      $("#comision_venta").val(comision_venta); 
      $("#comision_venta_val").val(comision_venta);

      comision_gestion = 0;
      $("#comision_gestion").val(comision_gestion); 
      $("#comision_gestion_val").val(comision_gestion);

      comision_operativa = 0;
      $("#comision_operativa").val(comision_operativa); 
      $("#comision_operativa_val").val(comision_operativa);
    }
    else
    {
      tipo_cambio = $('#tipo_cambio_val').val();
      tipo_cambio_anterior = $('#tipo_cambio_anterior').val();
      conversion = tipo_cambio * costo / tipo_cambio_anterior;

      //Comisiones Ventas
      concepto_venta = $("#concepto_venta").val();
      if(concepto_venta == 'Monto Fijo' || concepto_venta == 'Dolares')
      {
         comision_venta = $("#comision_venta").val();
         comision_venta = comision_venta * tipo_cambio / tipo_cambio_anterior;
         comision_venta = Math.round(comision_venta);
         $("#comision_venta").val(comision_venta); 
         $("#comision_venta_val").val(comision_venta); 
      }
      else if(concepto_venta == 'Porcentaje' || concepto_venta == 'Porcentaje Utilidad' && conversion > 0)
      {
        porcentaje = $('#porcentaje_comision_venta').val();
        comision_venta = conversion * porcentaje / 100;
        comision_venta = Math.round(comision_venta);
        $("#comision_venta").val(comision_venta); 
        $("#comision_venta_val").val(comision_venta); 
      }
      else
      {
        comision_venta = 0;
        $("#comision_venta").val(comision_venta); 
        $("#comision_venta_val").val(comision_venta); 
      }

      //Comisiones Operativas
      $("#concepto_operativo").val(datosServicio[6]); 
      concepto_operativo = datosServicio[6];
      if(concepto_operativo == 'Monto Fijo' || concepto_operativo == 'Dolares')
      {
        comision_operativa = $("#comision_operativa").val();
        comision_operativa = comision_operativa * tipo_cambio / tipo_cambio_anterior;
        comision_operativa = Math.round(comision_operativa);
        $("#comision_operativa").val(comision_operativa); 
        $("#comision_operativa_val").val(comision_operativa);  
      }
      else if(concepto_operativo == 'Porcentaje' || concepto_operativo == 'Porcentaje Utilidad' && conversion > 0)
      {
        porcentaje_operativo = $('#porcentaje_comision_operativa').val();
        comision_operativa =  conversion * porcentaje_operativo / 100;
        comision_operativa = Math.round(comision_operativa);
        $("#comision_operativa").val(comision_operativa); 
        $("#comision_operativa_val").val(comision_operativa); 
      }
      else
      {
        comision_operativa = 0;
        $("#comision_operativa").val(comision_operativa); 
        $("#comision_operativa_val").val(comision_operativa); 
      }

      //Comisiones Gestion
      $("#concepto_gestion").val(datosServicio[8]); 
      concepto_gestion = datosServicio[8];
      if(concepto_gestion == 'Monto Fijo' || concepto_gestion == 'Dolares')
      {
        comision_gestion = $("#comision_gestion").val();
        comision_gestion = comision_gestion * tipo_cambio / tipo_cambio_anterior;
        comision_gestion = Math.round(comision_gestion);
        $("#comision_gestion").val(comision_gestion); 
        $("#comision_gestion_val").val(comision_gestion); 
      }
      else if(concepto_gestion == 'Porcentaje' || concepto_gestion == 'Porcentaje Utilidad' && conversion > 0)
      {
        porcentaje_gestion = $('#porcentaje_comision_gestion').val();
        comision_gestion = tipo_cambio * conversion * (porcentaje_gestion / 100);
        comision_gestion = Math.round(comision_gestion);
        $("#comision_gestion").val(comision_gestion); 
        $("#comision_gestion_val").val(comision_gestion); 
      }
      else
      {
        comision_gestion = 0;
        $("#comision_gestion").val(comision_gestion); 
        $("#comision_gestion_val").val(comision_gestion); 
      }

      $("#tipo_cambio_anterior").val(tipo_cambio);
      conversion = Math.round(conversion);
      $("#costo").val(conversion); 
      $("#costo_final").val(conversion); 
    }
  }
</script>
<script>
    $.ajaxSetup(
  {
     headers: 
     {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
  });
  $('#id_cliente').on('change', function(e)
  {
      console.log(e);

      var id_cliente = e.target.value;

      //ajax
      $.get('/admin/procesos/marcas/' + id_cliente, function(data)
      {
          console.log(data);

              $('#id_control').empty();
              $('#id_control').append('<option value ="">--Sin selección--</option>');

          $.each(data, function(index, subcatObj)
          {

              $('#id_control').append('<option value ="'+ subcatObj.id +'">'+subcatObj.nombre+'</option>');

          });
      });
  });
</script>
<script>
  $(document).ready(function()
  {
    $("#btn-marca").on('click', function(e)
    {
      cliente = $("#id_cliente").val();
      
      $('input[name=id_cliente_marca]').val(cliente);
    });

    $("#btn-agregar-marca").on('click', function(e)
    {
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

      e.preventDefault(); 

      cliente = $("input[name=id_cliente_marca]").val();
      nombre_marca = $("#nombre_marca").val();

      if(cliente == '')
      {
        toastr.error('Seleccione un cliente para asignarle el trámite, marca, obra o patente.');
        $('#agregar-marca').modal('toggle'); 
        $('#nombre_comercial_agregar').focus();

      }
      else if(nombre_marca == '')
      {
        toastr.error('Anote el nombre comercial, marca, trámite, obra o patente nuevo.');
        $('#nombre_marca').focus();
      }
      else
      {
        Agregar();
      }
    });
  });

  function Agregar()
  {
    var formData = 
    {
      '_token': $('input[name=_token]').val(),
      nombre: $('input[name=nombre_marca]').val(),
      id_admin: $('input[name=id_admin_marca]').val(),
      id_cliente: $('input[name=id_cliente_marca]').val()
    }    

    $.ajax(
    {
        type: 'POST',
        dataType: 'json',
        url: '/admin/procesos/insertar-marca',
        data: formData,
        success: function(data) 
        {
          toastr.success('Se insertó de forma correcta el registro.'); 

          id_cliente = $("#id_cliente").val();      

          //ajax
          $.get('/admin/procesos/marcas/' + id_cliente, function(data)
          {
              console.log(data);

                  $('#id_control').empty();

              $.each(data, function(index, obj)
              {

                  $('#id_control').append('<option value ="'+ obj.id +'">'+obj.nombre+'</option>');

              });
          });

          var nada='';
          $('#nombre_marca').val(nada);
          $('#id_cliente_marca').val(nada);
          $('#agregar-marca').modal('toggle'); 
          
        },
        error: function (data) 
        {
          toastr.error('El nombre comercial o marca de ese cliente ya existe.');
            //console.log('Error:', data);
        }
    });
  }
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