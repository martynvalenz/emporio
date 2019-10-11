import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import HomePage from './components/Page/HomePage'
import Category from './components/Page/CategoryService'

const routes = [
 	{ path: '/', name: 'home', component: HomePage },
 	{ path: '/categoria/:slug', component: Category, name: 'category' }
]


const router = new VueRouter({
	routes, // short for `routes: routes`
	hashbang : false,
	mode: 'history'
})

export default router