<template>
    <div>
        <b-field
            :type="isTitleValid ? 'is-success' : 'is-danger'"
            :message="{
                'title must be at least 3 characters': !isTitleValid
            }"
        >
            <b-input
                v-model="review.title"
                placeholder="Review title"
                type="is-success"
                message="This username is available"
            >
                ></b-input
            >
        </b-field>
        <b-field
            :type="isSummaryValid ? 'is-success' : 'is-danger'"
            :message="{
                'summary must me at least 50 characters': !isSummaryValid
            }"
        >
            <b-input
                maxlength="250"
                type="textarea"
                v-model="review.summary"
                placeholder="summary"
            ></b-input>
        </b-field>
        <p>
            *This will be publicly accessable information, do not reveal any
            private or confidential information.
        </p>
    </div>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";

export default {
    name: "ReviewForm",
    mounted() {
        !this.isFormValid ? this.setIsNextDisabled(true) : this.completeStep();
    },
    watch: {
        review: {
            handler() {
                !this.isFormValid
                    ? this.setIsNextDisabled(true)
                    : this.completeStep();
            },
            deep: true
        }
    },
    computed: {
        ...mapGetters({
            review: "createForm/getReview"
        }),
        title() {
            return this.review.title;
        },
        summary() {
            return this.review.summary;
        },
        isFormValid() {
            return this.isTitleValid && this.isSummaryValid;
        },
        isTitleValid() {
            return this.review.title.length >= 3;
        },
        isSummaryValid() {
            return this.review.summary.length >= 50;
        }
    },
    methods: {
        ...mapMutations({
            setReview: "createForm/setReview",
            setIsNextDisabled: "createForm/setIsNextDisabled",
            setIsPreviousDisabled: "createForm/setIsPreviousDisabled"
        }),
        completeStep() {
            this.setIsNextDisabled(false);
            this.setReview(this.review);
        }
    }
};
</script>

<style></style>
