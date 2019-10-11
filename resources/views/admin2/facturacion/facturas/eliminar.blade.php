<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-eliminar-detalles-{{ $det->id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #E30000">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
        </button>
        <h4 class="modal-title" style="color: white;">Eliminar detalle de factura</h4>
      </div>
      <form role="form" action="{{ route('facturas.eliminar-detalle', $det->id) }}" method="post">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <h4>{{ $det->clave }} {{ $det->servicio }} - {{ $det->marca }} {{ $det->clase }}</h4>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="created_at" class="control-label">Fecha Agregado</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="created_at" name="created_at" class="form-control" value="{{ Carbon\Carbon::parse($det->creado)->format('d/m/Y') }}" disabled data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($det->creado)->diffForHumans() }}">
                </div>
              </div>                
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="updated_at" class="control-label">Último cambio</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="updated_at" name="updated_at" class="form-control" value="{{ Carbon\Carbon::parse($det->updated_at)->format('d/m/Y') }}" disabled data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($det->updated_at)->diffForHumans() }}">
                </div>
              </div>                
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <label class="control-label">Monto</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-money-bill-alt"></i></span>
                    <input type="text" class="form-control" style="text-align: center" value="$ {{number_format($det->monto,2)}}" disabled>
                </div>
                <input type="hidden" style="color:black" id="monto_eliminar" name="monto_eliminar" value="{{ $det->monto }}">
                <input type="hidden" style="color:black" id="facturado_eliminar" name="facturado_eliminar" value="{{ ($det->facturado - $det->monto) }}">
              </div>                
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <input name="_token" value="{{ csrf_token() }}" type="hidden">
          <input type="hidden" style="color:black" name="id_servicio_eliminar" value="{{ $det->id_servicio }}">
          <input type="hidden" style="color:black" name="id_detalle_eliminar" value="{{ $det->id }}">
          <input type="hidden" style="color:black" name="subtotal_eliminar"  value="{{ $factura->subtotal - $det->monto }}">
          <input type="hidden" style="color:black" name="id_factura"  value="{{ $det->id_factura }}">
          <input type="hidden" style="color:black" name="porcentaje_iva_eliminar"  value="{{ $factura->porcentaje_iva }}">
          <input type="hidden" style="color:black" name="pagado_eliminar"  value="{{ $factura->pagado }}">
          <button type="button" class="btn btn-gris" data-dismiss="modal">
            Cerrar <span class="glyphicon glyphicon-remove"></span>
          </button>
          <button type="submit" class="btn btn-danger">Eliminar <i class="glyphicon glyphicon-trash"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>