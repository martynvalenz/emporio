<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-detalles-{{ $servicio->id }}">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
        </button>
        <h3 class="modal-title" style="color: white;">{{ $servicio->clave }} - {{ $servicio->servicio }} {{ $servicio->nombre_comercial }}</h3>
      </div>
      <div class="modal-body">
          
          <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label for="id_cliente" class="control-label">Cliente</label>
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fas fa-trophy"></i></span>
                      <input type="text" name="nombre_comercial" value="{{ $servicio->nombre_comercial }}" class="form-control">
                  </div>
                </div>                
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label for="tramite" class="control-label">Descripción del servicio</label>
                  <div class="input-group">
                      <span class="input-group-addon"><i class="far fa-comment-alt"></i></span>
                      <input type="text" class="form-control" name="tramite" value="{{ $servicio->tramite }}">
                  </div>
                </div>
              </div>

              <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="form-group">
                  <label for="id_control" class="control-label">Trámite, Marca, Obra o Patente</label>
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-registered"></i></span>
                      <input type="text" value="{{ $servicio->marca }}" class="form-control">
                  </div>
                </div>                
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="form-group">
                  <label for="clase" class="control-label">Clase</label>
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
                      <input type="text" value="{{ $servicio->clase }}" class="form-control">
                  </div>
                </div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label for="id_catalogo_servicio" class="control-label">Servicio</label>
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-suitcase"></i></span>
                      <input type="text" value="{{ $servicio->clave }} - {{ $servicio->servicio }}" class="form-control">
                  </div>
                </div>                
              </div>
          </div>
          <hr>

          <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group">
                <label class="control-label">Concepto de costo</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                    <input type="text" value="{{ $servicio->concepto_costo }}" class="form-control">
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="moneda" class="control-label">Moneda</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-hand-holding-usd"></i></span>
                    <select class="form-control" id="moneda" disabled>
                      @foreach ($monedas as $moneda)
                         @if ($moneda->clave == $servicio->moneda)
                           <option value="{{ $moneda->clave }}" selected>{{ $moneda->clave }} {{ $moneda->moneda }}</option>
                         @else
                           <option value="{{ $moneda->clave }}">{{ $moneda->clave }} {{ $moneda->moneda }}</option>
                         @endif
                       @endforeach
                    </select>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
              <div class="form-group">
                <label class="control-label">Tipo de cambio</label>
                <div class="input-group" title="Conversión de moneda" data-tooltip="tooltip">
                    <span class="input-group-addon"><i class="fas fa-dollar-sign"></i></span>
                    <input type="text" id="tipo_cambio" name="tipo_cambio" class="form-control" value="{{ number_format($servicio->tipo_cambio,2) }}" style="text-align: center">
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
              <div class="form-group">
                <label for="costo_servicio" class="control-label">Costo Emporio</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
                    <input type="text" id="costo_servicio" name="costo_servicio" class="form-control" title="Costo del servicio" value="{{ number_format($servicio->costo_servicio,2) }}" style="text-align: center">
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
              <div class="form-group">
                <label for="costo" class="control-label">Precio del Servicio</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
                    <input type="text" id="costo_ini_val" name="costo_ini" class="form-control" value="{{ number_format($servicio->costo_ini,2) }}" style="text-align: center">
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
              <div class="form-group">
                <label for="costo" class="control-label">% Descuento</label>
                <div class="input-group">
                    <span class="input-group-addon"><i>%</i></span>
                    <input type="text" class="form-control" value="{{ number_format($servicio->porcentaje_descuento,2) }}" style="text-align: center">
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
              <div class="form-group">
                <label for="costo" class="control-label">Descuento</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
                    <input type="text" class="form-control" value="{{ number_format($servicio->descuento,2) }}" style="text-align: center">
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
              <div class="form-group">
                <label for="costo" class="control-label">Precio sin IVA</label>
                <div class="input-group">
                  <span class="input-group-addon" style="background-color: green"><i style="color:white" class="far fa-money-bill-alt"></i></span>
                  <input type="text" class="form-control" value="{{ number_format($servicio->costo,2) }}" style="text-align: center">
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
              <div class="form-group">
                <label class="control-label">Cobrado</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
                  <input type="text" class="form-control" value="{{ number_format($servicio->cobrado,2) }}" style="text-align: center">
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
              <div class="form-group">
                <label for="costo" class="control-label">Saldo</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
                  <input type="text" class="form-control" value="{{ number_format($servicio->saldo,2) }}" style="text-align: center">
                </div>
              </div>
            </div>
          </div> 
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="id_bitacoras" class="control-label">Bitácora</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-book"></i></span>
                    <input type="text" name="costo" id="costo" class="form-control" value="{{ $servicio->clave_bit }} {{ $servicio->bitacora }}">
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="id_admin" class="control-label">Responsable</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" value="{{ $servicio->iniciales }} - {{ $servicio->nombre }} {{ $servicio->apellido }}">
                </div>
              </div>
            </div>
          </div>
          <hr> 
          
          <div class="row">
            <div class="col-lg-12">
              <h2>Comisiones</h2>
              <br>
            </div>
          </div>
          <div class="row">

            <!--<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="responsable_venta" class="control-label">Responsable de Venta</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <select class="form-control" name="responsable_venta">
                      @foreach($admins as $admin)
                          @if ($admin->id == $servicio->responsable_venta)
                            <option value="{{ $admin->id }}" selected>{{ $admin->iniciales }} - {{ $admin->nombre }} {{ $admin->apellido }}</option>
                          @else
                            <option></option>
                          @endif
                      @endforeach
                    </select>
                </div>
              </div>
            </div>-->
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="form-group">
                <label class="control-label">Concepto de costo</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" id="concepto_venta_val" name="concepto_venta" value="{{ $servicio->concepto_venta }}">
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
              <div class="form-group">
                <label for="comision_venta" class="control-label">Comisión de Venta</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
                    <input type="text" class="form-control" name="comision_venta" id="comision_venta_val" value="{{ $servicio->comision_venta }}">
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6">
              <div class="form-group">
                  <label for="aplica_comision_venta">¿Aplica comisión?</label>
                  <div class="checkbox">
                    <label>
                      <input class="" type="checkbox" name="aplica_comision_venta"
                      @if ($servicio->aplica_comision_venta == 1)
                        checked
                      @else
                        unchecked
                      @endif
                      > Aplica
                    </label>
                  </div>
              </div>
            </div>
          </div>

          <div class="row">

            <!--<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="responsable_operativo" class="control-label">Responsable Operativo</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <select class="form-control" name="responsable_operativo">
                      @foreach($admins as $admin)
                          @if ($admin->id == $servicio->responsable_operativo)
                            <option value="{{ $admin->id }}" selected>{{ $admin->iniciales }} - {{ $admin->nombre }} {{ $admin->apellido }}</option>
                          @else
                            <option></option>
                          @endif
                      @endforeach
                    </select>
                </div>
              </div>
            </div>-->
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label class="control-label">Concepto de costo</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" id="concepto_operativo_val" name="concepto_operativo" value="{{ $servicio->concepto_operativo }}">
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
              <div class="form-group">
                <label for="comision_operativa" class="control-label">Comisión Operativa</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
                    <input type="text" class="form-control" name="comision_operativa" id="comision_operativa_val" value="{{ $servicio->comision_operativa }}">
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6">
              <div class="form-group">
                  <label for="aplica_comision_operativa">¿Aplica comisión?</label>
                  <div class="checkbox">
                    <label>
                      <input class="" type="checkbox" name="aplica_comision_operativa"
                      @if ($servicio->aplica_comision_operativa == 1)
                        checked
                      @else
                        unchecked
                      @endif
                      > Aplica
                    </label>
                  </div>
              </div>
            </div>
          </div>

          <div class="row">

            <!--<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="responsable_gestion" class="control-label">Responsable de Gestión</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <select class="form-control" name="responsable_gestion">
                      @foreach($admins as $admin)
                          @if ($admin->id == $servicio->responsable_gestion)
                            <option value="{{ $admin->id }}" selected>{{ $admin->iniciales }} - {{ $admin->nombre }} {{ $admin->apellido }}</option>
                          @else
                            <option></option>
                          @endif
                      @endforeach
                    </select>
                </div>
              </div>
            </div>-->
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label class="control-label">Concepto de costo</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" id="concepto_gestion_val" name="concepto_gestion" value="{{ $servicio->concepto_gestion }}">
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
              <div class="form-group">
                <label for="comision_gestion" class="control-label">Comisión por Gestión</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
                    <input type="text" class="form-control" name="comision_gestion" id="comision_gestion_val" value="{{ $servicio->comision_gestion }}">
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6">
              <div class="form-group">
                  <label for="aplica_comision_gestion">¿Aplica comisión?</label>
                  <div class="checkbox">
                    <label>
                      <input class="" type="checkbox" name="aplica_comision_gestion"
                      @if ($servicio->aplica_comision_gestion == 1)
                        checked
                      @else
                        unchecked
                      @endif
                      > Activo
                    </label>
                  </div>
              </div>
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