import AddressForm from "@/components/CreateForm/AddressForm"
import ReviewForm from "@/components/CreateForm/ReviewForm"
import RatingForm from "@/components/CreateForm/RatingForm"
import ConfirmationForm from "@/components/CreateForm/ConfirmationForm"

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
          component: AddressForm,
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
          label: "Confirmation",
          component: ConfirmationForm,
          displayed: true,
        },
      ],
    },
    address: {},
    review: {},
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
    submit(){
      
    },
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
    setReview(state, newReviewState){
      state.review = newReviewState
    },
    setRating(state, newRatingState){
      state.rating = newRatingState
    }
  },
}