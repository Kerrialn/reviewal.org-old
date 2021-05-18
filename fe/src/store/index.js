import Vue from 'vue'
import Vuex from 'vuex'
import reviews from './reviews'
import address from './address'
import createForm from './createForm'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    loading: false
  },
  mutations: {
    setLoading(state, newLoadingState){
      state.loading = newLoadingState
    }
  },
  getters:{
    getLoading(state){
      return state.loading
    }
  },
  actions: {
  },
  modules: {
    reviews,
    address,
    createForm
  }
})
