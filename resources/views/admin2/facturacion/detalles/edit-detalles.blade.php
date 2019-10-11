<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-editar-detalles-{{ $detalle->id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
        </button>
        <h4 class="modal-title" style="color: white;">Editar detalle de factura</h4>
      </div>
      {{ Form::Open(array('action'=>array('FacturasController@editar_detalles', $detalle->id), 'method'=>'put')) }}
        {{ csrf_field() }}
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <h4>{{ $detalle->clave }} {{ $detalle->servicio }} - {{ $detalle->marca }} {{ $detalle->clase }}</h4>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="created_at" class="control-label">Fecha Agregado</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="created_at" name="created_at" class="form-control" value="{{ Carbon\Carbon::parse($detalle->created_at)->format('d/m/Y') }}" disabled data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($detalle->created_at)->diffForHumans() }}">
                </div>
              </div>                
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="updated_at" class="control-label">Último cambio</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="updated_at" name="updated_at" class="form-control" value="{{ Carbon\Carbon::parse($detalle->updated_at)->format('d/m/Y') }}" disabled data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($detalle->updated_at)->diffForHumans() }}">
                </div>
              </div>                
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <label class="control-label">Monto</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                    <input type="number" class="form-control" name="monto_nuevo" style="text-align: center" value="{{ $detalle->monto }}" title="Monto pendiente por facturar: {{ ($detalle->costo - $detalle->facturado) }}" data-tooltip="tooltip" max="{{ ($detalle->costo - $detalle->facturado + $detalle->monto) }}" min="1">
                </div>
                <input type="hidden" style="color:black" name="monto_anterior" value="{{ $detalle->monto }}">
                <input type="hidden" style="color:black" name="facturado" value="{{ $detalle->facturado }}">
                <input type="hidden" style="color:black" name="monto_total" value="{{ ($detalle->costo - $detalle->facturado + $detalle->monto) }}">
              </div>                
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <input name="_token" value="{{ csrf_token() }}" type="hidden">
          <input type="hidden" style="color:black" name="id_servicio" value="{{ $detalle->id_servicio }}">
          <input type="hidden" style="color:black" name="id_factura" value="{{ $detalle->id_factura }}">
          <input type="hidden" style="color:black" name="subtotal" value="{{ $detalle->subtotal }}">
          <input type="hidden" style="color:black" name="porcentaje_iva"  value="{{ $detalle->porcentaje_iva }}">
          <input type="hidden" style="color:black" name="pagado"  value="{{ $detalle->pagado }}">
          <button type="button" class="btn btn-gris" data-dismiss="modal">
            Cerrar <span class="glyphicon glyphicon-remove"></span>
          </button>
          <button type="submit" class="btn btn-azul">Guardar <i class="glyphicon glyphicon-floppy-disk"></i></button>
        </div>
      {{ Form::Close() }}
    </div>
  </div>
</div>