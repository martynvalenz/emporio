<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-editar-{{ $bitacora->id }}">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #FE9800">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
        </button>
        <h4 class="modal-title" style="color: white;">Editar {{ $bitacora->marca }}</h4>
      </div>
      <form role="form" action="{{ route('registro-marcas.update', $bitacora->id) }}" method="post">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="created_at" class="control-label">Fecha Agregado</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="created_at" name="created_at" class="form-control" value="{{ Carbon\Carbon::parse($bitacora->created_at)->format('d/m/Y') }}" disabled data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($bitacora->created_at)->diffForHumans() }}">
                </div>
              </div>                
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="updated_at" class="control-label">Último cambio</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="updated_at" name="updated_at" class="form-control" value="{{ Carbon\Carbon::parse($bitacora->updated_at)->format('d/m/Y') }}" disabled data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($bitacora->updated_at)->diffForHumans() }}">
                </div>
              </div>                
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="id_admin" class="control-label">Agregó</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-user"></i></span>
                    <input type="text" name="id_admin" class="form-control" value="{{ $bitacora->iniciales }} - {{ $bitacora->usuario }} {{ $bitacora->apellido }}" disabled>
                </div>
              </div>                
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="id_cliente" class="control-label">Cliente / Carpeta</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-trophy"></i></span>
                    <input type="text" class="form-control" value="{{ $bitacora->nombre_comercial }}" disabled>
                </div>
              </div> 
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="id_cliente" class="control-label">Marca</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="far fa-registered"></i></span>
                    <input type="text" class="form-control" value="{{ $bitacora->marca }}" disabled>
                </div>
              </div> 
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <label style="text-align: center">Número de Expediente</label>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-btn">
                    <label class="btn btn-info"><i>#</i></label>
                  </span>
                  <input type="text" name="numero_expediente" class="form-control" value="@if(old('numero_expediente')){{ old('numero_expediente') }}@else{{ $bitacora->numero_expediente }}@endif">
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <label style="text-align: center">Número de Registro</label>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-btn">
                    <label class="btn btn-info"><i>#</i></label>
                  </span>
                  <input type="text" name="numero_registro" class="form-control" value="@if(old('numero_registro')){{ old('numero_registro') }}@else{{ $bitacora->numero_registro }}@endif">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="estatus" class="control-label">Estatus</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-tag"></i></span>
                    <select name="estatus" class="form-control">
                      @foreach($listado_estatus as $est)
                        @if($bitacora->estatus == $est->estatus)
                          <option value="{{ $est->estatus }}" selected>{{ $est->estatus }}</option>
                        @else
                          <option value="{{ $est->estatus }}">{{ $est->estatus }}</option>
                        @endif
                      @endforeach
                    </select>
                </div>
              </div> 
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="fecha_inicio" class="control-label">Fecha de Inicio</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-calendar"></i></span>
                    <input type="text" name="fecha_inicio" class="form-control datepicker" value="{{ $bitacora->fecha_inicio }}">
                </div>
              </div> 
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="fecha_vencimiento" class="control-label">Fecha de Vencimiento</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-calendar"></i></span>
                    @if($bitacora->fecha_vencimiento == null)
                      <input type="text" name="fecha_vencimiento" class="form-control datepicker" value="{{ Carbon\Carbon::parse($bitacora->fecha_inicio)->addYears(10)->format('Y-m-d') }}" title="Fecha de vencimiento calculada a 10 años" data-tooltip="tooltip">
                    @else
                      <input type="text" name="fecha_vencimiento" class="form-control datepicker" value="{{ $bitacora->fecha_vencimiento }}">
                    @endif
                </div>
              </div> 
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <textarea name="observaciones" class="form-control" rows="3">@if(old('observaciones')){{ old('observaciones') }}@else{{ $bitacora->observaciones }}@endif</textarea>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <input name="_token" value="{{ csrf_token() }}" type="hidden">
          <button type="button" class="btn btn-gris" data-dismiss="modal">
            Cerrar <span class="glyphicon glyphicon-remove"></span>
          </button>
          <button type="submit" class="btn btn-azul">Guardar <i class="glyphicon glyphicon-floppy-disk"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>