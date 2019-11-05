<template>
		<!-- <div>
			<v-navigation-drawer 
			persistent 
			:clipped="clipped" 
			v-model="drawer" 
			enable-resize-watcher 
			app 
			class="drawer-button"
			fixed>
	            <v-list dense>
	            </v-list>
	        </v-navigation-drawer>
			<v-toolbar dense color="black" dark fixed>
				<v-toolbar-side-icon class="drawer-button" @click.stop="drawer = !drawer"></v-toolbar-side-icon>
			    <v-toolbar-title>
			    	<router-link class="router-linker" to="/">
			    		<img src="/images/logos/pre copeo.png" style="height: 35px; width: auto" alt="">
			    	</router-link>
			    	
			    </v-toolbar-title>
			    <v-spacer></v-spacer>
			    <div class="bg-menu">
			    	<v-menu open-on-hover offset-y>
			    		<template v-slot:activator="{ on }">
			    			<v-btn flat v-on="on">TORNEOS <i class="fas fa-caret-down" style="padding-left: 0.5em"></i></v-btn>
			    		</template>
			    		<v-list>
			    		    <v-list-tile
			    		        v-for="(item, index) in items"
			    		        :key="index"
			    		        :to="{name: item.to}"
			    		        class="router-linker"
			    		        color="amber accent-4"
			    		        >
			    		        <v-list-tile-title><i :class="item.icon" style="padding-right: 1em;"></i>{{ item.title }}</v-list-tile-title>
			    		    </v-list-tile>
			    		</v-list>
			    	</v-menu>
			    </div>
			    <div class="bg-menu">
			    	
			    	<v-btn flat>ESTADÍSTICAS</v-btn>
			    	<v-btn flat>FANTASY SPORTS</v-btn>
			    	<v-btn flat>PATROCINADORES</v-btn>
			    	<v-btn flat @click="$vuetify.goTo('#contacto')">CONTACTO</v-btn>
			    	<router-link to="/registro" class="router-linker">
				    	<v-btn color="amber accent-4">
				    	    <i class="fas fa-user-plus" style="padding-right: 1em"></i> REGISTRO
				    	</v-btn>
				    </router-link>
			    	<router-link to="/login" class="router-linker">
				    	<v-btn color="grey darken-3">
				    	    <i class="fas fa-user" style="padding-right: 1em"></i>LOGIN
				    	</v-btn>
				    </router-link>
			    </div>
			</v-toolbar>
		</div> -->
</template>

<script>
	export default{
		data(){
			return{
				drawer: false,
				clipped: true,
				// items: [
				// {
				//     title: 'Tocho',
				//     icon: 'fas fa-football-ball',
				//     to: 'tocho'
				// },
				// {
				//     title: 'Fútbol',
				//     icon: 'fas fa-futbol',
				//     to: 'futbol'
				// }]
			}
		}
	};
</script>

<style>
	@media (min-width: 1200px)
	{
		.drawer-button{
			display: none;
		}
	}

	@media (max-width: 1199px)
	{
		.bg-menu{
			display: none;
		}
	}

	
</style>