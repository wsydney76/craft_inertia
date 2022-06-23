<template>
    <div>

        <div class="mb-8">
            <form @submit.prevent="search">
                <input type="text" v-model="form.q" class="input">
                <button class="btn" href="posts">Search</button>
                <inertia-link v-if="q" class="" href="posts">Reset</inertia-link>
            </form>
        </div>

        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <tr class="text-left font-bold">
                    <th class="px-6 pt-6 pb-4">Title</th>
                </tr>
                <tr v-for="entry in entries" :key="entry.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                    <td class="border-t">
                        <inertia-link class="px-6 py-4 flex items-center focus:text-brand-500"
                                      :href="'posts/' + entry.slug">
                            {{ entry.title }}
                        </inertia-link>
                    </td>

                </tr>
                <tr v-if="entries.length === 0">
                    <td class="border-t px-6 py-4" colspan="4">No posts found.</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>

import Layout from '@/Shared/Layout'

export default {
    metaInfo: {title: 'Posts'},
    layout: Layout,
    props: {
        entries: Array,
        q: String
    },

    data() {
        return {
            form: {
                q: this.q
            }
        }
    },

    methods: {
        search() {
            this.$inertia.post('posts?q=' + this.form.q)
        }
    }
}
</script>
