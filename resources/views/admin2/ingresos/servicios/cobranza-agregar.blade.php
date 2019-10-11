<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="agregar-cobranza">
	<form role="form" action="{{ route('cobranza.store') }}" method="post">
	{{ csrf_field() }}
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Agregar Cobro</h4>
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

					    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					      <div class="form-group {{ $errors->has('id_razon_social') ? ' has-error' : '' }}">
					        <label for="id_razon_social" class="control-label">Seleccionar Razón Social</label>
					        <div class="input-group">
					            <span class="input-group-addon"><i class="fas fa-qrcode"></i></span>
					            <select name="id_razon_social" id="id_razon_social" class="form-control">
					              <option value="">-Seleccionar opción-</option>
					            </select>
					            <div class="input-group-btn">
					              <a class="btn btn-info" title="Agregar nueva razón social" data-tooltip="tooltip" data-toggle="modal" data-target="#agregar_razon" id="btn_agregar_razon"><i class="fa fa-plus"></i></a>
					            </div>
					        </div>
					        @include('admin.ingresos.cobranza.razon')
					        @if ($errors->has('id_razon_social'))
					            <span class="help-block">
					                <strong>{{ $errors->first('id_razon_social') }}</strong>
					            </span>
					        @endif
					      </div>                
					    </div>
					</div>
					<div class="row">
						<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
							<div class="form-group {{ $errors->has('id_cuenta') ? ' has-error' : '' }}">
								<label for="id_cuenta">Cuenta <b style="color:red">*</b></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-piggy-bank"></i></span>
									<select name="id_cuenta" id="id_cuenta" class="form-control">
										@foreach($cuentas as $cuenta)
											<option value="{{ $cuenta->id }}">{{ $cuenta->tipo }} {{ $cuenta->alias	 }}</option>
										@endforeach
									</select>
								</div>
								@if ($errors->has('id_cuenta'))
								    <span class="help-block">
								        <strong>{{ $errors->first('id_cuenta') }}</strong>
								    </span>
								@endif
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group {{ $errors->has('id_forma_pago') ? ' has-error' : '' }}">
								<label for="id_forma_pago">Forma de pago <b style="color:red">*</b></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
									<select name="id_forma_pago" id="id_forma_pago" class="form-control">
										@foreach($formas_pago as $forma)
											<option value="{{ $forma->id }}">{{ $forma->codigo }} - {{ $forma->forma_pago }}</option>
										@endforeach
									</select>
								</div>
								@if ($errors->has('id_forma_pago'))
								    <span class="help-block">
								        <strong>{{ $errors->first('id_forma_pago') }}</strong>
								    </span>
								@endif
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group">
								<label>Monto Total <b style="color:red">*</b></label>
								<div class="input-group">
									<span class="input-group-addon" style="background-color:green; color:white"><i class="far fa-money-bill-alt"></i></span>
									<input type="text" id="total" name="total" class="form-control" value="{{ old('total') }}">
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group {{ $errors->has('cheque') ? ' has-error' : '' }}">
								<label for="cheque">Folio de Cheque</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
									<input type="text" name="cheque" id="cheque" value="{{ old('cheque') }}" class="form-control">
								</div>
								@if ($errors->has('cheque'))
								    <span class="help-block">
								        <strong>{{ $errors->first('cheque') }}</strong>
								    </span>
								@endif
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group {{ $errors->has('movimiento') ? ' has-error' : '' }}">
								<label for="movimiento">Movimiento Bancario</label>
								<div class="input-group">
									<span class="input-group-addon"><i>#</i></span>
									<input type="text" name="movimiento" id="movimiento" value="{{ old('movimiento') }}" class="form-control">
								</div>
								@if ($errors->has('movimiento'))
								    <span class="help-block">
								        <strong>{{ $errors->first('movimiento') }}</strong>
								    </span>
								@endif
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group {{ $errors->has('porcentaje_iva') ? ' has-error' : '' }}">
								<label for="porcentaje_iva">Porcentaje IVA</label>
								<div class="input-group">
									<span class="input-group-addon"><i>%</i></span>
									<input type="text" name="porcentaje_iva" id="porcentaje_iva" value="{{ $porcentaje_iva->porcentaje_iva }}" class="form-control">
								</div>
								@if ($errors->has('porcentaje_iva'))
								    <span class="help-block">
								        <strong>{{ $errors->first('porcentaje_iva') }}</strong>
								    </span>
								@endif
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label for="concepto">Comentarios</label>
							<textarea name="concepto" id="concepto" rows="3" class="form-control"></textarea>
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<input type="hidden" value="{{ Auth::user()->id }}" name="id_admin">
					<input type="hidden" value="0" name="con_iva">
					<input type="hidden" value="0" name="iva">
					<input type="hidden" value="1" name="pagado_boolean">
					<input type="hidden" value="Pagado" name="estatus">
					<button type="submit" class="btn btn-azul btn-flat" onclick="javascript:window.location.reload();">
						<span class="glyphicon glyphicon-floppy-disk"></span> Agregar
					</button>
					<button type="button" class="btn btn-default btn-flat" onclick="javascript:window.location.reload();"><span class="fas fa-sync-alt"></span> Actualizar y Cerrar</button>
				</div>
			</div>
		</div>
	</form>
</div>