@extends('admin.layouts.app')
@section('title')
<title>Emporio Legal: Catálogo de Servicios</title>
@endsection
@section('styles')

@endsection
@section('main-content')
<div id="content" class="content">
    <div class="page-header-fixed" id="header"></div>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.emporio') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('servicios.index') }}">Catálogo</a></li>
        <li class="breadcrumb-item active">Editar: {{ $catalogo->clave }}</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Editar Servicio: {{ $catalogo->clave }}</h1>
    <!-- end page-header -->
    <!-- begin row -->
    <hr>

    <form>
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-title">Datos del servicio</div>
            </div>
            <div class="panel-body">
                
                <div class="row">
                    <div class="col-lg-2 col-md-4 col-sm-5 col-xs-12">
                        <div class="form-group">
                            <label for="">Clave <b style="color:red">*</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-hashtag"></i></span>
                                <input type="text" class="form-control centered" id="clave" name="clave" value="{{ $catalogo->clave }}">
                                <div class="invalid-feedback" id="clave_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-8 col-sm-7 col-xs-12">
                        <div class="form-group">
                            <label for="">Servicio <b style="color:red">*</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-suitcase"></i></span>
                                <input type="text" class="form-control" id="servicio" name="servicio" autocomplete="off" value="{{ $catalogo->servicio }}">
                                <div class="invalid-feedback" id="servicio_error"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="">Comentarios</label>
                            <textarea name="comentarios" id="comentarios" rows="3" class="form-control">@if($catalogo->comentarios == 'NULL') @else{{ $catalogo->comentarios }}@endif</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="id_categoria" class="control-label">Categoría <b style="color:red">*</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <select name="id_categoria_servicios" id="id_categoria_servicios" class="form-control">
                                    <option value="">-Sin selección-</option>
                                    @foreach ($categoria_servicios as $servicio)
                                        @if($catalogo->id_categoria_servicios == $servicio->id)
                                            <option value="{{ $servicio->id }}" selected>{{ $servicio->categoria }}</option>
                                        @else
                                            <option value="{{ $servicio->id }}">{{ $servicio->categoria }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" id="id_categoria_servicios_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="id_categoria_bitacora" class="control-label">Bitácora <b style="color:red">*</b></label>
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                            <select name="id_categoria_bitacora" id="id_categoria_bitacora" class="form-control">
                                <option value="">-Sin selección-</option>
                                @foreach ($categoria_bitacoras as $bitacora)
                                    @if($catalogo->id_categoria_bitacora == $bitacora->id)
                                        <option value="{{ $bitacora->id }}" selected>{{ $bitacora->bitacora }} - {{ $bitacora->clave }}</option>
                                    @else
                                        <option value="{{ $bitacora->id }}">{{ $bitacora->bitacora }} - {{ $bitacora->clave }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="id_categoria_bitacora_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="id_categoria_estatus" class="control-label">Bitácora de Estatus</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <select name="id_categoria_estatus" id="id_categoria_estatus" class="form-control">
                                    <option value="">-Sin selección-</option>
                                    @foreach ($categoria_estatus as $estatus)
                                        @if($catalogo->id_categoria_estatus == $estatus->id)
                                            <option value="{{ $estatus->id }}" selected>{{ $estatus->bitacora }} - {{ $estatus->clave }}</option>
                                        @else
                                            <option value="{{ $estatus->id }}">{{ $estatus->bitacora }} - {{ $estatus->clave }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-title">Costos y Comisiones</div>
            </div>
            <div class="panel-body">
                
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="concepto" class="control-label">Concepto de Costo <b style="color:red">*</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <select name="concepto" id="concepto" class="form-control">
                                    @if($catalogo->concepto == 'Neto')
                                        <option value="Neto" selected>Neto</option>
                                        <option value="Porcentaje">Porcentaje</option>
                                        <option value="por Proyecto">por Proyecto</option>
                                    @elseif($catalogo->concepto == 'Porcentaje')
                                        <option value="Neto">Neto</option>
                                        <option value="Porcentaje" selected>Porcentaje</option>
                                        <option value="por Proyecto">por Proyecto</option>
                                    @elseif($catalogo->concepto == 'por Proyecto')
                                        <option value="Neto">Neto</option>
                                        <option value="Porcentaje">Porcentaje</option>
                                        <option value="por Proyecto" selected>por Proyecto</option>
                                    @endif
                                </select>
                                <div class="invalid-feedback" id="concepto_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="moneda" class="control-label">Moneda <b style="color:red">*</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                <select name="moneda" id="moneda" class="form-control">
                                    @foreach ($monedas as $moneda)
                                        @if($catalogo->moneda == $moneda->clave)
                                            <option value="{{ $moneda->clave }}" selected>{{ $moneda->clave }} - {{ $moneda->moneda }}</option>
                                        @else
                                            <option value="{{ $moneda->clave }}">{{ $moneda->clave }} - {{ $moneda->moneda }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" id="moneda_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label for="costo_servicio" class="control-label">Costo Emporio</label>
                            <div class="input-group">
                                <span class="input-group-addon" style="background-color: red; color:white"><i class="far fa-money-bill-alt"></i></span>
                                <input type="number" step="any" class="form-control centered" value="{{ $catalogo->costo_servicio }}" name="costo_servicio" id="costo_servicio" min="0">
                                <div class="invalid-feedback" id="costo_servicio_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label for="costo" class="control-label">Precio al cliente <b style="color:red">*</b></label>
                            <div class="input-group">
                                <span class="input-group-addon" style="background-color: green; color: white"><i class="far fa-money-bill-alt"></i></span>
                                <input type="number" step="any" class="form-control centered" value="{{ $catalogo->costo }}" name="costo" id="costo" min="0">
                                <div class="invalid-feedback" id="costo_error"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                        <div class="form-group">
                            <label for="comision_venta" class="control-label">Comisión de Venta</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-hand-holding-usd"></i></span>
                                <select name="comision_venta" id="comision_venta" class="form-control">
                                    <option value="">-Sin selección-</option>
                                    @if($catalogo->comision_venta == 'Monto Fijo')
                                        <option value="Monto Fijo" selected>Monto Fijo</option>
                                        <option value="Porcentaje">Porcentaje</option>
                                        <option value="Porcentaje Utilidad">Porcentaje Utilidad</option>
                                    @elseif($catalogo->comision_venta == 'Porcentaje')
                                        <option value="Monto Fijo">Monto Fijo</option>
                                        <option value="Porcentaje" selected>Porcentaje</option>
                                        <option value="Porcentaje Utilidad">Porcentaje Utilidad</option>
                                    @elseif($catalogo->comision_venta == 'Porcentaje Utilidad')
                                        <option value="Monto Fijo">Monto Fijo</option>
                                        <option value="Porcentaje">Porcentaje</option>
                                        <option value="Porcentaje Utilidad" selected>Porcentaje Utilidad</option>
                                    @else
                                        <option value="Monto Fijo">Monto Fijo</option>
                                        <option value="Porcentaje">Porcentaje</option>
                                        <option value="Porcentaje Utilidad">Porcentaje Utilidad</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                        <div class="form-group">
                            <label for="comision_venta_monto" class="control-label">Monto por venta</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i id="monto_venta_icon" class="far fa-money-bill-alt"></i></span>
                                <input type="number" class="form-control centered" value="{{ $catalogo->comision_venta_monto }}" name="comision_venta_monto" id="comision_venta_monto" step="any" min="0">
                                <div class="invalid-feedback" id="comision_venta_monto_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                        <div class="form-group">
                            <label for="porcentaje_venta" class="control-label">% Venta</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-percent"></i></span>
                                <input type="number" class="form-control centered" value="{{ $catalogo->porcentaje_venta }}" name="porcentaje_venta" id="porcentaje_venta" step="any" min="0" max="100">
                                <div class="invalid-feedback" id="porcentaje_venta_error"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                        <div class="form-group">
                            <label for="comision_operativa" class="control-label">Comisión Operativa</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-hand-holding-usd"></i></span>
                                <select name="comision_operativa" id="comision_operativa" class="form-control">
                                    <option value="">-Sin selección-</option>
                                    @if($catalogo->comision_operativa == 'Monto Fijo')
                                        <option value="Monto Fijo" selected>Monto Fijo</option>
                                        <option value="Porcentaje">Porcentaje</option>
                                        <option value="Porcentaje Utilidad">Porcentaje Utilidad</option>
                                    @elseif($catalogo->comision_operativa == 'Porcentaje')
                                        <option value="Monto Fijo">Monto Fijo</option>
                                        <option value="Porcentaje" selected>Porcentaje</option>
                                        <option value="Porcentaje Utilidad">Porcentaje Utilidad</option>
                                    @elseif($catalogo->comision_operativa == 'Porcentaje Utilidad')
                                        <option value="Monto Fijo">Monto Fijo</option>
                                        <option value="Porcentaje">Porcentaje</option>
                                        <option value="Porcentaje Utilidad" selected>Porcentaje Utilidad</option>
                                    @else
                                        <option value="Monto Fijo">Monto Fijo</option>
                                        <option value="Porcentaje">Porcentaje</option>
                                        <option value="Porcentaje Utilidad">Porcentaje Utilidad</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                        <div class="form-group">
                            <label for="comision_operativa_monto" class="control-label">Monto operativo</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i id="monto_operativo_icon" class="far fa-money-bill-alt"></i></span>
                                <input type="number" class="form-control centered" value="{{ $catalogo->comision_operativa_monto }}" name="comision_operativa_monto" id="comision_operativa_monto" step="any" min="0">
                                <div class="invalid-feedback" id="comision_operativa_monto_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                        <div class="form-group">
                            <label for="porcentaje_operativa" class="control-label">% Operativo</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-percent"></i></span>
                                <input type="number" class="form-control centered" value="{{ $catalogo->porcentaje_operativa }}" name="porcentaje_operativa" id="porcentaje_operativa" step="any" min="0" max="100">
                                <div class="invalid-feedback" id="porcentaje_operativa_error"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                        <div class="form-group">
                            <label for="comision_gestion" class="control-label">Comisión por Gestión</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-hand-holding-usd"></i></span>
                                <select name="comision_gestion" id="comision_gestion" class="form-control">
                                <option value="">-Sin selección-</option>
                                @if($catalogo->comision_gestion == 'Monto Fijo')
                                    <option value="Monto Fijo" selected>Monto Fijo</option>
                                    <option value="Porcentaje">Porcentaje</option>
                                    <option value="Porcentaje Utilidad">Porcentaje Utilidad</option>
                                @elseif($catalogo->comision_gestion == 'Porcentaje')
                                    <option value="Monto Fijo">Monto Fijo</option>
                                    <option value="Porcentaje" selected>Porcentaje</option>
                                    <option value="Porcentaje Utilidad">Porcentaje Utilidad</option>
                                @elseif($catalogo->comision_gestion == 'Porcentaje Utilidad')
                                    <option value="Monto Fijo">Monto Fijo</option>
                                    <option value="Porcentaje">Porcentaje</option>
                                    <option value="Porcentaje Utilidad" selected>Porcentaje Utilidad</option>
                                @else
                                    <option value="Monto Fijo">Monto Fijo</option>
                                    <option value="Porcentaje">Porcentaje</option>
                                    <option value="Porcentaje Utilidad">Porcentaje Utilidad</option>
                                @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                        <div class="form-group">
                            <label for="comision_gestion_monto" class="control-label">Monto Gestión</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i id="monto_gestion_icon" class="far fa-money-bill-alt"></i></span>
                                <input type="number" class="form-control centered" value="{{ $catalogo->comision_gestion_monto }}" name="comision_gestion_monto" step="any" id="comision_gestion_monto" min="0">
                                <div class="invalid-feedback" id="comision_gestion_monto_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                        <div class="form-group">
                            <label for="porcentaje_gestion" class="control-label">% Gestión</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-percent"></i></span>
                                <input type="number" class="form-control centered" value="{{ $catalogo->porcentaje_gestion }}" name="porcentaje_gestion" id="porcentaje_gestion" step="any" min="0" max="100">
                                <div class="invalid-feedback" id="porcentaje_gestion_error"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
                        <a class="btn btn-success" id="btn-validar" title="Validar y calcular montos y comisiones" data-tooltip="tooltip"><i class="fas fa-calculator"></i> Validar y Calcular</a>
                    </div>
                </div>
                <hr>
                
                <div class="row">

                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label for="honorarios" class="control-label">Honorarios</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
                                <input type="number" step="any" class="form-control centered" value="{{ $catalogo->honorarios }}" name="honorarios" id="honorarios" min="0" disabled>
                                <input type="hidden" id="honorarios_val" name="honorarios_val" value="{{ $catalogo->honorarios }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label for="utilidad" class="control-label">Utilidad</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
                                <input type="number" step="any" class="form-control centered" value="{{ $catalogo->utilidad }}" name="utilidad" id="utilidad" min="0" disabled>
                                <input type="hidden" id="utilidad_val" name="utilidad_val" value="{{ $catalogo->utilidad }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label for="utilidad" class="control-label">% Utilidad</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-percent"></i></span>
                                <input type="number" step="any" class="form-control centered" value="{{ $catalogo->porcentaje_utilidad }}" name="porcentaje_utilidad" id="porcentaje_utilidad" min="0" disabled>
                                <input type="hidden" id="porcentaje_utilidad_val" name="porcentaje_utilidad_val" value="{{ $catalogo->porcentaje_utilidad }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <a href="{{ route('servicios.index') }}" class="btn btn-warning btn-lg"><i class="fas fa-arrow-left"></i> Ir a Catálogo</a>
                <button type="button" class="btn btn-primary btn-lg" id="btn-save" title="Guardar servicio" data-tooltip="tooltip"><i class="fas fa-save"></i> Guardar <!--<i class="fas fa-arrow-right"></i>--></button>
                <input type="hidden" id="id_catalogo_servicio" value="{{ $catalogo->id }}">
                <input type="hidden" id="validar" value="1">
                <input type="hidden" id="select_change" value="0">
            </div>
        </div>
    
    </form>
</div>
@endsection
@section('scripts')
<script src="{{ asset('archivos/catalogo-servicios.js') }}"></script>
<script>
    $('#liServicios').addClass("treeview active");
    $('#liCatalogo').addClass("active");
</script>
@endsection