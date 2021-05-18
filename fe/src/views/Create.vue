<template>
  <div class="container">
    <div class="columns is-centered is-mobile">
      <div class="column is-10-mobile is-8-desktop">
        <section>
          <div v-for="step in stages.steps" :key="step.id">
            <transition name="fade" mode="out-in">
              <div v-if="stages.current === step.id">
                <component v-bind:is="step.component"></component>
              </div>
            </transition>
          </div>

          <div class="controls">
            <b-button
              :disabled="stages.controls.previous.isDisabled"
              @click.native="previous()"
              type="is-primary is-light"
              icon-left="chevron-left"
            >
              previous
            </b-button>
            <b-button
              v-if="!stages.isLast"
              :disabled="stages.controls.next.isDisabled"
              @click.native="next()"
              type="is-primary is-light"
              icon-right="chevron-right"
            >
              next
            </b-button>
            <b-button v-else type="is-danger is-light" @click="send()"
              >submit</b-button
            >
          </div>
        </section>
      </div>
    </div>
  </div>
</template>

<script>
import AddressForm from "@/components/CreateForm/AddressForm"
import ReviewForm from "@/components/CreateForm/ReviewForm"
import RatingForm from "@/components/CreateForm/RatingForm"
import ConfirmationForm from "@/components/CreateForm/ConfirmationForm"
import { mapActions, mapGetters, mapMutations } from "vuex"

export default {
  name: "Create",
  components: {
    AddressForm,
    ReviewForm,
    RatingForm,
    ConfirmationForm,
  },
  data() {
    return {}
  },
  watch: {
    current() {
      if (this.current <= 1) {
        this.setIsPreiousDisabled(true)
      } else {
        this.setIsPreiousDisabled(false)
      }

      if (this.current >= this.stages.steps.length) {
        this.setIsLast(true)
        this.setIsNextDisabled(true)
      } else {
        this.setIsLast(false)
        this.setIsNextDisabled(false)
      }
    },
  },
  computed: {
    ...mapGetters({
      createFormAddress: "createForm/getAddress",
      createFormReview: "createForm/getReview",
      createFormRating: "createForm/getRating",
      stages: "createForm/getStages",
    }),
    current() {
      return this.stages.current
    },
  },
  methods: {
    ...mapMutations({
      setIsPreiousDisabled: "createForm/setIsPreviousDisabled",
      setIsNextDisabled: "createForm/setIsNextDisabled",
      setIsLast: "createForm/setIsLast",
    }),
    ...mapActions({
      storeReview: "reviews/store",
      previous: "createForm/previous",
      next: "createForm/next",
      // submit: "createForm/submit",
    }),
    send() {
      alert("SUBMITED!")
    },
  },
}
</script>

<style scoped>
.controls {
  margin-top: 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
</style>
