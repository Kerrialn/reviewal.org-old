<template>
    <div class="container">
        <div class="columns is-centered is-mobile">
            <div class="column  is-4-desktop is-10-mobile">
                <div class="card">
                    <div class="card-content">
                        <div class="is-size-4">Register</div>
                        <form @submit.prevent="submit()">
                            <b-field>
                                <b-input
                                    type="text"
                                    placeholder="Full name"
                                    v-model="name"
                                ></b-input>
                            </b-field>
                            <b-field>
                                <b-input
                                    type="email"
                                    placeholder="E-mail address"
                                    v-model="email"
                                ></b-input>
                            </b-field>
                            <b-field>
                                <b-input
                                    type="password"
                                    placeholder="Password"
                                    v-model="password"
                                ></b-input>
                            </b-field>
                            <div class="has-text-right">
                                <button class="button is-light">
                                    contiune
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
    name: "Register",
    data() {
        return {
            name: "",
            email: "",
            password: ""
        };
    },
    methods: {
        ...mapActions({
            register: "auth/register"
        }),
        async submit() {
            if (this.name || this.email || this.password) {
                await this.register({
                    name: this.name,
                    email: this.email,
                    password: this.password
                }).then(() => {
                    this.$router.push({
                        name: "Login"
                    });
                });
            }
        }
    }
};
</script>

<style></style>
