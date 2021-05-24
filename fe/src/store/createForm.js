import store from './index'
import AddressAutocompleteForm from "@/components/CreateForm/AddressAutocompleteForm"
import AddressForm from "@/components/CreateForm/AddressForm"
import ReviewForm from "@/components/CreateForm/ReviewForm"
import RatingForm from "@/components/CreateForm/RatingForm"
import ConfirmationForm from "@/components/CreateForm/ConfirmationForm"
import { ToastProgrammatic as Toast } from 'buefy'
import axois from 'axios'

export default {
  namespaced: true,
  state:{
    stages: {
      isLast: false,
      current: 1,
      controls:{
        previous:{
          isDisabled: false
        },
        next:{
          isDisabled: false
        },
      },
      steps: [
        {
          id: 1,
          label: "Address",
          component: AddressAutocompleteForm || AddressForm,
          displayed: true,
        },
        {
          id: 2,
          label: "Review",
          component: ReviewForm,
          displayed: true,
        },
        {
          id: 3,
          label: "Rating",
          component: RatingForm,
          displayed: true,
        },
        {
          id: 4,
          label: "Affidavit",
          component: ConfirmationForm,
          displayed: true,
        },
      ],
    },
    address: {
      premise: '',
      floor: 0,
      line_one: '',
      city: '',
      postal_code: '',
      country_code: '',
    },
    review: {
      title: '',
      summary: ''
    },
    rating: {}
  },
  getters:{
    getAddress(state){
      return state.address
    },
    getReview(state){
      return state.review
    },
    getRating(state){
      return state.rating
    },
    getStages(state){
      return state.stages
    },
    getActive(state){
      return state.stages.active
    },
    isPreviousDisabled(state){
      return state.stages.controls.previous.isDisabled
    },
    isNextDisabled(state){
      return state.stages.controls.next.isDisabled
    },
  },
  actions:{
    previous({commit, state}) {
      if (!state.stages.controls.previous.isDisabled) {
        commit('setActive', state.stages.current-- );
      }
    },
    next({commit, state}) {
      if (!state.stages.controls.next.isDisabled) {
        commit('setActive', state.stages.current++ );
      }
    },
    async submit(_, form){
        store.commit('setLoading', true)
        return await axois.post('create', form).then(()=>{
          Toast.open({
            message: `Review created <b>successfully</b>`,
            type: 'is-success'
          })
          store.commit('setLoading', false)
        }).catch((e)=>{
          console.log(e)
          Toast.open({
            message: e.message,
            type: 'is-danger'
          })
        }).finally(()=>{
          store.commit('setLoading', false)
        })
      },
      resetForm(){
        this.setAddress({})
        this.setReview({})
        this.setRating({})
      }
    },
  mutations: {
    setActive(state, newActiveState){
      state.stages.active = newActiveState
    },
    setIsLast(state, newIsLastState){
      state.stages.isLast = newIsLastState
    },
    setIsPreviousDisabled(state, newPreviousState){
      state.stages.controls.previous.isDisabled = newPreviousState
    },
    setIsNextDisabled(state, newNextState){
      state.stages.controls.next.isDisabled = newNextState
    },
    setAddress(state, newAddressState){
      state.address = newAddressState
    },
    setAddressComponent(state, newAddressComponentState){
      state.stages.steps[0].component = newAddressComponentState
    },
    setReview(state, newReviewState){
      state.review = newReviewState
    },
    setRating(state, newRatingState){
      state.rating = newRatingState
    }
  },
}