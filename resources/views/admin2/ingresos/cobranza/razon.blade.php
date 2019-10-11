<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="agregar_razon">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
        </button>
        <h4 class="modal-title" style="color: white;">Agregar Razón Social</h4>
      </div>
      <form role="form" action="" method="post">
      {{ csrf_field() }}
        <div class="modal-body">
          <div class="row">

            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
              <div class="form-group {{ $errors->has('razon_social') ? ' has-error' : '' }}">
                <label for="razon_social" class="control-label">Razón Social</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                  <input type="text" class="form-control mayusculas" placeholder="Razon Social..." name="razon_social_razon" id="razon_social_razon" value="{{ old('razon_social') }}">
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
                  <input type="text" class="form-control mayusculas" placeholder="RFC..." name="rfc_razon" id="rfc_razon" value="{{ old('rfc') }}">
                </div>
              </div>
              @if ($errors->has('rfc'))
                  <span class="help-block">
                      <strong>{{ $errors->first('rfc') }}</strong>
                  </span>
              @endif
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <input name="_token" value="{{ csrf_token() }}" type="hidden">
          <input name="id_admin_razon" id="id_admin_razon" value="{{ Auth::user()->id }}" type="hidden">
          <input name="id_cliente_razon" id="id_cliente_razon" type="hidden">
          <input name="estatus_razon" id="estatus_razon" value="1" type="hidden">
          <button type="button" class="btn btn-gris" data-dismiss="modal">
            Cerrar <span class="glyphicon glyphicon-remove"></span>
          </button>
          <button type="button" onclick="event.preventDefault();" id="btn_razon" class="btn btn-azul">Guardar <i class="glyphicon glyphicon-floppy-disk"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>
