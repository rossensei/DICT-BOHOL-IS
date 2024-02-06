<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    message: String,
    credentials: Object
})
</script>

<template>
    <Head title="Success!" />

    <AppLayout>
        <div class="py-12">
            <div class="w-full px-12 flex items-center justify-center">
                <div class="bg-white rounded-lg w-[600px] h-[400px] shadow">
                    
                </div>
            </div>
        </div>
    </AppLayout>
</template>