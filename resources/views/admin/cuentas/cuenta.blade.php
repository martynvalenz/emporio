<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-cuenta">
	<form>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="color: white;"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: white;"><b>&times;</b></span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
					    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					        <div class="form-group">
					            <label for="tipo" class="control-label">Seleccione el tipo de Cuenta</label>
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fas fa-hashtag"></i></span>
					                <select name="tipo" id="tipo" class="form-control">
					                	<option value="">-Sin selección-</option>
					                    <option value="Crédito">Crédito</option>
					                    <option value="Empresarial">Empresarial</option>
					                    <option value="Fiscal">Fiscal</option>
					                    <option value="Efectivo">Efectivo</option>
					                    <option value="Debito">Débito</option>
					                    <option value="Departamental">Departamental</option>
					                </select>
					            </div>
					            <span class="help-block">
					                <strong id="tipo_error" style="color:red"></strong>
					            </span>
					        </div>
					    </div>
					    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					        <div class="form-group">
					            <label for="alias" class="control-label">Alias de cuenta</label>
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fas fa-piggy-bank"></i></span>
					                <input type="text" class="form-control" placeholder="Nombre o alias de cuenta..." name="alias" id="alias">
					            </div>
					            <span class="help-block">
					                <strong id="alias_error" style="color:red"></strong>
					            </span>
					        </div>
					    </div>
					    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					        <div class="form-group">
					            <label for="id_banco">Banco</label>
					            <div class="input-group">
					                <span class="input-group-addon btn btn-invertido" style="background-color: #207e94; color:white" title="Agregar Banco">
					                <i class="fa fa-university"></i>
					                </span>
					                <select class="form-control" name="id_banco" id="id_banco">
					                	<option value="">-Sin selección-</option>
					                    @foreach ($bancos as $banco)
					                    	<option value="{{ $banco->id }}">{{ $banco->banco }}</option>
					                    @endforeach
					                </select>
					            </div>
					           	<span class="help-block">
					                <strong id="id_banco_error" style="color:red"></strong>
					            </span>
					        </div>
					    </div>
					    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					        <div class="form-group">
					            <label for="saldo_inicial" class="control-label">Saldo inicial</label>
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fas fa-money-bill-alt"></i></span>
					                <input type="number" step="any" class="form-control centered" placeholder="" name="saldo_inicial" id="saldo_inicial">
					            </div>
					            <span class="help-block">
					                <strong id="saldo_inicial_error" style="color:red"></strong>
					            </span>
					        </div>
					    </div>
					</div>
					<div class="row">
					    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					        <div class="form-group">
					            <label for="cuenta" class="control-label">Número de Cuenta</label>
					            <div class="input-group">
					                <span class="input-group-addon"><i><b>#</b></i></span>
					                <input type="text" class="form-control" placeholder="123456789..." name="cuenta" id="cuenta">
					            </div>
					            <span class="help-block">
					                <strong id="cuenta_error" style="color:red"></strong>
					            </span>
					        </div>
					    </div>
					    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					        <div class="form-group">
					            <label for="clabe" class="control-label">CLABE</label>
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fa fa-suitcase" aria-hidden="true"></i></span>
					                <input type="text" class="form-control" placeholder="18 o 20 Dígitos..." name="clabe" id="clabe">
					            </div>
					            <span class="help-block">
					                <strong id="clabe_error" style="color:red"></strong>
					            </span>
					        </div>
					    </div>
					    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					        <div class="form-group">
					            <label for="tarjeta" class="control-label">Número de tarjeta</label>
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fa fa-credit-card-alt"></i></span>
					                <input type="text" class="form-control" placeholder="16 Dígitos..." name="tarjeta" id="tarjeta" data-inputmask='"mask": "#### #### #### ####"' data-mask>
					            </div>
					            <span class="help-block">
					                <strong id="tarjeta_error" style="color:red"></strong>
					            </span>
					        </div>
					    </div>
					</div>
					<div class="row">
					    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
					        <label for="comentarios">Comentarios</label>
					        <textarea rows="3" class="form-control has-feedback-left" placeholder="Anote una descripción para la Cuenta..." name="comentarios" id="comentarios""></textarea>
					        <span class="fath-list form-control-feedback left" aria-hidden="true"></span>
					    </div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_cuenta">
					<button class="btn btn-grey" data-dismiss="modal">Cerrar</button>
					<a class="btn btn-primary" id="btn-save">Guardar <i class="fas fa-save"></i></a>
				</div>
			</div>
		</div>
	</form>
</div>










