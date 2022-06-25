<template>
    <div>
        <div v-for="block in blocks">
            <div v-if="block.type == 'heading'">
                <h2 class="text-2xl font-bold">{{ block.text }}</h2>
            </div>

            <div v-if="block.type == 'text'" v-html="block.text"></div>

            <figure v-if="block.type == 'image'">
                <ImageTag :image="block.image"/>
                <figcaption v-if="block.caption">
                    {{ block.caption }}
                </figcaption>
            </figure>

            <blockquote v-if="block.type == 'quote'">
                <div v-html="block.text">
                </div>

                <cite v-if="block.attribution" class="block  font-normal not-italic text-base mt-4">
                    &mdash; {{ block.attribution }}
                </cite>
            </blockquote>

            <inertia-link v-if="block.type == 'button'" class="btn inline-block no-underline" :href="block.url">
                {{ block.caption }}
            </inertia-link>

            <div v-if="block.type == 'gallery'"
                 :class="'not-prose gallery-' + block.id + ' grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-3 gap-2'">
                <div v-for="image in block.images" class="relative">
                    <a :href="image.fullHeightUrl" :data-caption="image.caption">
                        <img :src="image.thumbnailUrl" :alt="image.caption">
                    </a>
                    <div class="absolute w-full bg-gray-800/50 bottom-0 text-center text-white py-2 text-sm">
                        {{ image.caption }}
                    </div>
                </div>

                {{ initGallery(block.id) }}
            </div>

        </div>
    </div>
</template>

<script>

import ImageTag from '@/Shared/ImageTag'

export default {
    name: "Blocks",
    props: {
        blocks: Array
    },
    components: {
        ImageTag
    },
    methods: {
        initGallery(id) {
            let selector = '.gallery-' + id

            // This needs a delay
            setTimeout(
                () => {
                    window.initLightBox(selector);
                }, 500);

            return '';
        }
    }
}
</script>
