<template>
    <div>
        <div :class="['sticky', { shadow: isShadow }]">
            <div class="subtitle has-text-centered">
                {{ address.premise }}, floor {{ address.floor }},
                {{ address.line_one }}, {{ address.city }},
                {{ address.postal_code }},
                {{ address.country_code }}
            </div>
            <nav class="level block is-mobile">
                <div class="level-item has-text-centered">
                    <div>
                        <p class="heading">
                            Overall
                        </p>
                        <p
                            :class="[
                                'title',
                                {
                                    'has-text-danger':
                                        address.average.ratings.overall <= 2
                                },
                                {
                                    'has-text-success':
                                        address.average.ratings.overall >= 4
                                }
                            ]"
                        >
                            {{
                                parseFloat(
                                    address.average.ratings.overall
                                ).toFixed(1) || "--"
                            }}
                        </p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                        <p class="heading">Landlord</p>
                        <p
                            :class="[
                                'title',
                                {
                                    'has-text-danger':
                                        address.average.ratings.landlord <= 2
                                },
                                {
                                    'has-text-success':
                                        address.average.ratings.landlord >= 4
                                }
                            ]"
                        >
                            {{
                                parseFloat(
                                    address.average.ratings.landlord
                                ).toFixed(1) || "--"
                            }}
                        </p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                        <p class="heading">Premise</p>
                        <p
                            :class="[
                                'title',
                                {
                                    'has-text-danger':
                                        address.average.ratings.premise <= 2
                                },
                                {
                                    'has-text-success':
                                        address.average.ratings.premise >= 4
                                }
                            ]"
                        >
                            {{
                                parseFloat(
                                    address.average.ratings.premise
                                ).toFixed(1) || "--"
                            }}
                        </p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                        <p class="heading">Area</p>
                        <p
                            :class="[
                                'title',
                                {
                                    'has-text-danger':
                                        address.average.ratings.area <= 2
                                },
                                {
                                    'has-text-success':
                                        address.average.ratings.area >= 4
                                }
                            ]"
                        >
                            {{
                                parseFloat(
                                    address.average.ratings.area
                                ).toFixed(1) || "--"
                            }}
                        </p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                        <p class="heading">Transport</p>
                        <p
                            :class="[
                                'title',
                                {
                                    'has-text-danger':
                                        address.average.ratings.transport <= 2
                                },
                                {
                                    'has-text-success':
                                        address.average.ratings.transport >= 4
                                }
                            ]"
                        >
                            {{
                                parseFloat(
                                    address.average.ratings.transport
                                ).toFixed(1) || "--"
                            }}
                        </p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                        <p class="heading">Noise</p>
                        <p
                            :class="[
                                'title',
                                {
                                    'has-text-danger':
                                        address.average.ratings.noise <= 2
                                },
                                {
                                    'has-text-success':
                                        address.average.ratings.noise >= 4
                                }
                            ]"
                        >
                            {{
                                parseFloat(
                                    address.average.ratings.noise
                                ).toFixed(1) || "--"
                            }}
                        </p>
                    </div>
                </div>
            </nav>
        </div>

        <div class="container margin-top-5">
            <div class="columns is-centered">
                <div class="column is-8">
                    <div
                        class="card block"
                        v-for="review in address.reviews"
                        :key="review.id"
                    >
                        <div class="card-content">
                            <div class="subtitle is-4">{{ review.title }}</div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
    name: "Address",
    data() {
        return {
            isShadow: false
        };
    },
    props: {
        id: Number
    },
    mounted() {
        this.$store.dispatch("address/fetchAddress", this.id);
        window.addEventListener("scroll", this.onScroll);
    },
    computed: {
        ...mapGetters({
            address: "address/getAddress"
        }),
        ratingStyle() {
            return { "has-text-danger": this.address.average.ratings.overall };
        }
    },
    beforeDestroy() {
        window.removeEventListener("scroll", this.onScroll);
    },
    methods: {
        onScroll() {
            if (window.scrollY > 55) {
                this.isShadow = true;
            } else {
                this.isShadow = false;
            }
        }
    }
};
</script>

<style scoped>
.sticky {
    position: sticky;
    top: 0;
    z-index: 10;
    padding: 20px;
    background-color: #ffffff;
}
.shadow {
    box-shadow: 0 0.5em 1em 0em rgb(10 10 10 / 10%),
        0 0px 0 1px rgb(10 10 10 / 2%);
}
</style>
