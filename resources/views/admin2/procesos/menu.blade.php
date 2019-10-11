<div class="modal fade modal-slide-in-right" aria-text="true" role="dialog" tabindex="-1" id="menu">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="color: white; background-color: #008CC2">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-text="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h4 class="modal-title" id="menu-title"></h4>
				<input type="hidden" id="id_servicio_menu" name="id_servicio_menu" style="color: black">
			</div>
			<div class="tabpanel">
				<ul class="nav nav-tabs" role="tablist">
					<li id="tab_comisiones" class="active" role="presentation"><a href="#comisiones" aria-controls="comisiones" role="tab" data-toggle="tab"><i class="fas fa-hand-holding-usd"></i> Comisiones</a></li>
					<li id="tab_facturas" role="presentation"><a href="#facturas" aria-controls="facturas" role="tab" data-toggle="tab"><i class="far fa-file-pdf"></i> Facturas</a></li>
					<li id="tab_recibos" role="presentation"><a href="#recibos" aria-controls="recibos" role="tab" data-toggle="tab"><i class="fas fa-ticket-alt"></i> Recibos</a></li>
					<li id="tab_cobranza" role="presentation"><a href="#cobranza" aria-controls="cobranza" role="tab" data-toggle="tab"><i class="far fa-money-bill-alt"></i> Cobranza</a></li>
					<li id="tab_detalles" role="presentation"><a href="#detalles" aria-controls="detalles" role="tab" data-toggle="tab"><i class="fas fa-bars"></i> Detalles</a></li>
				</ul>
			</div> 
			<div class="tab-content">
				<!--Comisiones-->
				<div id="comisiones" role="tabpanel" class="tab-pane active">
					@include('admin.procesos.comisiones')
				</div>
				<!--Facturas-->
				<div id="facturas" role="tabpanel" class="tab-pane">
					@include('admin.procesos.facturas')
				</div>
				<!--Recibos-->
				<div id="recibos" role="tabpanel" class="tab-pane">
					@include('admin.procesos.recibos')
				</div>
				<!--Cobranza-->
				<div id="cobranza" role="tabpanel" class="tab-pane">
					@include('admin.procesos.ingresos')
				</div>
				<!--Detalles-->
				<div id="detalles" role="tabpanel" class="tab-pane">
					Detalles
				</div>
			</div>
		</div>
	</div>
</div>


