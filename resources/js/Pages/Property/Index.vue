<script setup>
import TextInput from '@/Components/TextInput.vue';
import PropertyComponent from '@/Components/PropertyComponent.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    properties: Object,

})
</script>
<template>
    <Head title="All Properties" />
    <AppLayout>
        <div class="p-12 w-full">
            <h1 class="text-2xl text-gray-700 font-bold mb-4">All Properties</h1>

            <div class="grid grid-cols-4 gap-4">
                <PropertyComponent v-for="property in properties.data" :key="property.id" :property="property" />
            </div>
        </div>
    </AppLayout>
</template>