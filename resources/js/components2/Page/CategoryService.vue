<template>
	<div>
		<div id="home" class="content has-bg home" style="background-image: url('/images/category/chdefault.jpg'); center 0 / cover no-repeat; width: 100%; background-attachment: fixed; background-repeat: no-repeat; background-size: cover;">
			<div class="container home-content">
				<!-- <p>
					We have created a multi-purpose theme that take the form of One-Page or Multi-Page Version.<br />
					Use our <a href="#">theme panel</a> to select your favorite theme color.
				</p> -->
				<a href="#about" data-click="scroll-to-target" data-scroll-target="#about" class="btn btn-white">VER MÁS <i class="fas fa-arrow-down"></i></a> 
				<a href="#" class="btn btn-primary">REGISTRO</a><br />
				<br />
				o <a href="#">subscribirse</a> a nuestro newsletter
				<br>
				<a id="tohash" href="#about"><i class="fa fa-angle-down fa-3x" style="color: white"></i></a>
			</div>
			<!-- end container -->
		</div>
	</div>
</template>

<script>
	export default{
		//props: ['data'],
		data()
		{
			return{
				category: null
			}
		},
		created(){
			this.getCategory();


		},
		methods:
		{
			getCategory()
			{
				axios.get(`/categoria/show/${this.$route.params.slug}`)
				.then(res => this.category = res.data.data)
			}
		}
	};
</script>