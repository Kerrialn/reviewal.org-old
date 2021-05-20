<template>
    <div>
        <b-navbar>
            <template #brand>
                <b-navbar-item tag="router-link" :to="{ name: 'Home' }">
                    <b>Reviewal</b>
                </b-navbar-item>
            </template>

            <template #start>
                <b-navbar-item
                    v-if="isAuthenticated"
                    tag="router-link"
                    :to="{ name: 'Create' }"
                >
                    Create
                </b-navbar-item>
                <b-navbar-item v-if="isAuthenticated && user" tag="div">
                    {{ user.name }}
                </b-navbar-item>
            </template>

            <template #end>
                <b-navbar-item
                    v-if="!isAuthenticated"
                    tag="router-link"
                    :to="{ name: 'Register' }"
                >
                    Register
                </b-navbar-item>
                <b-navbar-item
                    v-if="!isAuthenticated"
                    tag="router-link"
                    :to="{ name: 'Login' }"
                >
                    Login
                </b-navbar-item>
                <b-navbar-item v-if="isAuthenticated" tag="a" @click="submit()">
                    Logout
                </b-navbar-item>
            </template>
        </b-navbar>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
    name: "Navbar",
    computed: {
        ...mapGetters({
            isAuthenticated: "auth/isAuthenticated",
            user: "auth/getUser"
        })
    },
    methods: {
        ...mapActions({
            logout: "auth/logout"
        }),
        submit() {
            this.logout();
            this.$router.push({
                name: "Login"
            });
        }
    }
};
</script>

<style></style>
