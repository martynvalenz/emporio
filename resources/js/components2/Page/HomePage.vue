<template>
	<div>
		<div id="slider" class="section-container p-0 bg-black-darker">
			<!-- BEGIN carousel -->
			<div id="main-carousel" class="carousel slide" data-ride="carousel">
				<!-- BEGIN carousel-inner -->
				<div class="carousel-inner">
					<!-- BEGIN item -->
					<div class="carousel-item active" data-paroller="true" data-paroller-factor="0.3" data-paroller-factor-sm="0.01" data-paroller-factor-xs="0.01" style="background: url(images/slider/emporio-slide.jpg) center 0 / cover no-repeat;">
						<div class="container">
							<img src="" class="product-img right bottom fadeInRight animated" alt="" />
						</div>
						<div class="carousel-caption carousel-caption-left">
						</div>
					</div>
					<!-- END item -->
					<!-- BEGIN item -->
					<div class="carousel-item" data-paroller="true" data-paroller-factor="-0.3" data-paroller-factor-sm="0.01" data-paroller-factor-xs="0.01" style="background: url('images/slider/registro.jpg') center 0 / cover no-repeat;">
						<div class="container">
						</div>
						<div class="carousel-caption carousel-caption-right">
							<div class="container" style="text-shadow: 2px 2px 3px #666;">
								<h3 class="title m-b-5 fadeInRightBig animated">Protege tu propiedad intelectual</h3>
								<p class="m-b-15 fadeInRightBig animated">No esperes a que sea demasiado tarde, proteje tus obras o productos. Patenta con nosotros de forma nacional o internacional.</p>
								<a href="product_detail.html" class="btn btn-primary btn-lg fadeInRightBig animated">Ver Más</a>
							</div>
						</div>
					</div>
				</div>
				<!-- END carousel-inner -->
				<a class="carousel-control-prev" href="#main-carousel" data-slide="prev"> 
				<i class="fa fa-angle-left"></i> 
				</a>
				<a class="carousel-control-next" href="#main-carousel" data-slide="next"> 
				<i class="fa fa-angle-right"></i> 
				</a>
			</div>
			<!-- END carousel -->
		</div>
		
		<!-- BEGIN #tablet-list -->
		<div id="tablet-list" class="section-container bg-silver p-t-30">
			<!-- BEGIN container -->
			<div class="container">
				<!-- BEGIN section-title -->
				<h3 class="section-title clearfix">
					<a href="#" class="pull-right">Mostrar todos</a>
					Servicios
					<small>Consulta nuestra amplia gama de servicios</small>
				</h3>
				<div class="row">
					<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12" v-for="category in categories" :key="category.path" :data=category>
						<div class="widget widget-stats bg-gradient-blue">
							<div class="stats-icon stats-icon-lg"><i v-bind:class="category.icon" class="fa-fw"></i></div>
							<div class="stats-content">
								<div class="stats-title">{{ category.categoria }}</div>
								<div class="stats-number"></div>
								<div class="stats-progress progress">
									<div class="progress-bar" style="width: 100%;"></div>
								</div>
								<div class="stats-desc"><router-link :to="category.path"><a class="btn btn-white">Ver más</a></router-link></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="section-container bg-white p-t-30">
			<div class="container">
				<div class="row">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<h3 class="title-riesgo">Riesgos de NO registrar mis creaciones</h3>
						<br>
						<div class="paragraph-text">
							<p><b>1.</b> Pierdo el derecho a su uso exclusivo</p>
							<p><b>2.</b> Me expongo a la “piratería”.</p>
							<p><b>3.</b> Alguien más sin autorización, se aprovechará de mi prestigio.</p>
							<p><b>4.</b> Otras personas me prohibirán utilizarla.</p>
							<p><b>5.</b> No obtendré el instrumento que me permitirá ejecutar acciones legales en contra de los plagiarios: Título de Registro.</p>
							<p><b>6.</b> No podré convertirlas en “activos intangibles” para  poder venderse, licenciarse o transmitirse.</p>
							<br>
							<p><b>Nota: </b> No creas que las marcas solo se refieren a productos, por igual las marcas que se registran se refieren a nombres de negocios.</p>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<img src="images/page/inicio-copyright.jpg" alt="" width="100%">
					</div>
				</div>
			</div>
			<!-- <br>
			<div class="container bg-blue-darker">
				
			</div> -->
		</div>

		<div class="section-container p-b-20">
			<div  style="background: url('images/page/sub04_01_img1.jpg') center 0 / cover no-repeat; width: 100%; background-attachment: fixed; background-repeat: no-repeat; background-size: cover;">
				<div class="bg-blue-darker conocenos_mas" style="background-size: cover; position:relative; top:0; left:0">
					<div class="row" style="height: 100%">
						<div class="col-xl-1 col-lg-1 col-md-1">
							
						</div>
						<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 ">
							<div class="container">
								<div class="row text-white">
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-blue-darker p-t-30">
										<h1>CONÓCENOS MÁS</h1>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 bg-blue-darker p-t-30">
										<span class="fas fa-award fa-4x text-blue"></span>
										<br>
										<div class="paragraph-text-white">
											<h5 class="text-blue">¿Por qué trabajar con nosotros?</h5>
											<p clss="">- Calidad y Calidez en el Servicio. <br>
											- Eficacia Comprobada. <br>
											- Acompañamiento de Principio a Fin en tus tramites. <br>
											- Nos convertimos sin costo en tu despacho de Propiedad Intelectual.</p>
										</div>
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 bg-blue-darker p-t-30">
										<span class="fas fa-users fa-4x text-blue"></span>
										<br>
										<div class="paragraph-text-white">
											<h5 class="text-blue">Nuestra historia</h5>
											<p clss="">Fue creado como tal el 2 de mayo de 2006, sin embargo se contaba ya con experiencia de 5 años en materia de Propiedad Intelectual por nuestro director el Lic. Allan José Parra Vargas.</p>
										</div>
									</div>
								</div>
								<div class="row text-white">
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 bg-blue-darker p-t-30">
										
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 bg-blue-darker p-t-30">
										
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-1 col-lg-1 col-md-1">
							
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="section-container">
			<div class="container">
				<div class="row">
					<h3 class="text-blue">
						¿Sabías que...?
					</h3>
				</div>
				<br>
				<div class="row">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<p>
							<b class="text-blue">Si no registras tu marca</b> pierdes el derecho a su uso exclusivo.
							Cualquier competidor podría copiar tu nombre e imagen sin poder exigirle que deje de hacerlo, se aprovecharía de tu prestigio haciéndole pensar a público consumidor que se trata del mismo producto o brindan el mismo servicio.
						</p>
						<p>
							<b class="text-blue">Si no registras tu marca</b> no podrías convertirla en “activo intangible” de tu empresa.
							Porque sin tu Título de Registro no podrías pedirle al Corredor Público un avalúo certificado de tu marca, para dejarla como prenda en garantía en algún Banco o para poderla vender, licenciar o hasta para franquiciar tu negocio.
						</p>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<p>
							<b class="text-blue">Si no registras tu marca</b> otras personas te pudieran prohibir utilizarla si la solicitan a registro primero que tú.
						</p>
						<p>
							Si te demandan por usar una marca registrada, el pago de daños y perjuicios <b class="text-blue">en ningún caso será inferior al 40% del precio</b> de venta al público de cada producto o la prestación de servicios, además de una multa que impone el IMPI de hasta 20 mil días de salario mínimo general vigente para la Ciudad de México. El Título de Registro es el instrumento que me permite ejecutar acciones legales en contra de los plagiarios.
						</p>
					</div>
				</div>
			</div>
		</div>

		<div class="section-container" style="background: url('images/page/marcas-valiosa-01.jpg') center 0 / cover no-repeat; width: 100%; background-attachment: fixed; background-repeat: no-repeat; background-size: cover; height: 300px;">
			<div class="container" style="text-align: center; text-shadow: 1px 1px 2px #666;">
				<div class="row">
					<div class="col-sm-12">
						<h2>Las 3 marcas más valiosas del mundo:</h2>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<h4>Apple (178,119 MDD)</h4>
						<h4>Google (133,252 MDD)</h4>
						<h4>Coca Cola (73,102 MDD)</h4>
					</div>
				</div>
			</div>
		</div>
		
		<div id="policy" class="section-container p-t-30 p-b-30">
			<div class="container-fluid" data-animation="true" data-animation-type="fadeInDown">
				<h3 class="section-title clearfix" style="text-align: center">
					Nuestras Alianzas
				</h3>
				<p class="content-desc">
					
				</p>
				<div class="customer-logos owl-carousel brands">

					<div class="item"><img style="max-height: 70px; width: auto; margin-left: auto; margin-right: auto;" src="images/alianzas/canaco.png"></div>
					<div class="item"><img style="max-height: 70px; width: auto; margin-left: auto; margin-right: auto;" src="images/alianzas/canacintra-chihuahua.png"></div>
					<div class="item"><img style="max-height: 70px; width: auto; margin-left: auto; margin-right: auto;" src="images/alianzas/bni.png"></div>
					<div class="item"><img style="max-height: 70px; width: auto; margin-left: auto; margin-right: auto;" src="images/alianzas/evm_chihuahua.png"></div>
					<div class="item"><img style="max-height: 70px; width: auto; margin-left: auto; margin-right: auto;" src="images/alianzas/logo-amf.png"></div>
					<div class="item"><img style="max-height: 70px; width: auto; margin-left: auto; margin-right: auto;" src="images/alianzas/Imagen1-1.jpg"></div>
					<div class="item"><img style="max-height: 70px; width: auto; margin-left: auto; margin-right: auto;" src="images/alianzas/fyf.png"></div>
				</div>
			</div>
			<!-- END container -->
		</div>
	</div>
</template>

<script>
	export default{
		data(){
			return {
				categories: {}
			}
		},

		created()
		{
			axios.get('/categoria-servicios')
			.then(res => this.categories = res.data.data)
			.catch(error => console.log(error.response.data))
		}
	};
</script>

<style>
	.paragraph-text{
		font-size: 15px;
	}

	.paragraph-text-white{
		font-size: 15px;
		color:white;
		padding-top: 15px;
	}

	.paragraph-text > p > b{
		color: #4167b1;
	}

	.title-riesgo{
		color: #4167b1;
	}

	@media(max-width: 767px)
	{
		.conocenos_mas{
			width: 100%;
		}
	}

	@media (min-width: 768px){
		.conocenos_mas{
			width: 60%;
		}
	}
	
	.stats-number{
		height: 20px;
	}
	
</style>






