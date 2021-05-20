<template>
    <div class="container">
        <div class="columns is-mobile is-centered">
            <div class="column is-10-mobile is-8-desktop">
                <div class="is-size-3">Find address reviews</div>
                <b-field>
                    <b-input
                        @keyup.native="submit()"
                        placeholder="Address"
                        v-model="keyword"
                    ></b-input>
                </b-field>
                <small v-if="response.search">
                    line-one: {{ response.search.lineOne }}, line-two:
                    {{ response.search.lineTwo }}, district:
                    {{ response.search.district }}, city:
                    {{ response.search.city }}, post code:
                    {{ response.search.postalCode }}, country:
                    {{ response.search.countryCode }}
                </small>
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
                                {{ address.line_one }}, {{ address.line_two }},
                                {{ address.district }}, {{ address.city }},
                                {{ address.postal_code }},
                                {{ address.country_code }}
                            </div>
                            <nav
                                class="level"
                                v-if="address.reviews.length > 0"
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
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
    name: "Home",
    data() {
        return {
            keyword: ""
        };
    },
    computed: {
        ...mapGetters({
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
