require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import VueSweetalert2 from "vue-sweetalert2"
Vue.use(VueSweetalert2)
import "sweetalert2/dist/sweetalert2.min.css"

import App from './components/App.vue'

import Clients from './components/Clients/Client.vue'
import CommentsCreate from './components/Clients/Create.vue'
import SharedSpaces from './components/SharedSpaces/SharedSpace.vue'
import Memberships from './components/Memberships/Membership.vue'
import Assignments from './components/Assignments/Assignment.vue'
import Reserves from './components/Reserves/Reserve.vue'
import Payments from './components/Payments/Payment.vue'

import Register from './components/Pages/Register.vue'
import Login from './components/Pages/Login.vue'
import Home from './components/Pages/Home.vue'

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      component: Home,
      name: 'home',
      meta: {requiredAuth: false}
    },
    {
      path: '/clients',
      component: Clients,
      name: 'clients',
      meta: {requiredAuth: true}
    },
    {
      path: '/commentsCreate',
      component: CommentsCreate,
      name: 'comments.create',
      meta: {requiredAuth: true}
    },
    {
      path: '/sharedSpaces',
      component: SharedSpaces,
      name: 'sharedSpaces',
      meta: {requiredAuth: true}
    },
    {
      path: '/memberships',
      component: Memberships,
      name: 'memberships',
      meta: {requiredAuth: true}
    },
    {
      path: '/assignments',
      component: Assignments,
      name: 'assignments',
      meta: {requiredAuth: true}
    },
    {
      path: '/reserves',
      component: Reserves,
      name: 'reserves',
      meta: {requiredAuth: true}
    },
    {
      path: '/payments',
      component: Payments,
      name: 'payments',
      meta: {requiredAuth: true}
    },
    {
      path: '/register',
      component: Register,
      name: 'register',
      meta: {requiredAuth: false}
    },
    {
      path: '/login',
      component: Login,
      name: 'login',
      meta: {requiredAuth: false}
    },
  ]
});

router.beforeEach(async (to, from, next) => {
    if (to.fullPath == "/") {
      return next();
    } else if (!to.meta.requiredAuth) {
      if (window.Laravel.isLoggedin) {
        return next({ path: "/clients" });
      }
    } else if (to.meta.requiredAuth) {
      if (!window.Laravel.isLoggedin) {
        return next({ path: "/login" });
      }
    }

    return next();
});

//Vue.component('pagination', require('laravel-vue-pagination'));

const app = new Vue({
  el: '#app',
  components: { App },
  router
});
