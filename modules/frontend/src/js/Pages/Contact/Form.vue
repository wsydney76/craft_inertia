<template>

    <div>
        <form @submit.prevent="submit">
            <div class="flex flex-col space-y-4">
                <!-- TODO: implement and check proper CSRF protection -->
                <input type="hidden" v-model="form._token">

                <input type="text" class="bg-gray-50 border border-gray-500 p-2 w-1/2" v-model="form.fullName"
                       placeholder="Name">

                <input type="text" class="bg-gray-50 border border-gray-500 p-2 w-1/2" v-model="form.email"
                       placeholder="EMail">

                <textarea rows="6" class="bg-gray-50 border border-gray-600 p-2 w-1/2" placeholder="Message"
                          v-model="form.text"></textarea>
            </div>

            <div class="mt-8">
                <button class="bg-brand-800 text-white px-4 py-2" type="submit">Send Message</button>
            </div>

        </form>
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
        message: Object
    },

    data() {
        return {
            form: {
                fullName: this.message.fullName,
                email: this.message.email,
                text: this.message.text,
                _token: this.message.token // TODO: implement and check proper CSRF protections
            }
        }
    },

    methods: {
        submit() {
            this.$inertia.post('contact', this.form)
        }
    }
}
</script>
