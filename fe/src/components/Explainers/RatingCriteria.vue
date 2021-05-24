<template>
    <div class="card">
        <div class="card-content">
            <div class="title">Rating criteria</div>
            <div class="subtitle is-4">
                Please see below the rting system breakdown
            </div>

            <b-tabs>
                <b-tab-item label="Overall">
                    The overall rating is a calculated average based on all
                    other ratings, it's purpose is to give a general overview of
                    the property.
                </b-tab-item>
                <b-tab-item label="Premise">
                    The Premise rating describes the condition of the property.
                    The state, quality and function of the renovation,
                    appliances and furnishings of the property.
                </b-tab-item>
                <b-tab-item label="Landlord">
                    The Landlord rating describes the experience of interacting
                    with the landlord. Their attitude, objectivity and fairness
                    towards resolving issues.
                </b-tab-item>
                <b-tab-item label="Area">
                    The Area rating describes the surrounding area of the
                    property. Access to shops and other necessities.
                </b-tab-item>
                <b-tab-item label="Transport">
                    The Transport rating describes the access transport. Access
                    to public transport, car parks or trains.
                </b-tab-item>
                <b-tab-item label="Noise">
                    The Noise rating describes the average levels of noise
                    polution in the property.
                </b-tab-item>
            </b-tabs>
        </div>
    </div>
</template>

<script>
export default {
    name: "RatingCriteria"
};
</script>

<style></style>
