<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    employees: Array,
})
</script>

<template>
    <Head title="New Employee" />

    <AppLayout>
        <div class="py-12">
            <div class="w-full px-12">
                <h1 class="text-2xl text-gray-700 font-bold">Create new employee</h1>
                <p class="text-sm text-gray-500 mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus maxime perferendis culpa accusantium expedita nam consequatur aspernatur sequi ullam.</p>
            </div>
        </div>
    </AppLayout>
</template>