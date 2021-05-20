<template>
    <div>
        <div class="is-size-3">Address</div>
        <b-field>
            <b-input
                @keyup.native="submit"
                v-model="keyword"
                placeholder="Address"
            ></b-input>
        </b-field>
        <small v-if="response.search">
            line-one: {{ response.search.lineOne }}, line-two:
            {{ response.search.lineTwo }}, district:
            {{ response.search.district }}, city: {{ response.search.city }},
            post code: {{ response.search.postalCode }}, country:
            {{ response.search.countryCode }}
        </small>

        <div class="columns is-centered mt-3" v-if="response.addresses">
            <div class="column is-12 scroll-select">
                <div
                    v-for="address in response.addresses"
                    :key="address.id"
                    :class="[
                        'card',
                        'mb-3',
                        'cursor',
                        {
                            'has-background-primary has-text-white':
                                createFormAddress === address
                        }
                    ]"
                    @click="selectAddress(address)"
                >
                    <div class="card-content">
                        {{ address.line_one }}, {{ address.line_two }},
                        {{ address.district }}, {{ address.city }},
                        {{ address.postal_code }}, {{ address.country_code }}
                    </div>
                </div>
            </div>
        </div>
        <div class="columns is-centered">
            <b-button
                @click="storeNewAddress()"
                v-if="validAddress"
                type="primary"
                >add address</b-button
            >
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
export default {
    name: "AddressForm",
    data() {
        return {
            keyword: "",
            selected: null,
            options: null
        };
    },
    watch: {
        createFormAddress() {
            if (!this.createFormAddress) {
                this.setIsNextDisabled(true);
            } else {
                this.setIsNextDisabled(false);
            }
        }
    },
    computed: {
        ...mapGetters({
            response: "address/getAddresses",
            createFormAddress: "createForm/getAddress"
        }),
        validAddress() {
            return (
                this.response.addresses < 1 &&
                this.response.search.lineOne &&
                this.response.search.district &&
                this.response.search.city &&
                this.response.search.postalCode &&
                this.response.search.countryCode
            );
        }
    },
    methods: {
        ...mapMutations({
            setAddress: "createForm/setAddress",
            setIsPreiousDisabled: "createForm/setIsPreviousDisabled",
            setIsNextDisabled: "createForm/setIsNextDisabled"
        }),
        ...mapActions({
            search: "address/search",
            store: "address/store"
        }),
        async submit() {
            if (this.keyword.trim()) {
                await this.search(this.keyword);
            }
        },
        selectAddress(address) {
            this.selected = address;
            this.setAddress(address);
        },
        async storeNewAddress() {
            await this.store(this.keyword);
            await this.search(this.keyword);
        }
    }
};
</script>

<style>
.scroll-select {
    height: 50vh;
    overflow-y: scroll;
    overflow-x: hidden;
}

.cursor:hover {
    cursor: pointer;
}
</style>
