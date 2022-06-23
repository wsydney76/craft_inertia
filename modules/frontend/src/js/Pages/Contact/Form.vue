<template>

    <div>
        <form @submit.prevent="submit">
            <div class="flex flex-col space-y-4">

                <div>
                    <label for="name" class="block font-bold">Name</label>
                    <input id="name" type="text" class="input w-1/2" v-model="form.name">
                </div>

                <div>
                    <label for="email" class="block font-bold">EMail</label>
                    <input id="email" type="text" class="input w-1/2" v-model="form.email">
                </div>

                <div>
                    <label for="text" class="block font-bold">Text</label>
                    <textarea id="text" rows="6" class="input w-1/2" v-model="form.text"></textarea>
                </div>
            </div>

            <div class="mt-8">
                <button class="btn" type="submit">Send Message</button>
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
                name: this.message.name,
                email: this.message.email,
                text: this.message.text,
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
