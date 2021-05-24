import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '@/views/Home'
import Address from '@/views/Address'
import Create from '@/views/Create'
import Login from '@/views/Login'
import Register from '@/views/Register'
import Dashboard from '@/views/Dashboard'
import store from '@/store/index'
import { ToastProgrammatic as Toast } from 'buefy'



Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/register',
    name: 'Register',
    component: Register
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: Dashboard,
    beforeEnter: (to, from, next) => {
      if(!store.getters['auth/isAuthenticated']){
        return next({
          name: 'Login'
        })
      }
      next()
    }
  },
  {
    path: '/create',
    name: 'Create',
    component: Create,
    beforeEnter: (to, from, next) => {
      if(!store.getters['auth/isAuthenticated']){
        return next({
          name: 'Login'
        })
      }
      next()
    }
  },
  {
    path: '/address/:id',
    name: 'Address',
    component: Address,
    props: true,
    beforeEnter: (to, from, next) => {
      if(!store.getters['auth/isAuthenticated']){
        return next({
          name: 'Login'
        })
      }else if(!store.getters['auth/getUser'].reviews.length){

        Toast.open({
          duration: 5000,
          message: 'add a review to gain full access',
          type: 'is-warning'
        })

        return next({
          name: 'Create'
        })
      }
      next()
    }
  },
  {
    path: '/about',
    name: 'About',
    component: () => import(/* webpackChunkName: "about" */'@/views/About')
  },
  {
    path: '/terms',
    name: 'Terms',
    component: () => import(/* webpackChunkName: "terms" */'@/views/Terms')
  },
  {
    path: '/format',
    name: 'Format',
    component: () => import(/* webpackChunkName: "terms" */'@/views/Format')
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
