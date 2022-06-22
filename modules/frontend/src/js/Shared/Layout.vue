<template>
    <div class="font-sans text-gray-700 antialiased">

        <div class="flex flex-col">
            <div class="h-screen flex flex-col">

                <div class="md:flex">
                    <div class="bg-brand-900 md:flex-shrink-0 md:w-56 px-6 py-4 flex items-center">
                        <inertia-link class="mt-1 text-white text-xl" :href="$page.siteUrl">
                            {{ $page.siteName }}
                        </inertia-link>
                    </div>
                    <div class="px-12 py-4">
                        <h1 class="font-bold text-3xl"> {{ $page.title }}</h1>
                    </div>
                </div>

                <div class="flex flex-grow overflow-hidden">
                    <main-menu :url="url()"
                               class="bg-brand-800 flex-shrink-0 w-56 p-12 hidden md:block overflow-y-auto"/>
                    <div class="flex-1 overflow-hidden px-4 py-8 md:px-12 py-0 overflow-y-auto" scroll-region>
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
