<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-cliente">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true" style="font-size: 35px; color: white;"><b>&times;</b></span>
                </button>
                <h4 class="modal-title" style="color: white;"></h4>
            </div>
            <form id="form" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="nombre_comercial" class="control-label">Nombre Comercial <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-knight"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Nombre comercial de la Empresa..." name="nombre_comercial">
                                </div>
                                <span class="help-block">
                                    <strong id="nombre_comercial_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="id_estrategia_cliente">Estrategia <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon btn btn-invertido" style="background-color: #207e94; color:white" title="Agregar estrategia" data-target="#agregar-estrategia" data-toggle="modal">
                                    <i class="fas fa-chart-line"></i>
                                    </span>
                                    <select class="form-control" name="id_estrategia" style="width: 100%;" title="Estrategia">
                                        <option value="">-Sin selección-</option>
                                        @foreach ($estrategias as $estrategia)
                                            <option value="{{ $estrategia->id }}">{{ $estrategia->estrategia }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="help-block">
                                    <strong id="id_estrategia_cliente_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="pagina_web" class="control-label">Página web</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                    <input type="text" class="form-control minusculas" placeholder="http://..." name="pagina_web">
                                </div>
                                <span class="help-block">
                                    <strong id="pagina_web_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="logo" class="control-label">Logo (max: 300kb)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                    <input type="file" class="form-control" placeholder="http://..." name="logo">
                                </div>
                            </div>
                            <span class="help-block">
                                <strong id="logo_error" style="color:red"></strong>
                            </span>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="carpeta" class="control-label">Carpeta</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-folder-open"></i></span>
                                    <input type="text" class="form-control" placeholder="http://... Google Drive ..." name="carpeta" data-tooltip="tooltip" title="Carpeta de Google Drive">
                                </div>
                            </div>
                            <span class="help-block">
                                <strong id="carpeta_error" style="color:red"></strong>
                            </span>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                            <div class="form-group">
                                <label for="estatus">Estatus</label>
                                <select class="form-control" name="estatus" >
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="comentarios">Comentarios</label>
                            <textarea name="comentarios" id="comentarios" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_admin" value="{{ Auth::user()->id }}">
                    <button type="button" class="btn btn-gris btn-flat" data-dismiss="modal">
                    Cerrar <span class="glyphicon glyphicon-remove"></span>
                    </button>
                    <button type="submit" id="btn-save-cliente">Guardar <i class="fas fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>