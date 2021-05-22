<template>
    <div class="container">
        <div class="columns is-mobile is-centered">
            <div class="column is-10-mobile is-8-desktop">
                <div class="title">Search address</div>

                <b-field>
                    <b-input
                        v-model="keyword"
                        size="is-large"
                        expanded
                        placeholder="address"
                    ></b-input>
                    <p class="control">
                        <b-button
                            class="button is-large is-primary"
                            @click.native="submit()"
                            icon-left="magnify"
                        />
                    </p>
                </b-field>
            </div>
        </div>

        <div class="columns is-mobile is-centered">
            <div class="column is-12-mobile is-12-desktop">
                <nav class="level is-mobile" v-if="response.search">
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="has-text-weight-bold">Premise</p>
                            <p>{{ response.search.premise || "--" }}</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="has-text-weight-bold">Floor</p>
                            <p>{{ response.search.floor || "--" }}</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="has-text-weight-bold">Line one</p>
                            <p>{{ response.search.lineOne || "--" }}</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="has-text-weight-bold">Line two</p>
                            <p>{{ response.search.lineTwo || "--" }}</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="has-text-weight-bold">District</p>
                            <p>{{ response.search.district || "--" }}</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="has-text-weight-bold">City</p>
                            <p>{{ response.search.city || "--" }}</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="has-text-weight-bold">Postal code</p>
                            <p>{{ response.search.postalCode || "--" }}</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="has-text-weight-bold">Country</p>
                            <p>{{ response.search.countryCode || "--" }}</p>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="columns is-mobile is-centered">
            <div class="column is-10-mobile is-8-desktop ">
                <div
                    class="card margin-bottom-3"
                    v-for="address in response.addresses"
                    :key="address.id"
                >
                    <router-link
                        tag="a"
                        :to="{ name: 'Address', params: { id: address.id } }"
                    >
                        <div class="card-content address-card">
                            <div>
                                {{ address.premise }}, floor
                                {{ address.floor }}, {{ address.line_one }},
                                {{ address.city }}, {{ address.postal_code }},
                                {{ address.country_code }}
                            </div>
                            <nav
                                class="level"
                                v-if="
                                    address.reviews.length > 0 &&
                                        isAuthenticated &&
                                        user.reviews.length
                                "
                            >
                                <div class="level-item has-text-centered">
                                    <div>
                                        <p class="heading">Overall</p>
                                        <b>{{
                                            address.average.ratings.overall
                                        }}</b>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>

        <div class="columns is-mobile is-centered">
            <div class="column is-10-mobile is-8-desktop">
                <div
                    class="box has-background-primary has-text-white"
                    v-if="!isAuthenticated && showWelcomeMessage"
                >
                    <div class="title has-text-white between">
                        <div>
                            A review for full access
                        </div>
                        <div>
                            <b-icon
                                @click.native="
                                    showWelcomeMessage = !showWelcomeMessage
                                "
                                icon="close"
                            />
                        </div>
                    </div>
                    <div class="subtitle has-text-white">
                        Leave one review and gain access to all reviews, free.
                        no catch.
                    </div>
                    <hr />
                    <div class="subtitle is-5 has-text-white">
                        How it works?
                    </div>
                    <p class="has-text-white">
                        Lookup an address and find the tenants experiences of
                        the landlord, premises, surrounding area, transport
                        access and noise pollution.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
    name: "Home",
    data() {
        return {
            keyword: "",
            showWelcomeMessage: true
        };
    },
    computed: {
        ...mapGetters({
            user: "auth/getUser",
            isAuthenticated: "auth/isAuthenticated",
            isLoading: "getLoading",
            response: "address/getAddresses"
        })
    },
    mounted() {},
    methods: {
        ...mapActions({
            search: "address/search"
        }),
        async submit() {
            if (this.keyword.trim()) {
                await this.search(this.keyword).catch(() => {
                    this.$buefy.toast.open({
                        duration: 5000,
                        message: "an error occured",
                        type: "is-danger"
                    });
                });
            }
        }
    }
};
</script>

<style scoped>
.between {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}
.vh-80 {
    min-height: 80vh;
}
.address-card {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.overall-rating span {
    font-size: 25px;
    margin-left: 3px;
}
.overall-rating {
    font-size: 18px;
    display: flex;
    align-items: center;
    line-height: 0.8;
}
</style>
