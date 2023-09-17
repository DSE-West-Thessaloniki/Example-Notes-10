<template>
    <MainLayout title="Σημειώσεις">
        <div>
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">Οι Σημειώσεις μου <Link class="text-sm text-blue-500 underline" :href="route('note.create')">[+] Νέα σημείωση</Link></h1>
                <input type="text" name="filter" v-model="filter" class="w-3/12" placeholder="Αναζήτηση..."/>
            </div>
            <ul v-if="notes" class="list-disc list-inside">
                <li v-for="note in notes.data" :key="note.id" >
                    <div class="text-lg inline-block">{{ note.title }}
                        <Link class="text-sm text-blue-500 underline px-1" :href="route('note.edit', note)">Επεξεργασία</Link>
                        <Link class="text-sm text-blue-500 underline px-1" :href="route('note.destroy', note)" method="delete">Διαγραφή</Link>
                        <Link class="text-sm text-blue-500 underline px-1" :href="route('note.copy', note)" method="post">Αντιγραφή</Link>
                    </div>
                    <div>{{ note.content }}</div>
                </li>
            </ul>
            <nav v-if="notes.next_page_url !== notes.prev_page_url">
                <ul class="list-style-none flex justify-center py-3">
                    <li v-for="link in notes.links" :class="pageItemClass(link)">
                        <Link v-if="link.url" class="px-2" :href="link.url" v-html="link.label"></Link>
                        <span v-else v-html="link.label" class="px-2"></span>
                    </li>
                </ul>
            </nav>
        </div>
    </MainLayout>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import route from 'ziggy-js';
import MainLayout from '@/Layouts/MainLayout.vue';
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import throttle from 'lodash/throttle';

const props = defineProps<{
    notes: { data: Array<App.Models.Note>, links: Array<typeof Link>, next_page_url: string, prev_page_url: string },
    filters?: {"filter": string}
}>();

let filter = ref(props.filters?.filter);

watch(filter, throttle(value => {
    router.get(route('note.index'), { filter: value }, {
        preserveState: true,
	    replace: true
    });
}, 300));

function pageItemClass(item: typeof Link) {
    if (item.url) {
        if (item.active) {
            return "bg-green-600 rounded";
        }

        return "hover:bg-green-600 rounded";
    }

    return "text-gray-600";
}
</script>
