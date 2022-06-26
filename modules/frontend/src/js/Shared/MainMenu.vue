<template>
    <div class="md:flex md:flex-col md:justify-between">
        <div class="md:mb-4 flex md:block">
            <inertia-link v-for="(item, i) in nav" class="flex items-center group py-3 px-4 md:px-0" :href="item.url" :key="i">
                <div :class="isUrl(item.url) ? 'text-white' : 'text-brand-200 group-hover:text-white'">{{ item.label }}</div>
            </inertia-link>
        </div>
        <div v-if="copyright" class="text-brand-200 text-sm">
            &copy; {{ copyright }}
        </div>
    </div>
</template>

<script>

export default {
    props: {
        url: String,
        nav: Array,
        copyright: String
    },
    methods: {
        isUrl(...urls) {
            if (urls[0] === '') {
                return this.url === ''
            }

            let currentUrl = '/' + this.url

            return urls.filter(url => currentUrl.startsWith(url)).length
        },
    },
}
</script>
