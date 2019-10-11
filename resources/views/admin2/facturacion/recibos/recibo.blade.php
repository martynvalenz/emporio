<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="agregar">
	<form role="form" action="{{ route('recibos.store') }}" method="post" id="agregarForm">
	{{ csrf_field() }}
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Agregar Recibo</h4>
				</div>
				<div class="modal-body">
					
					<div class="row">
					    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					      <div class="form-group {{ $errors->has('id_cliente') ? ' has-error' : '' }}">
					        <label for="id_cliente" class="control-label">Seleccionar Cliente <b style="color:red">*</b></label>
					        <div class="input-group">
					            <span class="input-group-addon"><i class="fas fa-trophy"></i></span>
					            <select class="form-control selectpicker" name="id_cliente" id="id_cliente" data-live-search="true">
					              <option value="">Sin selección</option>
					              @foreach($clientes as $cliente)
					                <option value="{{ $cliente->id }}">{{ $cliente->nombre_comercial }}</option>
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

					    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
					      <div class="form-group {{ $errors->has('folio_recibo') ? ' has-error' : '' }}">
					        <label for="folio_recibo" class="control-label">Folio de Recibo <b style="color:red">*</b></label>
					        <div class="input-group">
					            <span class="input-group-addon"><i class="far fa-file-pdf"></i></span>
					            <input type="text" class="form-control" name="folio_recibo" value="{{ old('folio_recibo') }}">
					        </div>
					        @if ($errors->has('folio_recibo'))
					            <span class="help-block">
					                <strong>{{ $errors->first('folio_recibo') }}</strong>
					            </span>
					        @endif
					      </div>
					    </div>

					    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
					      <div class="form-group">
					        <label for="con_iva" class="control-label">Con IVA?</label>
					        <div class="input-group">
					            <span class="input-group-addon"><i>%</i></span>
					            <select name="con_iva" id="con_iva" class="form-control">
					              <option value="0">No</option>
					              <option value="1">Si</option>
					            </select>
					        </div>
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
					<button type="button" class="btn btn-azul" onclick="event.preventDefault();" id="btn_agregar">
						<span class="glyphicon glyphicon-floppy-disk"></span> Agregar
					</button>
					<button type="button" class="btn btn-gris" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
				</div>
			</div>
		</div>
	</form>
</div>