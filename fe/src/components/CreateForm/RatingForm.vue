<template>
  <div>
    <div class="is-size-3">Rating</div>
    <div class="card mb-3">
      <div class="card-content">
        <b-rate
          @change="submit()"
          class="rating-holder"
          spaced
          size="is-large"
          custom-text="Landlord"
          v-model="rating.landlord"
        ></b-rate>
      </div>
    </div>

    <div class="card mb-3">
      <div class="card-content">
        <b-rate
          @change="submit()"
          class="rating-holder"
          spaced
          size="is-large"
          custom-text="Premise"
          v-model="rating.premise"
        ></b-rate>
      </div>
    </div>

    <div class="card mb-3">
      <div class="card-content">
        <b-rate
          @change="submit()"
          class="rating-holder"
          spaced
          size="is-large"
          custom-text="Area"
          v-model="rating.area"
        ></b-rate>
      </div>
    </div>

    <div class="card mb-3">
      <div class="card-content">
        <b-rate
          @change="submit()"
          class="rating-holder"
          spaced
          size="is-large"
          custom-text="Transport"
          v-model="rating.transport"
        ></b-rate>
      </div>
    </div>

    <div class="card mb-3">
      <div class="card-content">
        <b-rate
          @change="submit()"
          class="rating-holder"
          spaced
          size="is-large"
          custom-text="Noise"
          v-model="rating.noise"
        ></b-rate>
      </div>
    </div>

    {{ createFormRating }}
  </div>
</template>

<script>
import { mapGetters, mapMutations } from "vuex"

export default {
  name: "RatingForm",
  computed: {
    ...mapGetters({
      rating: "createForm/getRating",
    }),
  },
  methods: {
    ...mapMutations({
      setRating: "createForm/setRating",
    }),
    submit() {
      this.setRating(this.rating)
    },
  },
}
</script>

<style scoped></style>
