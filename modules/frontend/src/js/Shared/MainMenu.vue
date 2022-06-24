<template>
    <div>
        <div class="mb-4">
            <inertia-link v-for="(item, i) in $page.props.mainNav" class="flex items-center group py-3" :href="item.url" :key="i">
                <div :class="isUrl(item.url) ? 'text-white' : 'text-brand-200 group-hover:text-white'">{{ item.label }}</div>
            </inertia-link>
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
