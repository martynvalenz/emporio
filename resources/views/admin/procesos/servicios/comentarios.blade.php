<div class="modal fade modal-slide-in-right" aria-text="true" role="dialog" tabindex="-1" id="comentarios-modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title" id="title-comentarios"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-text="true"><b>&times;</b></span>
				</button>
			</div>
			<form action="">
				<div class="modal-body" style="background-color: #e3e6e8">
					<ul class="timeline">
					    <div id="comentarios_vista"></div>
					    <li>
					    	<!-- begin timeline-time -->
					    	<div class="timeline-time">
					    	</div>
					    	<!-- end timeline-time -->
					    	<!-- begin timeline-icon -->
					    	<div class="timeline-icon">
					    		<a href="javascript:;">&nbsp;</a>
					    	</div>
					    	<!-- end timeline-icon -->
					    	<!-- begin timeline-body -->
					    	<div class="timeline-body">
					    		<div class="timeline-comment-box">
					    			<div class="user"><img src="{{ asset('images/users/'.Auth::user()->imagen) }}" /></div>
					    			<div class="input">
					    				<form action="">
					    					<div class="input-group">
					    						<textarea class="form-control" placeholder="Escribe un comentario..." name="comentarios_text" id="comentarios_text" rows="3"></textarea>
					    						<span class="input-group-btn p-l-10"></span>
					    						
					    					</div>
					    					<br>
					    					<button id="btn-agregar-comentario" class="btn btn-primary f-s-12 rounded-corner" type="button">Comentar</button>
					    					
					    				</form>
					    			</div>
					    		</div>
					    	</div>
					    	<!-- end timeline-body -->
					    </li>
					</ul>
					
				</div>
				@include('admin.procesos.servicios.editar-comentario')
				

				<div class="modal-footer">
					<input name="_token_comentarios" value="{{ csrf_token() }}" type="hidden">
					<input name="id_admin_comentarios" id="id_admin_comentarios" value="{{ Auth::user()->id }}" type="hidden">
					<input name="id_servicio_comentarios" id="id_servicio_comentarios" type="hidden">
					<input name="id_estatus_comentarios" id="id_estatus_comentarios" type="hidden">
					<button type="button" class="btn btn-grey btn-flat" data-dismiss="modal">
						Cerrar <span class="fas fa-times"></span>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>