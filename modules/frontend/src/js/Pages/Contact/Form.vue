<template>

    <div>

        <form @submit.prevent="submit">
            <div class="flex flex-col space-y-4">

                <div>
                    <label for="name" class="block font-bold">Name</label>
                    <div v-if="message.name" class="text-lg">
                        {{ message.name }}
                    </div>
                    <div v-else>
                        <input id="name" type="text" class="input w-1/2" v-model="form.name">
                    </div>
                    <div v-if="errors.name" class="text-red-700">
                        {{ errors.name[0] }}
                    </div>
                </div>

                <div>
                    <label for="email" class="block font-bold">EMail</label>
                    <div v-if="message.email" class="text-lg">
                        {{ message.email }}
                    </div>
                    <div v-else>
                        <input id="email" type="text" class="input w-1/2" v-model="form.email">
                    </div>
                    <div v-if="errors.email" class="text-red-700">
                        {{ errors.email[0] }}
                    </div>
                </div>

                <div>
                    <label for="text" class="block font-bold">Text</label>
                    <textarea id="text" rows="6" class="input w-1/2" v-model="form.text"></textarea>
                    <div v-if="errors.text" class="text-red-700">
                        {{ errors.text[0] }}
                    </div>
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
        title: String,
        message: Object,
        errors: {
            type: Array | Object,
            default: () => []
        }
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
            this.$inertia.post('contact',
                {
                    message: this.form
                },
                {
                    only: ['errors']
                })
        }
    }
}
</script>
