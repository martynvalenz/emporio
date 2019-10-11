<template>
	<div>
		<toolbar></toolbar>
		<router-view></router-view>
		<app-footer></app-footer>
	</div>
</template>

<script>
	import toolbar from './Layouts/Toolbar'
	import AppFooter from './Layouts/AppFooter'

	export default{
		components:{toolbar, AppFooter}
	};
</script>

<style>
	.centered{
		text-align: center;
	}

	.router-linker:hover{
		text-decoration: none
	}

	.parallax{
		height: 100vh;
		width: 100%;
	}
</style>