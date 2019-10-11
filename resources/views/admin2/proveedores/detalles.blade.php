<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-detalles-prov-{{ $prov->id }}">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h4 class="modal-title" style="color: white;">{{ $prov->nombre_comercial }}</h4>
			</div>
			<div class="modal-body">
				
				<div class="row">

				  <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				    <div class="form-group">
				      <label class="control-label">Razón Social</label>
				      <div class="input-group">
				        <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
				        <input type="text" class="form-control mayusculas" placeholder="Razon Social..." name="razon_social" id="razon_social" value="{{ $prov->razon_social }}">
				      </div>
				    </div>
				  </div>

				  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				    <div class="form-group">
				      <label for="rfc" class="control-label">RFC</label>
				      <div class="input-group">
				        <span class="input-group-addon"><i class="glyphicon glyphicon-qrcode"></i></span>
				        <input type="text" class="form-control mayusculas" placeholder="RFC..." name="rfc" id="rfc" value="{{ $prov->rfc }}">
				      </div>
				    </div>
				  </div>
				</div>

				<hr>

				<div class="row">

				  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				    <h2>Dirección Fiscal</h2>
				  </div>

				  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
				    <div class="form-group">
				      <label for="calle" class="control-label">Calle</label>
				      <div class="input-group">
				        <span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
				        <input type="text" class="form-control" placeholder="Calle..." name="calle" id="calle" value="{{ $prov->calle }}">
				      </div>
				    </div>
				  </div>

				  <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
				    <div class="form-group">
				      <label for="numero" class="control-label">Número</label>
				      <div class="input-group">
				        <span class="input-group-addon"><i><b>#</b></i></span>
				        <input type="text" class="form-control" placeholder="Número..." name="numero" id="numero" value="{{ $prov->numero }}">
				      </div>
				    </div>
				  </div>

				  <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
				    <div class="form-group">
				      <label for="numero_int" class="control-label">Número Interno</label>
				      <div class="input-group">
				        <span class="input-group-addon"><i><b>#</b></i></span>
				        <input type="text" class="form-control" placeholder="" name="numero_int" id="numero_int" value="{{ $prov->numero_int }}">
				      </div>
				    </div>
				  </div>

				  <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
				    <div class="form-group">
				      <label for="cp" class="control-label">Código Postal</label>
				      <div class="input-group">
				        <span class="input-group-addon"><i><b>CP</b></i></span>
				        <input type="text" class="form-control" placeholder="Código..." name="cp" id="cp" value="{{ $prov->cp }}">
				      </div>
				    </div>
				  </div>

				  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				    <div class="form-group">
				      <label for="colonia" class="control-label">Colonia</label>
				      <div class="input-group">
				        <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
				        <input type="text" class="form-control" placeholder="Colonia..." name="colonia" id="colonia" value="{{ $prov->colonia }}">
				      </div>
				    </div>
				  </div>

				  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				    <div class="form-group">
				      <label for="localidad" class="control-label">Localidad</label>
				      <div class="input-group">
				        <span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
				        <input type="text" class="form-control" placeholder="Localidad..." name="localidad" id="localidad" value="{{ $prov->localidad }}">
				      </div>
				    </div>
				  </div>

				  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				    <div class="form-group">
				      <label for="municipio" class="control-label">Municipio</label>
				      <div class="input-group">
				        <span class="input-group-addon"><i class="fa fa-map"></i></span>
				        <input type="text" class="form-control" placeholder="Municipio..." name="municipio" id="municipio" value="{{ $prov->municipio }}">
				      </div>
				    </div>
				  </div>

				  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				   <div class="form-group">
				     <label>Estado</label>
				     <div class="input-group">
				     	<span class="input-group-addon"><i class="fa fa-map-pin"></i></span>
				     	<input type="text" class="form-control" value="{{ $prov->estado }}">
				     </div>
				   </div>
				 </div>

				 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				   <div class="form-group">
				     <label for="id_pais">País</label>
				     <div class="input-group">
				     	<span class="input-group-addon"><i class="fa fa-flag"></i></span>
				     	<input type="text" class="form-control" value="{{ $prov->pais }}">
				     </div>
				   </div>
				 </div>

				</div>
				<hr>
				<div class="row">
		            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		              <div class="form-group">
		                <label for="contacto" class="control-label">Contacto</label>
		                <div class="input-group">
		                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
		                  <input type="text" class="form-control" placeholder="Nombre del Contacto..." name="contacto" id="contacto" value="{{ $prov->contacto }}">
		                </div>
		              </div>
		            </div>
		            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		              <div class="form-group">
		                <label for="telefono" class="control-label">Teléfono</label>
		                <div class="input-group">
		                  <span class="input-group-addon"><i class="fa fa-tty"></i></span>
		                  <input type="text" class="form-control" placeholder="Teléfono..." name="telefono" id="telefono" value="{{ $prov->telefono }}" data-inputmask='"mask": "(###) ###-####"' data-mask>
		                </div>
		              </div>
		            </div>
		            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		              <div class="form-group">
		                <label for="telefono2" class="control-label">Teléfono 2</label>
		                <div class="input-group">
		                  <span class="input-group-addon"><i class="fa fa-tty"></i></span>
		                  <input type="text" class="form-control" placeholder="Teléfono..." name="telefono2" id="telefono2" value="{{ $prov->telefono2 }}" data-inputmask='"mask": "(###) ###-####"' data-mask>
		                </div>
		              </div>
		            </div>
		            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		              <div class="form-group">
		                <label for="correo" class="control-label">Correo</label>
		                <div class="input-group">
		                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
		                  <input type="text" class="form-control" placeholder="Correo de contacto..." name="correo" id="correo" value="{{ $prov->correo }}">
		                </div>
		              </div>
		            </div>
		          </div>

				<div class="row">
				  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				    <label for="comentarios">Comentarios</label>
				    <textarea name="comentarios" class="form-control" rows="3">{{ $prov->comentarios }}</textarea>
				    <span class="fath-list form-control-feedback left" aria-hidden="true"></span>
				  </div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-gris" data-dismiss="modal">
					Cerrar <span class="glyphicon glyphicon-remove"></span>
				</button>
			</div>
		</div>
	</div>
</div>