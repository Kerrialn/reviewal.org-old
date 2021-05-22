<template>
    <div class="container">
        <div class="columns is-centered is-mobile">
            <div class="column is-10-mobile is-8-desktop">
                <section>
                    <div class="title is-4 m-0">Create Form</div>
                    <div v-for="step in stages.steps" :key="step.id">
                        <transition name="fade" mode="out-in">
                            <div v-if="stages.current === step.id">
                                <div class="subtitle is-4">
                                    {{ step.label }}
                                </div>
                                <component
                                    v-bind:is="step.component"
                                ></component>
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
                        <b-button
                            v-else
                            type="is-danger is-light"
                            @click="submit()"
                            >submit</b-button
                        >
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>

<script>
import AddressForm from "@/components/CreateForm/AddressForm";
import ReviewForm from "@/components/CreateForm/ReviewForm";
import RatingForm from "@/components/CreateForm/RatingForm";
import ConfirmationForm from "@/components/CreateForm/ConfirmationForm";
import { mapActions, mapGetters, mapMutations } from "vuex";

export default {
    name: "Create",
    components: {
        AddressForm,
        ReviewForm,
        RatingForm,
        ConfirmationForm
    },
    data() {
        return {};
    },
    watch: {
        current() {
            if (this.current <= 1) {
                this.setIsPreiousDisabled(true);
            } else {
                this.setIsPreiousDisabled(false);
            }

            if (this.current >= this.stages.steps.length) {
                this.setIsLast(true);
                this.setIsNextDisabled(true);
            } else {
                this.setIsLast(false);
                this.setIsNextDisabled(false);
            }
        }
    },
    computed: {
        ...mapGetters({
            getAddress: "createForm/getAddress",
            getReview: "createForm/getReview",
            getRating: "createForm/getRating",
            stages: "createForm/getStages"
        }),
        current() {
            return this.stages.current;
        }
    },
    methods: {
        ...mapMutations({
            setIsPreiousDisabled: "createForm/setIsPreviousDisabled",
            setIsNextDisabled: "createForm/setIsNextDisabled",
            setIsLast: "createForm/setIsLast"
        }),
        ...mapActions({
            previous: "createForm/previous",
            next: "createForm/next",
            store: "createForm/submit"
        }),
        submit() {
            this.store({
                address: this.getAddress,
                review: this.getReview,
                rating: this.getRating
            });
        }
    }
};
</script>

<style scoped>
.controls {
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
}
</style>
