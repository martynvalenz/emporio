<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="agregar">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
        </button>
        <h4 class="modal-title" style="color: white;">Agregar Proveedor</h4>
      </div>
      <form role="form" action="{{ route('proveedores.store') }}" method="post">
      {{ csrf_field() }}
        <div class="modal-body">
          <div class="row">
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group {{ $errors->has('nombre_comercial') ? ' has-error' : '' }}">
                <label for="nombre_comercial">Nombre Comercial</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-university"></i></span>
                  <input type="text" value="{{ old('nombre_comercial') }}" class="form-control" name="nombre_comercial">
                </div>
              </div>
              @if ($errors->has('nombre_comercial'))
                  <span class="help-block">
                      <strong>{{ $errors->first('nombre_comercial') }}</strong>
                  </span>
              @endif
            </div>
          </div>
          <div class="row">

            <hr>

            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
              <div class="form-group {{ $errors->has('razon_social') ? ' has-error' : '' }}">
                <label for="razon_social" class="control-label">Razón Social</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                  <input type="text" class="form-control mayusculas" placeholder="Razon Social..." name="razon_social" id="razon_social" value="{{ old('razon_social') }}">
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
                  <input type="text" class="form-control mayusculas" placeholder="RFC..." name="rfc" id="rfc" value="{{ old('rfc') }}">
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
                  <input type="text" class="form-control" placeholder="Calle..." name="calle" id="calle" value="{{ old('calle') }}">
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
                  <input type="text" class="form-control" placeholder="Número..." name="numero" id="numero" value="{{ old('numero') }}">
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
                  <input type="text" class="form-control" placeholder="" name="numero_int" id="numero_int" value="{{ old('numero_int') }}">
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
                  <input type="text" class="form-control" placeholder="Código..." name="cp" id="cp" value="{{ old('cp') }}">
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
                  <input type="text" class="form-control" placeholder="Colonia..." name="colonia" id="colonia" value="{{ old('colonia') }}">
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
                  <input type="text" class="form-control" placeholder="Localidad..." name="localidad" id="localidad" value="{{ old('localidad') }}">
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
                  <input type="text" class="form-control" placeholder="Municipio..." name="municipio" id="municipio" value="{{ old('municipio') }}">
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
                      <option value="{{ $estado->id }}">{{ $estado->estado }}</option>
                  @endforeach
               </select>
             </div>
           </div>

           <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
             <div class="form-group">
               <label for="id_pais">País</label>
               <select class="form-control" name="id_pais" id="id_pais" style="width: 100%;">
                 @foreach ($paises as $pais)
                      <option value="{{ $pais->id }}">{{ $pais->pais }}</option>
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
                  <input type="text" class="form-control" placeholder="Nombre del Contacto..." name="contacto" id="contacto" value="{{ old('contacto') }}">
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="telefono" class="control-label">Teléfono</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-tty"></i></span>
                  <input type="text" class="form-control" placeholder="Teléfono..." name="telefono" id="telefono" value="{{ old('telefono') }}" data-inputmask='"mask": "(###) ###-####"' data-mask>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="telefono2" class="control-label">Teléfono 2</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-tty"></i></span>
                  <input type="text" class="form-control" placeholder="Teléfono..." name="telefono2" id="telefono2" value="{{ old('telefono2') }}" data-inputmask='"mask": "(###) ###-####"' data-mask>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="form-group">
                <label for="correo" class="control-label">Correo</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="text" class="form-control" placeholder="Correo de contacto..." name="correo" id="correo" value="{{ old('correo') }}">
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
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group has-feedback">
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
              <label for="comentarios">Comentarios</label>
              <textarea name="comentarios" class="form-control" rows="4">{{ old('comentarios') }}</textarea>
              <span class="fath-list form-control-feedback left" aria-hidden="true"></span>
            </div>
          </div>

        <div class="modal-footer">
          <input type="hidden" value="{{ Auth::user()->id }}" name="id_admin">
          <input name="_token" value="{{ csrf_token() }}" type="hidden">
          <button type="button" class="btn btn-gris" data-dismiss="modal">
            Cerrar <span class="glyphicon glyphicon-remove"></span>
          </button>
          <button type="submit" class="btn btn-azul">Guardar <i class="glyphicon glyphicon-floppy-disk"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>