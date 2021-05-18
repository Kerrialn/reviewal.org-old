<template>
  <div>
    {{ createFormReview }}
    <div class="is-size-3">Review</div>
    <b-field>
      <b-input
        @keyup.native="submit"
        v-model="review.title"
        placeholder="Review title"
      ></b-input>
    </b-field>
    <b-field>
      <b-input
        @keyup.native="submit"
        maxlength="200"
        type="textarea"
        v-model="review.summary"
        placeholder="summary"
      ></b-input>
    </b-field>
  </div>
</template>

<script>
import { mapGetters, mapMutations } from "vuex"

export default {
  name: "ReviewForm",
  computed: {
    ...mapGetters({
      review: "createForm/getReview",
    }),
  },
  methods: {
    ...mapMutations({
      setReview: "createForm/setReview",
    }),
    submit() {
      this.setReview(this.review)
    },
  },
}
</script>

<style></style>
