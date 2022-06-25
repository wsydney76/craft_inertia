<template>
    <img :src="image.url"
         :width="image.width"
         :height="image.height"
         :alt="image.alt"
         :srcset="image.srcset"
         :loading="lazy ? 'lazy' : ''"
    >
</template>

<script>

export default {
    name: "ImageTag",
    props: {
        image: Object,
        lazy: {
            type: Boolean,
            default: false
        }
    },
}
</script>

