<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-create">
	<form role="form" id="agregarForm">
	{{ csrf_field() }}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Agregar Color</h4>
				</div>
				<div class="modal-body">
					
					<div class="row">

					    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
					      <div class="form-group">
					        <label for="estatus" class="control-label">Nombre del Estatus <b style="color:red">*</b></label>
					        <div class="input-group">
					            <span class="input-group-addon"><i class="fas fa-flag"></i></span>
					            <input type="text" name="estatus" id="estatus" class="form-control">
					        </div>
					        <span class="help-block">
					            <strong id="error_estatus" style="color:red"></strong>
					        </span>
					      </div>                
					    </div>
						<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
						  <div class="form-group {{ $errors->has('uso') ? ' has-error' : '' }}">
						    <label for="uso" class="control-label">Bitácora de Estatus <b style="color:red">*</b></label>
						    <div class="input-group">
						        <span class="input-group-addon"><i class="fas fa-list"></i></span>
						        <select name="uso" id="uso" class="form-control">
						        	@foreach($categorias as $cat)
						        		<option value="{{ $cat->id }}">{{ $cat->bitacora }}</option>
						        	@endforeach
						        </select>
						    </div>
						    @if ($errors->has('uso'))
						        <span class="help-block">
						            <strong>{{ $errors->first('uso') }}</strong>
						        </span>
						    @endif
						  </div>                
						</div>
					</div>   
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
						  <div class="form-group {{ $errors->has('color') ? ' has-error' : '' }}">
						    <label for="color" class="control-label">Color de Fondo <b style="color:red">*</b></label>
						    <div class="input-group">
						        <span class="input-group-addon"><i class="fas fa-square" style="color: #ff0000"></i></span>
						        <input type="color" name="color" id="color" value="#ff0000" class="form-control">
						    </div>
						    @if ($errors->has('color'))
						        <span class="help-block">
						            <strong>{{ $errors->first('color') }}</strong>
						        </span>
						    @endif
						  </div>                
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
						  <div class="form-group {{ $errors->has('texto') ? ' has-error' : '' }}">
						    <label for="texto" class="control-label">Color de Texto <b style="color:red">*</b></label>
						    <div class="input-group">
						        <span class="input-group-addon"><i class="fas fa-square" style="color: #000000"></i></span>
						        <input type="color" name="texto" id="texto" value="#000000" class="form-control">
						    </div>
						    @if ($errors->has('texto'))
						        <span class="help-block">
						            <strong>{{ $errors->first('texto') }}</strong>
						        </span>
						    @endif
						  </div>                
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
						  <div class="form-group {{ $errors->has('activo') ? ' has-error' : '' }}">
						    <label for="activo" class="control-label">Estatus <b style="color:red">*</b></label>
						    <div class="input-group">
						        <span class="input-group-addon"><i class="far fa-flag"></i></span>
						        <select name="activo" id="activo" class="form-control">
						        	<option value="1">Activo</option>
						        	<option value="0">Inactivo</option>
						        </select>
						    </div>
						    @if ($errors->has('activo'))
						        <span class="help-block">
						            <strong>{{ $errors->first('activo') }}</strong>
						        </span>
						    @endif
						  </div>                
						</div>
					</div> 
				</div>
				<div class="modal-footer">
					<input name="_token" value="{{ csrf_token() }}" type="hidden">
					<a type="button" class="btn btn-azul" id="btn_agregar">
						<span class="glyphicon glyphicon-floppy-disk"></span> Agregar
					</a>
					<a type="button" class="btn btn-gris" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</a>
				</div>
			</div>
		</div>
	</form>
</div>