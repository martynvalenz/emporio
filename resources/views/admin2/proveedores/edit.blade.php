<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-editar-prov-{{ $prov->id }}">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h4 class="modal-title" style="color: white;">Editar Proveedor: {{ $prov->nombre_comercial }}</h4>
			</div>
			{{ Form::Open(array('action'=>array('ProveedoresController@update', $prov->id), 'method'=>'put')) }}
				<div class="modal-body">
					<div class="row">
					   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					    <div class="form-group {{ $errors->has('razon_social') ? ' has-error' : '' }}">
					      <label for="nombre_comercial">Nombre Comercial *</label>
			      		  <div class="input-group">
			      		  	<span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
			      		  	<input type="text" class="form-control" name="nombre_comercial" id="nombre_comercial" value="@if(old('nombre_comercial')){{ old('nombre_comercial') }}@else{{ $prov->nombre_comercial }}@endif">
			      		  </div>
					    </div>
					    @if ($errors->has('nombre_comercial'))
					        <span class="help-block">
					            <strong>{{ $errors->first('nombre_comercial') }}</strong>
					        </span>
					    @endif
					  </div>
					</div>
					<hr>
					<div class="row">

					  <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					    <div class="form-group {{ $errors->has('razon_social') ? ' has-error' : '' }}">
					      <label for="razon_social" class="control-label">Razón Social</label>
					      <div class="input-group">
					        <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
					        <input type="text" class="form-control mayusculas" placeholder="Razon Social..." name="razon_social" id="razon_social" value="@if(old('razon_social')){{ old('razon_social') }}@else{{ $prov->razon_social }}@endif">
					      </div>
					    </div>
					    @if ($errors->has('razon_social'))
					        <span class="help-block">
					            <strong>{{ $errors->first('razon_social') }}</strong>
					        </span>
					    @endif
					  </div>

					  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					    <div class="form-group {{ $errors->has('rfc') ? ' has-error' : '' }}">
					      <label for="rfc" class="control-label">RFC</label>
					      <div class="input-group">
					        <span class="input-group-addon"><i class="glyphicon glyphicon-qrcode"></i></span>
					        <input type="text" class="form-control mayusculas" placeholder="RFC..." name="rfc" id="rfc" value="@if(old('rfc')){{ old('rfc') }}@else{{ $prov->rfc }}@endif">
					      </div>
					    </div>
					    @if ($errors->has('rfc'))
					        <span class="help-block">
					            <strong>{{ $errors->first('rfc') }}</strong>
					        </span>
					    @endif
					  </div>
					</div>

					<hr>

					<div class="row">

					  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					    <h2>Dirección Fiscal</h2>
					  </div>

					  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					    <div class="form-group {{ $errors->has('calle') ? ' has-error' : '' }}">
					      <label for="calle" class="control-label">Calle</label>
					      <div class="input-group">
					        <span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
					        <input type="text" class="form-control" placeholder="Calle..." name="calle" id="calle" value="@if(old('calle')){{ old('calle') }}@else{{ $prov->calle }}@endif">
					      </div>
					    </div>
					    @if ($errors->has('calle'))
					        <span class="help-block">
					            <strong>{{ $errors->first('calle') }}</strong>
					        </span>
					    @endif
					  </div>

					  <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
					    <div class="form-group {{ $errors->has('numero') ? ' has-error' : '' }}">
					      <label for="numero" class="control-label">Número</label>
					      <div class="input-group">
					        <span class="input-group-addon"><i><b>#</b></i></span>
					        <input type="text" class="form-control" placeholder="Número..." name="numero" id="numero" value="@if(old('numero')){{ old('numero') }}@else{{ $prov->numero }}@endif">
					      </div>
					    </div>
					    @if ($errors->has('numero'))
					        <span class="help-block">
					            <strong>{{ $errors->first('numero') }}</strong>
					        </span>
					    @endif
					  </div>

					  <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
					    <div class="form-group {{ $errors->has('numero_int') ? ' has-error' : '' }}">
					      <label for="numero_int" class="control-label">Número Interno</label>
					      <div class="input-group">
					        <span class="input-group-addon"><i><b>#</b></i></span>
					        <input type="text" class="form-control" placeholder="" name="numero_int" id="numero_int" value="@if(old('numero_int')){{ old('numero_int') }}@else{{ $prov->numero_int }}@endif">
					      </div>
					    </div>
					    @if ($errors->has('numero_int'))
					        <span class="help-block">
					            <strong>{{ $errors->first('numero_int') }}</strong>
					        </span>
					    @endif
					  </div>

					  <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
					    <div class="form-group {{ $errors->has('cp') ? ' has-error' : '' }}">
					      <label for="cp" class="control-label">Código Postal</label>
					      <div class="input-group">
					        <span class="input-group-addon"><i><b>CP</b></i></span>
					        <input type="text" class="form-control" placeholder="Código..." name="cp" id="cp" value="@if(old('cp')){{ old('cp') }}@else{{ $prov->cp }}@endif">
					      </div>
					    </div>
					    @if ($errors->has('cp'))
					        <span class="help-block">
					            <strong>{{ $errors->first('cp') }}</strong>
					        </span>
					    @endif
					  </div>

					  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					    <div class="form-group {{ $errors->has('colonia') ? ' has-error' : '' }}">
					      <label for="colonia" class="control-label">Colonia</label>
					      <div class="input-group">
					        <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
					        <input type="text" class="form-control" placeholder="Colonia..." name="colonia" id="colonia" value="@if(old('colonia')){{ old('colonia') }}@else{{ $prov->colonia }}@endif">
					      </div>
					    </div>
					    @if ($errors->has('colonia'))
					        <span class="help-block">
					            <strong>{{ $errors->first('colonia') }}</strong>
					        </span>
					    @endif
					  </div>

					  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					    <div class="form-group {{ $errors->has('localidad') ? ' has-error' : '' }}">
					      <label for="localidad" class="control-label">Localidad</label>
					      <div class="input-group">
					        <span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
					        <input type="text" class="form-control" placeholder="Localidad..." name="localidad" id="localidad" value="@if(old('localidad')){{ old('localidad') }}@else{{ $prov->localidad }}@endif">
					      </div>
					    </div>
					    @if ($errors->has('localidad'))
					        <span class="help-block">
					            <strong>{{ $errors->first('localidad') }}</strong>
					        </span>
					    @endif
					  </div>

					  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					    <div class="form-group {{ $errors->has('municipio') ? ' has-error' : '' }}">
					      <label for="municipio" class="control-label">Municipio</label>
					      <div class="input-group">
					        <span class="input-group-addon"><i class="fa fa-map"></i></span>
					        <input type="text" class="form-control" placeholder="Municipio..." name="municipio" id="municipio" value="@if(old('municipio')){{ old('municipio') }}@else{{ $prov->municipio }}@endif">
					      </div>
					    </div>
					    @if ($errors->has('municipio'))
					        <span class="help-block">
					            <strong>{{ $errors->first('municipio') }}</strong>
					        </span>
					    @endif
					  </div>

					  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					   <div class="form-group">
					     <label for="id_estado">Estado</label>
					     <select class="form-control" name="id_estado" id="id_estado" style="width: 100%;">
			                 @foreach ($estados as $estado)
			                   @if ($estado->id == $prov->id_estado)
			                     <option value="{{ $estado->id }}" selected>{{ $estado->estado }}</option>
			                   @else
			                     <option value="{{ $estado->id }}">{{ $estado->estado }}</option>
			                   @endif
			                 @endforeach
			               </select>
					   </div>
					 </div>

					 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					   <div class="form-group">
					     <label for="id_pais">País</label>
					     <select class="form-control" name="id_pais" id="id_pais" style="width: 100%;">
					    	@foreach ($paises as $pais)
			                   @if ($pais->id == $prov->id_pais)
			                     <option value="{{ $pais->id }}" selected>{{ $pais->pais }}</option>
			                   @else
			                     <option value="{{ $pais->id }}">{{ $pais->pais }}</option>
			                   @endif
			                 @endforeach
					     </select>
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
			                  <input type="text" class="form-control" placeholder="Nombre del Contacto..." name="contacto" id="contacto" value="@if(old('contacto')){{ old('contacto') }}@else{{ $prov->contacto }}@endif">
			                </div>
			              </div>
			            </div>
			            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			              <div class="form-group">
			                <label for="telefono" class="control-label">Teléfono</label>
			                <div class="input-group">
			                  <span class="input-group-addon"><i class="fa fa-tty"></i></span>
			                  <input type="text" class="form-control" placeholder="Teléfono..." name="telefono" id="telefono" value="@if(old('telefono')){{ old('telefono') }}@else{{ $prov->telefono }}@endif" data-inputmask='"mask": "(###) ###-####"' data-mask>
			                </div>
			              </div>
			            </div>
			            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			              <div class="form-group">
			                <label for="telefono2" class="control-label">Teléfono 2</label>
			                <div class="input-group">
			                  <span class="input-group-addon"><i class="fa fa-tty"></i></span>
			                  <input type="text" class="form-control" placeholder="Teléfono..." name="telefono2" id="telefono2" value="@if(old('telefono2')){{ old('telefono2') }}@else{{ $prov->telefono2 }}@endif" data-inputmask='"mask": "(###) ###-####"' data-mask>
			                </div>
			              </div>
			            </div>
			            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			              <div class="form-group">
			                <label for="correo" class="control-label">Correo</label>
			                <div class="input-group">
			                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
			                  <input type="text" class="form-control" placeholder="Correo de contacto..." name="correo" id="correo" value="@if(old('correo')){{ old('correo') }}@else{{ $prov->correo }}@endif">
			                </div>
			              </div>
			              @if ($errors->has('correo'))
			                  <span class="help-block">
			                      <strong>{{ $errors->first('correo') }}</strong>
			                  </span>
			              @endif
			            </div>
			          </div>

					<div class="row">
					  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
					    <label for="comentarios">Comentarios</label>
					    <textarea name="comentarios" class="form-control" rows="3">@if(old('comentarios')){{ old('comentarios') }}@else{{ $prov->comentarios }}@endif</textarea>
					    <span class="fath-list form-control-feedback left" aria-hidden="true"></span>
					  </div>
					</div>


				</div>

				<div class="modal-footer">
					<input name="_token" value="{{ csrf_token() }}" type="hidden">
					<button type="button" class="btn btn-gris" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
					<button type="submit" class="btn btn-azul">Guardar <i class="glyphicon glyphicon-floppy-disk"></i></button>
				</div>
			{{ Form::Close() }}
		</div>
	</div>
	
</div>