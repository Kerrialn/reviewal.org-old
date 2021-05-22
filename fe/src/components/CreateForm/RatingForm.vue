<template>
    <div>
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
    </div>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";

export default {
    name: "RatingForm",
    mounted() {
        !this.landlord || !this.premise || !this.area || !this.noise
            ? this.setIsNextDisabled(true)
            : this.setIsNextDisabled(false);
    },
    watch: {
        rating: {
            handler() {
                !this.landlord || !this.premise || !this.area || !this.noise
                    ? this.setIsNextDisabled(true)
                    : this.setIsNextDisabled(false);
            },
            deep: true
        }
    },
    computed: {
        ...mapGetters({
            rating: "createForm/getRating"
        }),
        landlord() {
            console.log(this.rating.landlord);
            return this.rating.landlord;
        },
        premise() {
            return this.rating.premise;
        },
        area() {
            return this.rating.area;
        },
        noise() {
            return this.rating.noise;
        }
    },
    methods: {
        ...mapMutations({
            setRating: "createForm/setRating",
            setIsNextDisabled: "createForm/setIsNextDisabled",
            setIsPreviousDisabled: "createForm/setIsPreviousDisabled"
        }),
        submit() {
            this.setRating(this.rating);
        }
    }
};
</script>

<style scoped></style>
