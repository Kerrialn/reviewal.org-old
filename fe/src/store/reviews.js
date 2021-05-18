import axois from 'axios'
import store from './index'

export default {
  namespaced: true,
  state:{
    reviews: [],
    review: {},
  },
  getters:{
    getReview(state){
      return state.review
    },
    getReviews(state){
      return state.reviews
    }
  },
  actions:{
    async fetchReviews({commit}){
      store.commit('setLoading', true)
      await axois.get('reviews').then((response)=>{
        commit('setReviews', response.data)
        store.commit('setLoading', false)
      })
      store.commit('setLoading', false)
    },
    async store(_, form){
      store.commit('setLoading', true)
      await axois.post('reviews', form);
      store.commit('setLoading', false)
    
    }
  },
  mutations: {
    setReview(state, newReviewState){
      state.review = newReviewState
    },
    setReviews(state, newReviewsState){
      state.reviews = newReviewsState
    }
  },
}