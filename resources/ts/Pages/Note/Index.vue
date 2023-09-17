<template>
    <div>
        <h1 class="text-2xl font-bold">Σημειώσεις <Link class="text-sm text-blue-500 underline" :href="route('note.create')">[+] Νέα σημείωση</Link></h1>
        <ul v-if="notes" class="list-disc list-inside">
            <li v-for="note in notes" :key="note.id" >
                <div class="text-lg inline-block">{{ note.title }} <Link class="text-sm text-blue-500 underline" :href="route('note.edit', note)">Επεξεργασία</Link> <Link class="text-sm text-blue-500 underline px-1" :href="route('note.destroy', note)" method="delete">Διαγραφή</Link></div>
                <div>{{ note.content }}</div>
            </li>
        </ul>
    </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import route from 'ziggy-js';

const props = defineProps<{
    notes: Array<App.Models.Note>
}>();
</script>
