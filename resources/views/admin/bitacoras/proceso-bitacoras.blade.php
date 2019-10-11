<!-- begin theme-panel -->
<div class="theme-panel theme-panel-lg">
	<a href="javascript:;"><i class="fa fa-cog"></i></a>
	<div class="theme-panel-content">
		<button type="button" class="close" data-click="theme-panel-close" aria-label="Cerrar">
			<span aria-text="true" style="color: black; font-size: 25px"><b>&times;</b></span>
		</button>
		<h5 class="m-t-0 bitacora-title"></h5>
		<input type="hidden" id="id_servicio_proceso">

		<div class="divider"></div>

		<ul class="nav nav-pills">
			<li class="nav-items">
				<a href="#proceso" data-toggle="tab" class="nav-link active">
					<span class="d-sm-none">Procceso <i class="fas fa-list"></i></span>
					<span class="d-sm-block d-none">Proceso <i class="fas fa-list"></i></span>
				</a>
			</li>
			<li class="nav-items">
				<a href="#comentarios" data-toggle="tab" class="nav-link">
					<span class="d-sm-none">Comentarios <i class="fas fa-comment-alt"></i></span>
					<span class="d-sm-block d-none">Comentarios <i class="fas fa-comment-alt"></i></span>
				</a>
			</li>
		</ul>

		<div class="tab-content" style="border: 1px solid #a6a6a6">
			<!-- begin tab-pane -->
			<div class="tab-pane fade active show" id="proceso">
				<div id="proceso-listado-options"></div>
			</div>
			<!-- end tab-pane -->
			<!-- begin tab-pane -->
			<div class="tab-pane fade" id="comentarios">
				<ul class="timeline2">
				    <div id="comentarios_vista"></div>
				    <li>
				    	<!-- begin timeline2-body -->
				    	<div class="timeline2-body">
				    		<div class="timeline2-comment-box">
				    			<div class="user"><img src="{{ asset('images/users/'.Auth::user()->imagen) }}" /></div>
				    			<div class="input">
				    				<form action="">
				    					<div class="input-group">
				    						<textarea class="form-control" placeholder="Escribe un comentario..." name="comentarios_text" id="comentarios_text" rows="3"></textarea>
				    						<span class="input-group-btn p-l-10">
				    						
				    					</div>
				    					<br>
				    					<button id="btn-agregar-comentario" class="btn btn-primary f-s-12 rounded-corner" type="button">Comentar</button>
				    					</span>
				    				</form>
				    			</div>
				    		</div>
				    	</div>
				    	<!-- end timeline2-body -->
				    </li>
				</ul>
				@include('admin.procesos.servicios.editar-comentario')
			</div>
			<!-- end tab-pane -->
		</div>
		<div class="divider"></div>
		<div class="row m-t-10">
			<div class="offset-lg-3 col-md-6">
				<a class="btn btn-inverse btn-block btn-rounded" data-click="theme-panel-close"><b>Cerrar Menú <i class="fas fa-times"></i></b></a>
			</div>
		</div>
	</div>
</div>