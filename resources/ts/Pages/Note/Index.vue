<template>
    <MainLayout title="Σημειώσεις">
        <div>
            <h1 class="text-2xl font-bold">Οι Σημειώσεις μου <Link class="text-sm text-blue-500 underline" :href="route('note.create')">[+] Νέα σημείωση</Link></h1>
            <ul v-if="notes" class="list-disc list-inside">
                <li v-for="note in notes" :key="note.id" >
                    <div class="text-lg inline-block">{{ note.title }}
                        <Link class="text-sm text-blue-500 underline px-1" :href="route('note.edit', note)">Επεξεργασία</Link>
                        <Link class="text-sm text-blue-500 underline px-1" :href="route('note.destroy', note)" method="delete">Διαγραφή</Link>
                        <Link class="text-sm text-blue-500 underline px-1" :href="route('note.copy', note)" method="post">Αντιγραφή</Link>
                    </div>
                    <div>{{ note.content }}</div>
                </li>
            </ul>
        </div>
    </MainLayout>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import route from 'ziggy-js';
import MainLayout from '@/Layouts/MainLayout.vue';

const props = defineProps<{
    notes: Array<App.Models.Note>
}>();
</script>
