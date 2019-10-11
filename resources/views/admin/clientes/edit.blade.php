<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-editar-{{ $cliente->id }}">
    <form role="form" action="{{ route('clientes.update', $cliente->id) }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
                </button>
                <h4 class="modal-title" style="color: white;">Editar Cliente: {{ $cliente->nombre_comercial }}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <img src="{{ asset('images/clients/'.$cliente->logo) }}" alt="Logo de {{ $cliente->nombre_comercial }}" height="100px">
                        <hr>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label>Creada</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" value="{{ Carbon\Carbon::parse($cliente->created_at)->format('d/m/Y') }}" class="form-control" disabled style="background-color: white; color:black">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label>Última actualización</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" value="{{ Carbon\Carbon::parse($cliente->updated_at)->format('d/m/Y') }}" class="form-control" disabled style="background-color: white; color:black">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label>Creado por:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                @if($cliente->id_admin == null)
                                	<input type="text" value="Allan Parra" class="form-control" disabled style="background-color: white; color:black">
                                @else
                                	<input type="text" value="{{ $cliente->nombre }} {{ $cliente->apellido }}" class="form-control" disabled style="background-color: white; color:black">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="form-group {{ $errors->has('nombre_comercial') ? ' has-error' : '' }}">
                            <label for="nombre_comercial" class="control-label">Nombre Comercial *</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-knight"></i></span>
                                <input type="text" class="form-control" placeholder="Nombre comercial de la Empresa..." name="nombre_comercial" id="nombre_comercial" value="@if(old('nombre_comercial')){{ old('nombre_comercial') }}@else{{ $cliente->nombre_comercial }}@endif">
                            </div>
                            @if ($errors->has('nombre_comercial'))
                            	<span class="help-block">
                            		<strong>{{ $errors->first('nombre_comercial') }}</strong>
                            	</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group {{ $errors->has('id_estrategia') ? ' has-error' : '' }}">
                            <label for="id_estrategia">Estrategia</label>
                            <div class="input-group">
                                <span class="input-group-addon btn btn-invertido" style="background-color: #207e94; color:white" title="Agregar estrategia">
                                <i class="fas fa-chart-line"></i>
                                </span>
                                <select class="form-control" name="id_estrategia" id="id_estrategia" style="width: 100%;">
                                    @foreach ($estrategias as $estrategia)
	                                    @if ($estrategia->id == $cliente->id_estrategia)
	                                   		<option value="{{ $estrategia->id }}" selected>{{ $estrategia->estrategia }}</option>
	                                    @else
	                                    	<option value="{{ $estrategia->id }}">{{ $estrategia->estrategia }}</option>
	                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('id_estrategia'))
                            	<span class="help-block">
                            		<strong>{{ $errors->first('id_estrategia') }}</strong>
                            	</span>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group {{ $errors->has('pagina_web') ? ' has-error' : '' }}">
                            <label for="pagina_web" class="control-label">Página web</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                <input type="text" class="form-control minusculas" placeholder="http://..." name="pagina_web" id="pagina_web" value="@if(old('pagina_web')){{ old('pagina_web') }}@else{{ $cliente->pagina_web }}@endif">
                            </div>
                        </div>
                        @if ($errors->has('pagina_web'))
	                        <span class="help-block">
	                        	<strong>{{ $errors->first('pagina_web') }}</strong>
	                        </span>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group {{ $errors->has('carpeta') ? ' has-error' : '' }}">
                            <label for="carpeta" class="control-label">Carpeta</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-folder-open"></i></span>
                                <input type="text" class="form-control" placeholder="http://... Google Drive ..." name="carpeta" id="carpeta" value="@if(old('carpeta')){{ old('carpeta') }}@else{{ $cliente->carpeta }}@endif" title="Carpeta de Google Drive">
                            </div>
                        </div>
                        @if ($errors->has('carpeta'))
	                        <span class="help-block">
	                        	<strong>{{ $errors->first('carpeta') }}</strong>
	                        </span>
                        @endif
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="form-group {{ $errors->has('logo') ? ' has-error' : '' }}">
                            <label for="logo" class="control-label">Logo (max: 300kb)</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                <input type="file" class="form-control minusculas" name="logo" id="logo">
                            </div>
                        </div>
                        @if ($errors->has('logo'))
	                        <span class="help-block">
	                        	<strong>{{ $errors->first('logo') }}</strong>
	                        </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <label for="comentarios">Comentarios</label>
                        <textarea name="comentarios" rows="3" class="form-control">@if(old('comentarios')){{ old('comentarios') }}@else{{ $cliente->comentarios }}@endif</textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gris" data-dismiss="modal">
                Cerrar <span class="glyphicon glyphicon-remove"></span>
                </button>
                <button type="submit" class="btn btn-success">
                <span class="glyphicon glyphicon-floppy-disk"></span> Guardar
                </button>
            </div>
        </div>
    </div>
    </form>
</div>