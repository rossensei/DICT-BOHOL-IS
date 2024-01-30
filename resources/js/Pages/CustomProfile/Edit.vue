<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    userInfo: Object,
    credentials: Object
});
</script>

<template>
    <Head title="Profile" />
    <AppLayout>
        <template #header>
            <h1 class="text-2xl font-semibold text-gray-700">My Profile</h1>
        </template>
    </AppLayout>
</template>