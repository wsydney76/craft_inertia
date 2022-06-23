<template>
    <div>
        <div class="mb-8" v-html="text">
        </div>

        <inertia-link v-for="button in buttons" class="bg-brand-800 text-white px-4 py-2 mr-2" :key="button.url" :href="button.url">{{ button.label }}</inertia-link>

    </div>
</template>

<script>

import Layout from '@/Shared/Layout'

export default {
    metaInfo() {
        return {title: this.title}
    },
    layout: Layout,
    props: {
        text: String,
        buttons: Array
    }
}
</script>
