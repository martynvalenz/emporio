<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="agregar_cliente">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
        </button>
        <h4 class="modal-title" style="color: white;">Agregar Cliente</h4>
      </div>
      <form role="form">
      {{ csrf_field() }}
        <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group {{ $errors->has('nombre_comercial') ? ' has-error' : '' }}">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <label class="btn btn-info"><i class="fa fa-user-plus"></i> Nombre Comercial</label>
                    </span>
                    <input type="text" name="nombre_comercial" id="nombre_comercial_agregar" class="form-control" value="{{ old('nombre_comercial') }}" placeholder="Nombre comercial del cliente...">
                  </div>
                  @if ($errors->has('nombre_comercial'))
                      <span class="help-block">
                          <strong>{{ $errors->first('nombre_comercial') }}</strong>
                      </span>
                  @endif
                </div>

                <br>
              </div>
              
            </div>
            <input type="hidden" value="{{ Auth::user()->id }}" name="id_admin">
            <input type="hidden" value="1" name="id_estrategia">
        </div>

        <div class="modal-footer">
          <input name="_token" value="{{ csrf_token() }}" type="hidden">
          <button type="button" onclick="event.preventDefault();" id="btn_cliente" class="btn btn-azul"><span class="glyphicon glyphicon-floppy-disk"> </span> Agregar</button>
          <button type="button" class="btn btn-gris" data-dismiss="modal">
            Cerrar <span class="glyphicon glyphicon-remove"></span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
