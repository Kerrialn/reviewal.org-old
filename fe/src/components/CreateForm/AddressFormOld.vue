<template>
    <div>
        <b-field>
            <b-input
                @keyup.native="submit"
                v-model="keyword"
                placeholder="Address"
            ></b-input>
        </b-field>
        <small v-if="response.search">
            <span>premise: {{ response.search.premise }},</span>
            <span>floor: {{ response.search.floor }},</span>
            <span>line-one: {{ response.search.lineOne }},</span>
            <span>line-two:{{ response.search.lineTwo }},</span>
            <span>district:{{ response.search.district }}, </span>
            <span>city: {{ response.search.city }},</span>
            <span>post code: {{ response.search.postalCode }}, </span>
            <span>country:{{ response.search.countryCode }}</span>
        </small>

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
                            {{ address.premise }},
                            {{ address.floor == 0 ? "G" : address.floor }},
                            {{ address.line_one }}, {{ address.line_two }},
                            {{ address.district }}, {{ address.city }},
                            {{ address.postal_code }},
                            {{ address.country_code }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="columns is-centered">
            <div class="column is-12">
                <div class="has-text-centered block">
                    <a @click="addressFormModalOpen = !addressFormModalOpen">{{
                        addressFormModalOpen
                            ? "close address form"
                            : "can't find address?"
                    }}</a>
                </div>
                <address-form-modal
                    v-if="addressFormModalOpen"
                ></address-form-modal>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
import AddressFormModal from "../AddressFormModal.vue";

export default {
    name: "AddressForm",
    components: {
        AddressFormModal
    },
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
    min-height: 50vh;
    overflow-y: scroll;
    overflow-x: hidden;
}

.cursor:hover {
    cursor: pointer;
}
</style>
