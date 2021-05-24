<template>
    <div>
        <b-field>
            <b-input
                @keyup.native="submit"
                v-model="keyword"
                placeholder="Address"
            ></b-input>
        </b-field>
        <router-link class="" :to="{ name: 'Format' }" tag="a"
            >Follow the required address format</router-link
        >
        <nav class="level is-mobile" v-if="response.search">
            <div class="level-item has-text-centered">
                <div>
                    <p class="has-text-weight-bold">
                        <b-tooltip
                            label="Address name or number"
                            type="is-primary is-light"
                            position="is-top"
                            animated="false"
                        >
                            Premise
                        </b-tooltip>
                    </p>
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

        <div class="columns is-centered mt-3">
            <div class="column is-12 scroll-select">
                <div v-if="response.addresses">
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
                            {{ address.premise }}, floor:
                            {{ address.floor == 0 ? "G" : address.floor }},
                            {{ address.line_one }}, {{ address.city }},
                            {{ address.postal_code }},
                            {{ address.country_code }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-12 has-text-centered">
            <b-button
                @click="
                    setAddressComponent(() =>
                        import('@/components/CreateForm/AddressForm')
                    )
                "
                label="can't find address?"
            />
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";

export default {
    name: "AddressForm",
    data() {
        return {
            keyword: null,
            selected: null,
            options: null,
            addressFormModalOpen: false
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
        })
    },
    methods: {
        ...mapMutations({
            setAddress: "createForm/setAddress",
            setIsPreiousDisabled: "createForm/setIsPreviousDisabled",
            setIsNextDisabled: "createForm/setIsNextDisabled",
            setAddressComponent: "createForm/setAddressComponent"
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
    min-height: 50vh;
    overflow-y: scroll;
    overflow-x: hidden;
}

.cursor:hover {
    cursor: pointer;
}
</style>
