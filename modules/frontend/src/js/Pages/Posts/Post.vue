<template>
    <div>

        <div v-if="entry.featuredImage" class="mb-8">
            <img :src="entry.featuredImage.url" :alt="entry.featuredImage.alt" :srcset="entry.featuredImage.srcset">
        </div>

        <div class="font-bold text-lg">
            {{ entry.teaser }}
        </div>

        <div class="mt-4">
            {{ entry.author }}, {{ entry.postDate }}
        </div>

        <div v-if="entry.blocks" class="prose prose-lg mt-4 space-y-4">
            <div v-for="block in entry.blocks">
                <div v-if="block.type == 'heading'">
                    <h2 class="text-2xl font-bold">{{ block.text }}</h2>
                </div>

                <div v-if="block.type == 'text'" v-html="block.text"></div>

                <figure v-if="block.type == 'image'">
                    <img :src="block.image.url" :alt="block.image.alt">
                    <figcaption v-if="block.caption">
                        {{ block.caption }}
                    </figcaption>
                </figure>
            </div>
        </div>

        <div class="flex space-x-8">
            <div v-if="prevUrl" class="mt-8">
                <inertia-link class="btn" :href="prevUrl">Previous Post</inertia-link>
            </div>
            <div v-if="nextUrl" class="mt-8">
                <inertia-link class="btn" :href="nextUrl">Next Post</inertia-link>
            </div>
        </div>


    </div>
</template>

<script>

import Layout from '@/Shared/Layout'

export default {
    metaInfo() {
        return {title: this.entry.title}
    },
    layout: Layout,
    props: {
        entry: Object,
        nextUrl: String,
        prevUrl: String
    }
}
</script>
