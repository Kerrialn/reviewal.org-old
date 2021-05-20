<template>
    <div id="app">
        <navbar />
        <b-loading v-model="isLoading"></b-loading>
        <router-view />
    </div>
</template>

<script>
import Navbar from "@/components/Navbar.vue";
import { mapGetters } from "vuex";
export default {
    components: { Navbar },
    name: "App",
    computed: {
        ...mapGetters({
            isLoading: "getLoading",
            message: "getMessage"
        })
    },
    mounted() {
        if (this.message.content) {
            this.$buefy.toast.open({
                message: this.message.content,
                type: this.message.type || ""
            });
        }
    }
};
</script>

<style>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    color: #2c3e50;
}
.margin-top-3 {
    margin-top: 30px;
}
.margin-bottom-3 {
    margin-bottom: 30px;
}
.margin-top-5 {
    margin-top: 50px !important;
}

.material-icons {
    line-height: inherit !important;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
}
</style>
