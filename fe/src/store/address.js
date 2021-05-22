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
    async store({commit}, form){
      console.log(form);
      store.commit('setLoading', true)
      await axois.post('addresses', form).then((response)=>{
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
        premise: params[0] ?? '',
        floor: params[1] ?? '',
        lineOne: params[2] ?? '',
        lineTwo: params[3] ?? '',
        district: params[4] ?? '',
        city: params[5] ?? '',
        postalCode: params[6] ?? '',
        countryCode: params[7] ?? '',

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