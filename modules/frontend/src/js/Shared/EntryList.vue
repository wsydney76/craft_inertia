<template>
    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <tr class="text-left font-bold border-t">
                <th class="px-6 pt-6 pb-4">Title</th>
            </tr>
            <tr v-for="entry in entries" :key="entry.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                <td class="border-t">
                    <inertia-link class="px-6 py-4 flex items-center focus:text-brand-500"
                                  :href="entry.url">
                        {{ entry.title }}
                    </inertia-link>
                </td>

            </tr>
            <tr v-if="entries.length === 0">
                <td class="border-t px-6 py-4" colspan="4">No posts found.</td>
            </tr>
        </table>
    </div>
</template>

<script>
export default {
    name: "EntryList",
    props: {
        entries: Array
    }
}
</script>
