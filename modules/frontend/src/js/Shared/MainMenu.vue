<template>
    <div class="md:flex md:flex-col md:justify-between">
        <div class="md:mb-4 flex md:block">
            <inertia-link v-for="(item, i) in $page.props.siteInfo.mainNav" class="flex items-center group py-3 px-4 md:px-0" :href="item.url" :key="i">
                <div :class="isUrl(item.url) ? 'text-white' : 'text-brand-200 group-hover:text-white'">{{ item.label }}</div>
            </inertia-link>
        </div>
        <div v-if="$page.props.siteInfo.copyright" class="text-brand-200 text-sm">
            &copy; {{ $page.props.siteInfo.copyright }}
        </div>
    </div>
</template>

<script>

export default {
    props: {
        url: String,
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
