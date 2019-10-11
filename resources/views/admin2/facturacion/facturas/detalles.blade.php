<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-detalles">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #218CBF">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h4 class="modal-title" style="color: white;">Detalles de Factura: </h4>
				<input type="hidden" id="id_factura_detalles">
			</div>
			<div class="modal-body">
				
				<div id="listado-detalles-table"></div>
				
			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-md-offset-8 col-md-4 col-sm-12 col-xs-12">
						<div class="table-responsive" style="font: bold; border: 1px solid #D2D6DF;">
							<table class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%" >
								<tbody style="font-size: 18px">
									<tr id="totales-carrito">
										<td>Subtotal</td>
										<td align="right" id="subtotal_detalles"></td>
									</tr>
									<tr>
										<td>IVA</td>
										<td align="right" id="iva_detalles"></td>
									</tr>
									<tr>
										<td>Total</td>
										<td align="right" id="total_detalles"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<hr>
				<div class="row pull-right">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<button class="btn btn-gris btn-flat" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>