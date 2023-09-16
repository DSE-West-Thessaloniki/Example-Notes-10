<template>
    <div>
        <h1 class="text-2xl font-bold">Σημειώσεις</h1>
        <ul v-if="notes" class="list-disc list-inside">
            <li v-for="note in notes" :key="note.id" >
                <div class="text-lg inline-block">{{ note.title }}</div>
                <div>{{ note.content }}</div>
            </li>
        </ul>
    </div>
</template>

<script setup lang="ts">
const props = defineProps<{
    notes: Array<App.Models.Note>
}>();
</script>
