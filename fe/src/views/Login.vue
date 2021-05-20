<template>
    <div class="container">
        <div class="columns is-centered is-mobile">
            <div class="column  is-4-desktop is-10-mobile">
                <form @submit.prevent="submit">
                    <div class="card">
                        <div class="card-content">
                            <div class="is-size-4">Login</div>
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
                                <button
                                    tag="input"
                                    native-type="submit"
                                    class="button is-light"
                                >
                                    contiune
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
    name: "Login",
    data() {
        return {
            email: "",
            password: ""
        };
    },
    methods: {
        ...mapActions({
            login: "auth/login"
        }),
        async submit() {
            await this.login({
                email: this.email,
                password: this.password
            }).finally(() => {
                this.$router.push({
                    name: "Create"
                });
            });
        }
    }
};
</script>

<style></style>
