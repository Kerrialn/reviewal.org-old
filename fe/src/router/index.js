import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '@/views/Home'
import Address from '@/views/Address'
import Create from '@/views/Create'
import Login from '@/views/Login'
import Register from '@/views/Register'
import store from '@/store/index'

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
    props: true
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
