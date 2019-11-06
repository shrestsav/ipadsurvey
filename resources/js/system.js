// require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'

import pageone from './components/pageone.vue'
import pagetwo from './components/pagetwo.vue'
import dashboard from './components/dashboard.vue'


Vue.use(VueRouter)

const routes = [
  { path: '/', component: dashboard },
  { path: '/pageone', component: pageone },
  { path: '/pagetwo', component: pagetwo }
]

const router = new VueRouter({
	// mode: 'history',
  	routes // short for `routes: routes`
})

const app = new Vue({
    el: '#app',
    router,
});
