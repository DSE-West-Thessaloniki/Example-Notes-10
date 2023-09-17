<template>
    <div>
        <Head :title="title" />

        <nav class="bg-black text-white sticky w-full z-20">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <Link href="/" class="text-lg font-bold">Σημειώσεις</Link>
                <div v-if="$page.props.canLogin" class="flex justify-end">
                <div>
                    <Link v-if="$page.props.user" :href="route('dashboard')" class="text-gray-300">
                    Dashboard
                    </Link>

                    <template v-else>
                    <Link :href="route('login')" class="text-gray-300">
                        Σύνδεση
                    </Link>

                    <Link v-if="$page.props.canRegister" :href="route('register')" class="ms-4 text-gray-300">
                        Εγγραφή
                    </Link>
                    </template>
                </div>
                </div>
            </div>
        </nav>
        <div class="container">
            <slot></slot>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import route from 'ziggy-js';

const props = defineProps<{
    title: string,
}>();
</script>
