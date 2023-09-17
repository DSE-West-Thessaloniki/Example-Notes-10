<template>
    <div>
        <Head :title="title" />

        <nav class="bg-green-500 text-white sticky top-0 left-0 w-full z-20">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <Link href="/" class="text-lg font-bold">Σημειώσεις</Link>
                <div v-if="$page.props.canLogin" class="d-flex justify-content-end">
                    <div>
                        <Link :href="route('logout')" method="post">
                        Αποσύνδεση
                        </Link>
                    </div>
                </div>
            </div>
        </nav>
        <div class="bg-yellow-400">
            <slot></slot>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import route from 'ziggy-js';

const props = defineProps<{
    title: string
}>();

</script>
