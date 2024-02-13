<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    credentials: Object
})
</script>

<template>
    <Head title="Success!" />

    <AppLayout>
        <div class="py-12">
            <div class="w-full px-12">
                <h1 class="text-2xl text-gray-700 font-bold">Default Login Credentials</h1>
                <p class="text-sm text-gray-500 mb-4">{{ props.credentials.username }}  {{ props.credentials.password }}</p>
            </div>
        </div>
    </AppLayout>
</template>