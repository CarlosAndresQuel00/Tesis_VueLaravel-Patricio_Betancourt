require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import VueSweetalert2 from "vue-sweetalert2"
Vue.use(VueSweetalert2)
import "sweetalert2/dist/sweetalert2.min.css"

import App from './components/App.vue'
import CommentsIndex from './components/Comments/Index.vue'
import CommentsCreate from './components/Comments/Create.vue'
import CommentsEdit from './components/Comments/Edit.vue'
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
      path: '/commentsIndex',
      component: CommentsIndex,
      name: 'comments.index',
      meta: {requiredAuth: true}
    },
    {
      path: '/commentsCreate',
      component: CommentsCreate,
      name: 'comments.create',
      meta: {requiredAuth: true}
    },
    {
      path: '/comments/edit/:id',
      component: CommentsEdit,
      name: 'comments.edit',
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
        return next({ path: "/commentsIndex" });
      }
    } else if (to.meta.requiredAuth) {
      if (!window.Laravel.isLoggedin) {
        return next({ path: "/login" });
      }
    }

    return next();
});

Vue.component('pagination', require('laravel-vue-pagination'));

const app = new Vue({
  el: '#app',
  components: { App },
  router
});
