<div class="modal fade modal-slide-in-right" aria-text="true" role="dialog" tabindex="-1" id="modal-gestionar">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Preseleccionar comisiones</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-text="true" style="color: black;"><b>&times;</b></span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xl-5 col-lg-5 col-md-5 col-sm-6 col-xs-12">
	                    <div class="form-group">
	                        <label>Usuario</label>
	                        <div class="input-group">
	                            <span class="input-group-addon"><i class="fas fa-user"></i></span>
	                            <select id="id_admin_pendientes" class="form-control">
	                                @if(Auth::user()->Role->Role->id == 1 || Auth::user()->Role->Role->id == 2 || Auth::user()->Role->Role->id == 3)
	                                    <option value="0">-Todos-</option>
	                                    @foreach($admins as $admin)
	                                        <option value="{{ $admin->id }}">{{ $admin->iniciales }} - {{ $admin->nombre }} {{ $admin->apellido }}</option>
	                                    @endforeach
	                                @else
	                                    <option value="{{ Auth::user()->id }}">{{ Auth::user()->iniciales }} - {{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</option>
	                                @endif
	                            </select>
	                            <div class="input-group-btn">
	                            	<a id="btn-refrescar" class="btn btn-grey" title="Actualizar listado" data-tooltip="tooltip"><i class="fas fa-sync"></i></a>
	                            </div>
	                        </div>
	                    </div>
	                </div>
				</div>
				<div id="preseleccionar-listado"></div>

			</div>
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn btn-grey">Cerrar <i class="fas fa-times"></i></button>
			</div>
		</div>
	</div>
</div>


