<template>
    <div>
        <Head title="Δημιουργία νέας σημείωσης"/>
        <div class="container mx-auto">
            <div class="flex justify-center my-5">
                <div class="w-1/3 rounded overflow-hidden shadow-lg">
                    <div class="bg-orange-500 font-bold text-xl p-2">
                        Νέα σημείωση
                    </div>
                    <div class="text-base p-2">
                        <form @submit.prevent="submit">
                            <div class="mb-3">
                                <label for="title" class="block">Τίτλος:</label>
                                <input id="title" class="w-full" v-model="form.title" required/>
                                <div v-if="form.errors.title" v-text="form.errors.title" class="text-red-600 text-sm"></div>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="block">Περιεχόμενο:</label>
                                <textarea id="content" class="w-full" v-model="form.content" required/>
                                <div v-if="form.errors.content" v-text="form.errors.content" class="text-red-600 text-sm"></div>
                            </div>
                            <div class="flex justify-between">
                                <Link class="bg-red-600 rounded px-2 py-1" :href="route('note.index')" as="button">Άκυρο</Link>
                                <button class="bg-blue-500 rounded px-2 py-1" type="submit">Αποθήκευση</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import route from 'ziggy-js';

let form = useForm({
    title: "",
    content: "",
})

function submit() {
    form.post(route('note.store'));
}
</script>
