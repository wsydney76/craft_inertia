<template>

    <div>
        <div v-if="notice" class="text-green-700 font-bold mb-4">
            {{ notice }}
        </div>

        <div v-if="error" class="text-red-700 font-bold mb-4">
            {{ error }}
        </div>

        <div class="flex flex-col space-y-4">
            <input type="text" name="fullName" class="border border-gray-500 p-2 w-1/2" :value="fullName" placeholder="Name">

            <input type="text" name="email" class="border border-gray-500 p-2 w-1/2" :value="email" placeholder="EMail">

            <textarea name="message" rows="8" class="border border-gray-600 p-2 w-1/2" placeholder="Message">{{ message }}</textarea>
        </div>
    </div>
</template>

<script>

import Layout from '@/Shared/Layout'

export default {
    metaInfo() {
        return {title: this.title}
    },
    layout: Layout,
    props: {
        fullName: String,
        email: String,
        message: String,
        notice: String,
        error: String
    }
}
</script>
