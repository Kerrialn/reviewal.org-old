import axois from 'axios'
import store from './index'

export default {
  namespaced: true,
  state:{
    addresses: [],
    address: {},
  },
  getters:{
    getAddress(state){
      return state.address
    },
    getAddresses(state){
      return state.addresses
    }
  },
  actions:{
    async store({commit}, query){
      store.commit('setLoading', true)
      let params = query.split(',');
      await axois.post('addresses', {
        lineOne: params[0],
        lineTwo: params[1] ?? '',
        district: params[2] ?? '',
        city: params[3] ?? '',
        postalCode: params[4] ?? '',
        countryCode: params[5] ?? '',
      }).then((response)=>{
        commit('setAddresses', response.data)
        store.commit('setLoading', false)
      })
      store.commit('setLoading', false)
    },
    async search({commit}, query){
      let params = query.split(',');

      store.commit('setLoading', true)
      await axois.post('search',
      {
        lineOne: params[0],
        lineTwo: params[1] ?? '',
        district: params[2] ?? '',
        city: params[3] ?? '',
        postalCode: params[4] ?? '',
        countryCode: params[5] ?? '',

      }).then((response)=>{
        commit('setAddresses', response.data)
        store.commit('setLoading', false)
      })
      store.commit('setLoading', false)
    },
    async fetchAddress({commit}, id){
      store.commit('setLoading', true)
      await axois.get('addresses/' + id ).then((response)=>{
        console.log(response.data);
        commit('setAddress', response.data)
        store.commit('setLoading', false)
      })
      store.commit('setLoading', false)
    }
  },
  mutations: {
    setAddress(state, newAddressState){
      state.address = newAddressState
    },
    setAddresses(state, newAddressesState){
      state.addresses = newAddressesState
    }
  },
}