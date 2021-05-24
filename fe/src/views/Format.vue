<template>
    <div>
        <div class="container">
            <div class="columns is-centered is-mobile">
                <div class="column is-10-mobile is-8-desktop">
                    <address-format />
                    <rating-criteria />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AddressFormat from "@/components/Explainers/AddressFormat";
import RatingCriteria from "@/components/Explainers/RatingCriteria";

export default {
    components: { AddressFormat, RatingCriteria },
    name: "Format"
};
</script>
<style>
.part:hover {
    cursor: pointer;
}
.selected {
    background-color: #7957d5 !important;
    color: #ffffff;
    border-radius: 3px;
}
</style>
