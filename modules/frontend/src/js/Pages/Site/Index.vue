<template>
    <div>
        <div class="mb-8" v-html="text"></div>

        <inertia-link v-for="button in buttons"
                      class="btn mr-2"
                      :key="button.url"
                      :href="button.url">{{ button.label }}
        </inertia-link>

        <div class="mt-16">

            <inertia-link class="btn" :href="$page.url" :only="['randomPosts']">
                <template v-if="!randomPosts">Show some random posts</template>
                <template v-else>Refresh random posts</template>
            </inertia-link>

            <div class="mt-4" v-for="post in randomPosts" :key="post.id">
                <inertia-link :href="post.url">{{ post.title }}</inertia-link>
            </div>

        </div>

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
        title: String,
        text: String,
        buttons: Array,
        randomPosts: Array
    }
}
</script>
