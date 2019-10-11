<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="estatus-{{ $bitacora->id }}">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #FE9800">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
        </button>
        <h4 class="modal-title" style="color: white;">Editar {{ $bitacora->marca }}</h4>
      </div>
      <form role="form" action="{{ route('registro-marcas.estatus', $bitacora->id) }}" method="post">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                <label for="fecha_vencimiento" class="control-label">Fecha de Vencimiento</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-calendar"></i></span>
                    @if($bitacora->fecha_vencimiento == null)
                      <input type="text" name="fecha_vencimiento" class="form-control datepicker" value="{{ Carbon\Carbon::parse($bitacora->fecha_inicio)->addDays(3660)->format('Y-m-d') }}" title="Fecha de vencimiento calculada a 10 años" data-tooltip="tooltip" autocomplete="off">
                    @else
                      <input type="text" name="fecha_vencimiento" class="form-control datepicker" value="{{ $bitacora->fecha_vencimiento }}" disabled>
                    @endif
                </div>
              </div> 
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <input name="_token" value="{{ csrf_token() }}" type="hidden">
          <input type="hidden" value="{{ $bitacora->fecha_inicio }}" name="fecha_inicio">
          <button type="button" class="btn btn-gris" data-dismiss="modal">
            Cerrar <span class="glyphicon glyphicon-remove"></span>
          </button>
          <button type="submit" class="btn btn-azul">Guardar <i class="glyphicon glyphicon-floppy-disk"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>