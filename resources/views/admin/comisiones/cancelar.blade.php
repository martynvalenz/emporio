<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-cancelar-comision-{{ $comision->id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #e30000">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
        </button>
        <h4 class="modal-title" style="color: white;">Cancelar comisión</h4>
      </div>
      {{ Form::Open(array('action'=>array('ProcesosController@cancelar_comision', $servicio->id), 'method'=>'put')) }}
        {{ csrf_field() }}
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="form-group">
                <label>Tipo de Comisión *</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" value="{{ $comision->tipo_comision }}" disabled>
                  <input type="hidden" class="form-control" name="tipo_comision_cancelar" value="{{ $comision->tipo_comision }}">
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <label>Monto Disponible</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="far fa-money-bill-alt" aria-hidden="true"></i></span>
                  @if($comision->tipo_comision == 'Venta')
                    <input type="number" name="comision_venta_restante_cancelar" class="form-control" disabled value="{{ $servicio->comision_venta_restante }}">
                  @elseif($comision->tipo_comision == 'Operativa')
                    <input type="number" name="comision_operativa_restante_cancelar" class="form-control" disabled value="{{ $servicio->comision_operativa_restante }}">
                  @elseif($comision->tipo_comision == 'Gestión')
                    <input type="number" name="comision_gestion_restante_cancelar" class="form-control" disabled value="{{ $servicio->comision_gestion_restante }}">
                  @endif
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="form-group">
                <label>Usuario *</label>
                <div class="input-group {{ $errors->has('id_admin') ? ' has-error' : '' }}">
                  <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                  <select disabled class="form-control">
                    <option value="">-Sin selección-</option>
                    @foreach($admins as $admin)
                      @if($admin->id == $comision->id_admin)
                        <option value="{{ $admin->id }}" selected>{{ $admin->iniciales }} {{ $admin->nombre }} {{ $admin->apellido }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                @if ($errors->has('id_admin'))
                  <span class="help-block">
                      <strong>{{ $errors->first('id_admin') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <label>Monto de Comisión *</label>
                <div class="input-group {{ $errors->has('monto') ? ' has-error' : '' }}">
                  <span class="input-group-addon"><i class="far fa-money-bill-alt" aria-hidden="true"></i></span>
                  <input type="number" disabled class="form-control" value="{{ $comision->monto }}">
                  <input type="hidden" name="monto_cancelado" class="form-control" value="{{ $comision->monto }}">
                  <input type="hidden" name="id_cancelar" class="form-control" value="{{ $comision->id }}">
                  <input type="hidden" name="estatus_cancelar" class="form-control" value="Cancelado">

                </div>
                @if ($errors->has('monto'))
                  <span class="help-block">
                      <strong>{{ $errors->first('monto') }}</strong>
                  </span>
                @endif
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <label>Comentarios</label>
              <textarea name="comentarios" rows="3" class="form-control">{{ $comision->comentarios }}</textarea>
            </div>
          </div>



        </div>

        <div class="modal-footer">
          <input name="_token" value="{{ csrf_token() }}" type="hidden">
          <button type="button" class="btn btn-gris" data-dismiss="modal">
            Cerrar <span class="glyphicon glyphicon-remove"></span>
          </button>
          <button type="submit" class="btn btn-danger">Cancelar <i class="glyphicon glyphicon-trash"></i></button>
        </div>
      {{ Form::Close() }}
    </div>
  </div>
</div>