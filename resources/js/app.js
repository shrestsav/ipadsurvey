require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'

import pageone from './components/pageone.vue'
import pagetwo from './components/pagetwo.vue'


Vue.use(VueRouter)

const routes = [
  { path: '/pageone', component: pageone },
  { path: '/pagetwo', component: pagetwo }
]

const router = new VueRouter({
  routes // short for `routes: routes`
})

const app = new Vue({
    el: '#app',
    router
});
