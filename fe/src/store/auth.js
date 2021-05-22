import store from './index'
import { ToastProgrammatic as Toast } from 'buefy'
import axios from 'axios'

export default {
  namespaced: true,
  state:{
    user: null,
    token: null
  },
  getters:{
    getUser(state){
      return state.user
    },
    getToken(state){
      return state.token
    },
    getStatus(state){
      return state.token
    },
    isAuthenticated(state){
      return state.token && state.user
    },
  },
  actions:{
    async login({ dispatch }, credentials){

    store.commit('setLoading', true)
    let response = await axios.post('login', credentials).then(()=>{
      Toast.open({
        duration: 5000,
        message: 'Login successful',
        type: 'is-success'
      })
    })
      .catch(() =>{
        Toast.open({
          duration: 5000,
          message: 'Login failed',
          type: 'is-danger'
        })
          
    }).finally(()=>{
      store.commit('setLoading', false)
    });

    return dispatch('attempt', response.data.token)
    
    },
    async attempt({commit, state}, token){
      if(token){
        commit('setToken', token)
      }

      if(!state.token){
        return
      }

      try{
        let response = await axios.get('/profile')
        commit('setUser', response.data)
      }catch(e){
        Toast.open({
          duration: 5000,
          message: e,
          type: 'is-danger'
        })
        commit('setUser', null)
        commit('setToken', null)
      }
    },
    logout({commit}){
      store.commit('setLoading', true)
      localStorage.removeItem('token')
      commit('setUser', null)
      commit('setToken', null)
      store.commit('setLoading', false)
    },
    async register(_, form){

      store.commit('setLoading', true)
      return await axios.post('register', form).then(()=>{
        Toast.open({
          message: 'registration successful',
          type: 'is-success'
        })
      }).catch(()=>{
        Toast.open({
          message: 'registration failed',
          type: 'is-danger'
        })
      }).finally(()=>{
        store.commit('setLoading', false)
      });
    },
    
  },
  mutations: {
    setUser(state, newUserState){
      state.user = newUserState
    },
    setToken(state, newTokenState){
      state.token = newTokenState
    }
  },
}