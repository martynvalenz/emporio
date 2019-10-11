<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-editar-comision-{{ $comision->id }}">
  <div class="modal-dialog modal-default">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
        </button>
        <h4 class="modal-title" style="color: white;">Editar comisión</h4>
      </div>
      @if (count($errors)>0)
      <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
        </ul>
      </div>
      @endif
      {{ Form::Open(array('action'=>array('ProcesosController@editar_comision', $servicio->id), 'method'=>'put')) }}
        {{ csrf_field() }}
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="form-group">
                <label>Tipo de Comisión *</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" value="{{ $comision->tipo_comision }}" disabled>
                  <input type="hidden" class="form-control" name="tipo_comision_editar" value="{{ $comision->tipo_comision }}">
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
                  <select class="form-control" name="id_admin">
                    <option value="">-Sin selección-</option>
                    @foreach($admins as $admin)
                      @if($admin->id == $comision->id_admin)
                        <option value="{{ $admin->id }}" selected>{{ $admin->iniciales }} {{ $admin->nombre }} {{ $admin->apellido }}</option>
                      @else
                        <option value="{{ $admin->id }}">{{ $admin->iniciales }} {{ $admin->nombre }} {{ $admin->apellido }}</option>
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
                  @if($comision->tipo_comision == 'Venta')
                    <input type="number" name="monto_editar" class="form-control" value="{{ $comision->monto }}" max="{{ number_format($servicio->comision_venta_restante + $comision->monto)  }}">
                  @elseif($comision->tipo_comision == 'Operativa')
                    <input type="number" name="monto_editar" class="form-control" value="{{ $comision->monto }}" max="{{ number_format($servicio->comision_operativa_restante + $comision->monto)  }}">
                  @elseif($comision->tipo_comision == 'Gestión')
                    <input type="number" name="monto_editar" class="form-control" value="{{ $comision->monto }}" max="{{ number_format($servicio->comision_gestion_restante + $comision->monto)  }}">
                  @endif
                  <input type="hidden" name="monto_anterior" class="form-control" value="{{ $comision->monto }}">
                  <input type="hidden" name="id_editar" class="form-control" value="{{ $comision->id }}">

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
          <button type="submit" class="btn btn-azul">Guardar <i class="glyphicon glyphicon-floppy-disk"></i></button>
        </div>
      {{ Form::Close() }}
    </div>
  </div>
</div>