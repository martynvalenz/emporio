<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-detalles">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h4 class="modal-title" style="color: white;">Detalles de Recibos: {{ $recibo->folio_recibo }}</h4>
			</div>
			<div class="modal-body">
				
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover table-responsive" id="table-detalle">
								<thead style="background-color: #0B3798; color:white">
									<tr>
										<th>Servicio</th>
										<th>Monto</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
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