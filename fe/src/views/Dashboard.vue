<template>
    <div class="container">
        <div class="columns is-mobile is-centered">
            <div class="column is-10-mobile is-8-desktop">
                <div v-if="user.reviews.length">
                    <div
                        class="card block"
                        v-for="review in user.reviews"
                        :key="review.id"
                    >
                        <router-link
                            tag="a"
                            :to="{
                                name: 'Address',
                                params: { id: review.address.id }
                            }"
                        >
                            <div class="card-content">
                                <div class="subtitle is-4">
                                    {{ review.title }}
                                </div>
                                <nav class="level">
                                    <div class="level-item has-text-centered">
                                        <div>
                                            <p>Overall</p>
                                            <p>
                                                {{ review.rating.overall }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="level-item has-text-centered">
                                        <div>
                                            <p>Landlord</p>
                                            <p>{{ review.rating.landlord }}</p>
                                        </div>
                                    </div>
                                    <div class="level-item has-text-centered">
                                        <div>
                                            <p>Premise</p>
                                            <p>{{ review.rating.premise }}</p>
                                        </div>
                                    </div>
                                    <div class="level-item has-text-centered">
                                        <div>
                                            <p>Area</p>
                                            <p>{{ review.rating.area }}</p>
                                        </div>
                                    </div>
                                    <div class="level-item has-text-centered">
                                        <div>
                                            <p>Transport</p>
                                            <p>{{ review.rating.transport }}</p>
                                        </div>
                                    </div>
                                    <div class="level-item has-text-centered">
                                        <div>
                                            <p>Noise</p>
                                            <p>{{ review.rating.noise }}</p>
                                        </div>
                                    </div>
                                </nav>
                                <p>{{ review.summary }}</p>
                            </div>
                        </router-link>
                    </div>
                </div>
                <div v-else>
                    <div class="card">
                        <div class="card-content has-text-centered">
                            No reviwes found
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
    name: "Dashboard",
    mounted() {
        this.$store.dispatch("auth/attempt", this.token);
    },
    computed: {
        ...mapGetters({
            user: "auth/getUser",
            token: "auth/getToken"
        })
    }
};
</script>

<style></style>
