<template>
    <div class="font-sans text-gray-700 antialiased">

        <div class="flex flex-col">
            <div class="h-screen flex flex-col">

                <div class="md:flex">
                    <div class="bg-brand-900 md:flex-shrink-0 md:w-56 px-6 py-4 flex items-center">
                        <inertia-link class="mt-1 text-white text-xl" :href="$page.props.siteUrl">
                            {{ $page.props.siteName }}
                        </inertia-link>
                    </div>
                        <div class="px-12 py-4 flex justify-between items-center w-full border-b border-gray-500 bg-gray-100">
                        <h1 class="font-bold text-2xl text-brand-800"> {{ $page.props.title }}</h1>
                        <div class="flex space-x-2">
                            <div v-if="$page.props.prevUrl">
                                <inertia-link class="btn" :href="$page.props.prevUrl">Previous</inertia-link>
                            </div>
                            <div v-if="$page.props.nextUrl">
                                <inertia-link class="btn" :href="$page.props.nextUrl">Next</inertia-link>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row flex-grow overflow-hidden">
                    <main-menu :url="url()"
                               class="bg-brand-800 w-full flex-shrink-0 md:w-56 p-4 md:p-6 overflow-y-auto"/>
                    <div class="flex-1 overflow-hidden px-4 py-8 md:px-12 py-0 overflow-y-auto" scroll-region="true">

                        <div v-if="$page.props.error" class="-mx-4 md:-mx-12 mb-8 bg-red-500 text-white px-12 py-2">
                            {{ $page.props.error }}
                        </div>
                        <div v-if="$page.props.notice" class="-mx-4 md:-mx-12 mb-8 bg-green-700 text-white px-12 py-2">
                            {{ $page.props.notice }}
                        </div>

                        <div class="my-8">
                            <slot/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MainMenu from '@/Shared/MainMenu'

export default {
    components: {
        MainMenu,
    },
    methods: {
        url() {
            return location.pathname.substr(1)
        },
    },
}
</script>
