<template>
    <div class="card mb-3">
        <div class="card-content">
            <div class="title">Address format</div>
            <div class="subtitle is-4">
                Click on a part of the addres below
            </div>
            <span class="" v-for="part in address" :key="part.title">
                <span
                    :class="[
                        {
                            selected: part === selected
                        },
                        'part'
                    ]"
                    @click="selected = part"
                >
                    {{ part.title }},
                </span>
            </span>
            <div v-if="selected">
                <hr />
                {{ selected.description }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AddressFormat",
    data() {
        return {
            address: [
                {
                    title: "Premise",
                    description: "house/flat number or name"
                },
                {
                    title: "Floor",
                    description: "floor number"
                },
                {
                    title: "Address line one",
                    description: "First line of the address"
                },
                {
                    title: "City",
                    description: "city"
                },
                {
                    title: "Postal code",
                    description: "Postal code"
                },
                {
                    title: "Country",
                    description: "country"
                }
            ],
            selected: null
        };
    }
};
</script>

<style></style>
