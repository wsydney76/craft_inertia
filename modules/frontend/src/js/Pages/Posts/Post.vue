<template>
    <div>

        <div v-if="entry.featuredImage" class="mb-8">
            <ImageTag :image="entry.featuredImage"/>
        </div>

        <div class="font-bold text-lg">
            {{ entry.teaser }}
        </div>

        <div class="mt-4">
            {{ entry.author }}, {{ entry.postDate }}
        </div>

        <div v-if="entry.blocks" class="prose prose-lg mt-4 space-y-4">
            <Blocks :blocks="entry.blocks"/>
        </div>
        
        <div v-if="entry.topics" class="mt-8">
            <inertia-link class="btn mr-2" v-for="topic in entry.topics" :key="topic.id" :href="topic.url">{{ topic.title }}</inertia-link>
        </div>


    </div>
</template>

<script>

import Layout from '@/Shared/Layout'
import ImageTag from '@/Shared/ImageTag'
import Blocks from '@/Shared/Blocks'


export default {
    metaInfo() {
        return {title: this.entry.title}
    },
    layout: Layout,
    components: {
        ImageTag,
        Blocks
    },
    props: {
        entry: Object,
        nextUrl: String,
        prevUrl: String
    }
}
</script>
