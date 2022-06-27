<template>
    <div>
        <div class="font-semibold">
            {{ text }}
        </div>
        <div class="mt-12">
            <inertia-link v-for="continueButton in continueButtons" class="btn mr-2" :key="continueButton.label" :href="continueButton.url">{{ continueButton.label }}</inertia-link>
        </div>
    </div>
</template>

<script>

import Layout from '@/Shared/Layout'

export default {
    name: "Confirm",
    metaInfo() {
        return {title: this.title}
    },
    layout: Layout,
    props: {
        text: String,
        continueButtons: Array
    }
}
</script>

