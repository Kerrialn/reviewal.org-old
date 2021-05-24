<template>
    <div>
        <div class="card">
            <div class="card-content">
                <b-field>
                    <b-input
                        v-model="address.premise"
                        placeholder="Premise number or name"
                    ></b-input>
                </b-field>
                <b-field>
                    <b-numberinput
                        v-model="address.floor"
                        placeholder="floor"
                        min="0"
                    ></b-numberinput>
                </b-field>

                <b-field>
                    <b-input
                        v-model="address.line_one"
                        placeholder="Address line one"
                    ></b-input>
                </b-field>
                <b-field>
                    <b-input
                        v-model="address.city"
                        placeholder="city"
                    ></b-input>
                </b-field>
                <b-field>
                    <b-input
                        v-model="address.postal_code"
                        placeholder="postal code"
                    ></b-input>
                </b-field>
                <b-field>
                    <b-select
                        v-model="address.country_code"
                        expanded
                        placeholder="country"
                    >
                        <option value="cz">Czechia</option>
                    </b-select>
                </b-field>
                <router-link class="" :to="{ name: 'Format' }" tag="a"
                    >Follow the required address format</router-link
                >
            </div>
        </div>
        <div class="column is-12 has-text-centered">
            <b-button
                @click.native="
                    setAddressComponent(() =>
                        import(
                            '@/components/CreateForm/AddressAutocompleteForm'
                        )
                    )
                "
                label="back to address selection"
            />
        </div>
    </div>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";

export default {
    name: "AddressForm",
    mounted() {
        this.setIsPreviousDisabled(true);
        this.isFormValid ? this.setIsNextDisabled(true) : this.complete();
    },
    watch: {
        address: {
            handler() {
                this.isFormValid
                    ? this.setIsNextDisabled(true)
                    : this.complete();
            },
            deep: true
        }
    },
    computed: {
        ...mapGetters({
            address: "createForm/getAddress"
        }),
        isFormValid() {
            return (
                !this.premise ||
                !this.line_one ||
                !this.city ||
                !this.postal_code ||
                !this.country_code
            );
        },
        premise() {
            return this.address.premise;
        },
        line_one() {
            return this.address.line_one;
        },
        city() {
            return this.address.city;
        },
        postal_code() {
            return this.address.postal_code;
        },
        country_code() {
            return this.address.country_code;
        }
    },
    methods: {
        ...mapMutations({
            setAddress: "createForm/setAddress",
            setIsNextDisabled: "createForm/setIsNextDisabled",
            setIsPreviousDisabled: "createForm/setIsPreviousDisabled",
            setAddressComponent: "createForm/setAddressComponent"
        }),
        complete() {
            this.setIsNextDisabled(false);
            this.setAddress(this.address);
        }
    }
};
</script>

<style></style>
