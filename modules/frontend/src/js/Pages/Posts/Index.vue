<template>
    <div>

        <div class="mb-8" v-if="showSearch">
            <form @submit.prevent="search">
                <input type="text" v-model="form.q" class="input">
                <button class="btn mr-2" type="submit">Search</button>
                <inertia-link v-if="q" class="" href="/posts">Reset</inertia-link>
            </form>
        </div>

        <div v-if="pageInfo" class="flex justify-end mb-2">
            {{ pageInfo }}
        </div>

        <EntryList :entries="entries"/>

    </div>
</template>

<script>

import Layout from '@/Shared/Layout'
import EntryList from '@/Shared/EntryList'

export default {
    layout: Layout,
    components: {
        EntryList
    },
    props: {
        title: String,
        entries: Array,
        q: String,
        pageInfo: String,
        showSearch: {
            type: Boolean,
            default: true
        }
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
            this.$inertia.get('/posts', {q: this.form.q})
        }
    }
}
</script>
