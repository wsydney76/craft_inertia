<template>
    <div>
        <div class="mb-8" v-html="text"></div>

        <inertia-link v-for="button in buttons"
                      class="btn mr-2"
                      :key="button.url"
                      :href="button.url">{{ button.label }}
        </inertia-link>

        <div class="mt-16">
            <button class="btn" @click="getRandomPosts()">
                <div v-if="!randomPosts">Show some random posts</div>
                <div v-else>Refresh random posts</div>
            </button>

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
    },
    methods: {
        getRandomPosts() {
            this.$inertia.get(this.$page.url, {}, {
              only: ['randomPosts']
            });
        }
    }
}
</script>
