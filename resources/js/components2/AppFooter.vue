<template>
	<div>
		<div id="subscribe" class="section-container bg-grey-transparent-6 p-t-30 p-b-30">
			<!-- BEGIN container -->
			<div class="container">
				<!-- BEGIN row -->
				<div class="row">
					<!-- BEGIN col-6 -->
					<div class="col-md-8 col-sm-8">
						<!-- BEGIN subscription -->
						<div class="subscription">
							<div class="subscription-intro">
								<h4> NEWSLETTER</h4>
								<p>Suscríbete para obtener noticias y promociones</p>
							</div>
							<div class="subscription-form">
								<form name="subscription_form" action="index.html" method="POST">
									<div class="input-group">
										<input type="text" class="form-control" name="email" placeholder="Correo electrónico" />
										<div class="input-group-append">
											<button type="submit" class="btn btn-inverse"><i class="fa fa-angle-right"></i></button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<!-- END subscription -->
					</div>
					<!-- END col-6 -->
					<!-- BEGIN col-6 -->
					<div class="col-md-4 col-sm-4">
						<!-- BEGIN social -->
						<div class="social">
							<div class="social-intro">
								<h4>Síguenos</h4>
								<p>En nuestras redes sociales</p>
							</div>
							<div class="social-list">
								<a href="https://www.facebook.com/EmporioLegal" target="_blank"><i class="fab fa-facebook"></i></a>
								<a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
							</div>
						</div>
						<!-- END social -->
					</div>
					<!-- END col-6 -->
				</div>
				<!-- END row -->
			</div>
			<!-- END container -->
		</div>
		<div class="footer">
			<!-- BEGIN container -->
			<div class="container">
				<!-- BEGIN row -->
				<div class="row">
					<!-- BEGIN col-3 -->
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<iframe width="100%" height="300" frameborder="1" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJ70GqFEdD6oYRT-QDPBT1S-A&key=AIzaSyBN1q_gPSKedvNCqDXmkb2qLI2Sl587f_g" allowfullscreen></iframe>
						<h4 class="footer-header">EMPORIO LEGAL</h4>
						<address>
							Estrada Bocanegra #1706<br />
							Colonia San Felipe I Etapa, CP 31203 <br />
							Chihuahua, Chihuahua, México<br />
							<br />
							<abbr title="Teléfono">Teléfono:</abbr> <i class="fas fa-phone"></i> +52 (614) 410 - 2482<br />
							<abbr title="Email">Email: </abbr><a href="mailto:operaciones@marcasyfranquicias.org"> <i class="fas fa-envelope"></i> operaciones@marcasyfranquicias.org</a><br>
							<p>Horarios: <i class="fas fa-clock"></i> Lunes a Viernes de 9:00 - 15:00 y 16:00 - 18:00</p>
						</address>
					</div>
					<div class="col-xl-1 col-lg-1 col-md-1">
					</div>
					<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12">
						<h4 class="footer-header">CONTACTO</h4>
						<form action="">
							<div class="form-group">
								<label>Nombre <b style="color: red">*</b></label>
								<div class="form-input">
									<input type="text" class="form-control" name="nombre">
								</div>
							</div>
							<div class="form-group">
								<label>Teléfono <b style="color: red">*</b></label>
								<div class="form-input">
									<input type="text" class="form-control" name="telefono">
								</div>
							</div>
							<div class="form-group">
								<label>Correo <b style="color: red">*</b></label>
								<div class="form-input">
									<input type="email" class="form-control" name="correo">
								</div>
							</div>
							<div class="form-group">
								<label>Comentarios <b style="color: red">*</b></label>
								<div class="form-input">
									<textarea name="comentarios" id="comentarios" rows="4" class="form-control"></textarea>
								</div>
							</div>
							<br>
							<button type="submit" class="btn btn-primary btn-block">Enviar <i class="fas fa-paper-plane"></i></button>
						</form>
					</div>
				</div>
				<!-- END row -->
			</div>
			<!-- END container -->
		</div>
		
		<div id="footer-copyright" class="footer-copyright">
			<!-- BEGIN container -->
			<div class="container">
				<div class="payment-method">
					<i class="fab fa-cc-paypal fa-3x"></i> <i class="fab fa-cc-mastercard fa-3x"></i> <i class="fab fa-cc-visa fa-3x"></i>
				</div>
				<div class="copyright">
					<a href="https://goprofit.org" target="_blank" style="color: silver"><img src="/images/clients/loGoProfit.png" alt="" style="height: 20px; width: auto;"> GoProfit</a> &copy; 2019. Todos los derechos reservados.
				</div>
			</div>
			<!-- END container -->
		</div>
	</div>
</template>

<script>
	export default{

	};
</script>