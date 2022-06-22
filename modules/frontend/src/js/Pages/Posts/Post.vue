<template>
    <div>
        <div class="bg-white rounded shadow overflow-x-auto p-4">

            <div v-if="entry.imageUrl" class="mb-8">
                <img :src="entry.imageUrl">
            </div>

            <div class="font-bold text-lg">
                {{ entry.teaser }}
            </div>

            <div class="mt-4">
                {{ entry.author }}, {{ entry.postDate }}
            </div>

            <div v-if="entry.blocks" class="mt-4 space-y-4 max-w-screen-md">
                <div v-for="block in entry.blocks">
                    <div v-if="block.type == 'heading'">
                        <h2 class="text-2xl font-bold">{{ block.text }}</h2>
                    </div>
                    <p v-if="block.type == 'text'">
                       {{ block.text }}
                    </p>
                    <figure v-if="block.type == 'image' && block.imageUrl">
                        <img :src="block.imageUrl" :alt="block.alt">
                        <figcaption v-if="block.caption">
                            {{ block.caption }}
                        </figcaption>
                    </figure>
                </div>
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
        entry: Object
    }
}
</script>
