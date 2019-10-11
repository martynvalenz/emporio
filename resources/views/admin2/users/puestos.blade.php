<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="puestos">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h4 class="modal-title" style="color: white;">Agregar Puesto</h4>
			</div>
			<div class="modal-body">
				<form role="form" action="{{ route('usuarios.puesto') }}" method="post">
				{{ csrf_field() }}

		            <div class="row">

		              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		                <div class="form-group {{ $errors->has('puesto') ? ' has-error' : '' }}">
		                  <label class="control-label" for="puesto">Nombre del Puesto *</label>
		                  <div class="input-group">
		                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
		                    <input type="text" class="form-control" placeholder="Puesto..." name="puesto" id="puesto" value="{{ old('puesto') }}">
		                  </div>
		                  @if ($errors->has('puesto'))
		                      <span class="help-block">
		                          <strong>{{ $errors->first('puesto') }}</strong>
		                      </span>
		                  @endif
		                </div>
		              </div>

		              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		                <div class="form-group">
		                  <label for="estatus">Estatus</label>
		                  <div class="checkbox">
		                    <label>
		                      <input class="icheckbox_minimal-blue" type="checkbox" name="estatus"
		                      @if (old('estatus') == 1)
		                        checked
		                      @else
		                        unchecked
		                      @endif
		                      checked="checked"> Activo
		                    </label>
		                  </div>
		                </div>
		              </div>

		            </div>

		            <div class="row">

		              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
		                <label for="descripcion">Descripción</label>
		                <textarea name="descripcion" id="editor1" style="width: 100%; height: 600px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('descripcion') }}</textarea>
		                <span class="fath-list form-control-feedback left" aria-hidden="true"></span>
		              </div>
		            </div>
				</div>
				<div class="modal-footer">
					<div class="form-group pull-right">
		                <a data-dismiss="modal" type="button" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Regresar
		                </a>
		                <button type="submit" class="btn btn-azul">Guardar  <i class="glyphicon glyphicon-floppy-disk"></i></button>
		              </div>
				</div>
			</form>
		</div>
	</div>
</div>