<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="factura-agregar">
	<form role="form" method="post" action="{{ route('facturas.store') }}" target="_blank">
	{{ csrf_field() }}
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Agregar Factura</h4>
				</div>
				<div class="modal-body">
					
					<div class="row">
					    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					      <div class="form-group {{ $errors->has('id_cliente') ? ' has-error' : '' }}">
					        <label for="id_cliente" class="control-label">Cliente <b style="color:red">*</b></label>
					        <div class="input-group">
					            <span class="input-group-addon"><i class="fas fa-trophy"></i></span>
					            <select class="form-control selectpicker" data-live-search="true" disabled>
					              <option value="{{ $servicio->id_cliente }}">{{ $servicio->nombre_comercial }}</option>
					            </select>
					            <input type="hidden" value="{{ $servicio->id_cliente }}" name="id_cliente" id="id_cliente">
					        </div>
					      </div>                
					    </div>

					    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					      <div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
					        <label for="fecha" class="control-label">Fecha <b style="color:red">*</b></label>
					        <div class="input-group">
					            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					            <input type="text" id="fecha" name="fecha" class="form-control datepicker">
					        </div>
					        @if ($errors->has('fecha'))
					            <span class="help-block">
					                <strong>{{ $errors->first('fecha') }}</strong>
					            </span>
					        @endif
					      </div>                
					    </div>


					</div>
					<div class="row">

					    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
					      <div class="form-group {{ $errors->has('folio_factura') ? ' has-error' : '' }}">
					        <label for="folio_factura" class="control-label">Folio de Factura <b style="color:red">*</b></label>
					        <div class="input-group">
					            <span class="input-group-addon"><i class="far fa-file-pdf"></i></span>
					            <input type="text" class="form-control" name="folio_factura" value="{{ old('folio_factura') }}">
					        </div>
					        @if ($errors->has('folio_factura'))
					            <span class="help-block">
					                <strong>{{ $errors->first('folio_factura') }}</strong>
					            </span>
					        @endif
					      </div>
					    </div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label for="comentarios">Comentarios</label>
							<textarea name="comentarios" id="comentarios" rows="3" class="form-control"></textarea>
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<input type="hidden" value="{{ Auth::user()->id }}" name="id_admin">
					<input type="hidden" name="monto" value="0">
					<input type="hidden" value="{{ $porcentaje_iva->porcentaje_iva }}" name="porcentaje_iva">
					<button type="submit" class="btn btn-azul btn-flat" onclick="javascript:window.location.reload();">
						<span class="glyphicon glyphicon-floppy-disk"></span> Agregar
					</button>
					<button type="button" class="btn btn-default btn-flat" onclick="javascript:window.location.reload();"><span class="fas fa-sync-alt"></span> Actualizar y Cerrar</button>
					
				</div>
			</div>
		</div>
	</form>
</div>