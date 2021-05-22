<template>
    <div class="container">
        <div class="columns is-centered is-mobile">
            <div class="column  is-8-desktop is-10-mobile">
                <div class="card mb-3" v-for="term in terms" :key="term.slug">
                    <div class="card-content">
                        <div class="title is-4">{{ term.title }}</div>
                        <p>{{ term.content }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "Login",
    async mounted() {
        await axios.get("terms").then(response => {
            this.terms = response.data;
        });
    },
    data() {
        return {
            terms: null
        };
    }
};
</script>

<style scoped></style>
