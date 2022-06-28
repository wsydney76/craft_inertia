<template>
    <div>
        <div class="mb-8" v-html="dashboardData.text"></div>

        <inertia-link v-for="button in dashboardData.buttons"
                      class="btn mr-2"
                      :key="button.url"
                      :href="button.url">{{ button.label }}
        </inertia-link>

        <div class="mt-16  w-[500px] border border-gray-500 shadow-xl bg-white p-8">

            <inertia-link class="btn" :href="$page.url" :only="['randomPosts']">
                <template v-if="!randomPosts">Show some random posts</template>
                <template v-else>Refresh random posts</template>
            </inertia-link>

            <div v-if="randomPosts" class="mt-8 space-y-4">
                <inertia-link class="block"  v-for="post in randomPosts" :key="post.id" :href="post.url">{{ post.title }}</inertia-link>
            </div>

        </div>

    </div>
</template>

<script>

import Layout from '@/Shared/Layout'

export default {
    layout: Layout,
    props: {
        title: String,
        dashboardData: Object,
        randomPosts: Array
    }
}
</script>
