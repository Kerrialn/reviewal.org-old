import Vue from 'vue'
import Vuex from 'vuex'
import auth from './auth'
import reviews from './reviews'
import address from './address'
import createForm from './createForm'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    loading: false,
    message: {
      content: null,
      type: null
    }
  },
  mutations: {
    setLoading(state, newLoadingState){
      state.loading = newLoadingState
    },
    setMessage(state, newMessageState){
      state.message = newMessageState
    }
  },
  getters:{
    getLoading(state){
      return state.loading
    },
    getMessage(state){
      return state.message
    }
  },
  actions: {
  },
  modules: {
    auth,
    reviews,
    address,
    createForm
  }
})
