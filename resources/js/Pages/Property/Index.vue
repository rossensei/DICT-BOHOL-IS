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
        <div class="py-12 px-8 w-full">
            <!-- <h1 class="text-2xl text-gray-700 font-bold mb-4">All Properties</h1> -->

            <!-- <div class="grid grid-cols-2 gap-2">
                <PropertyComponent v-for="property in properties.data" :key="property.id" :property="property" />
            </div> -->

            

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        All Properties
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
                    </caption>
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Property No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Property name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Category
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Unit
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="property in properties.data" :key="property.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <!-- <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Apple MacBook Pro 17"
                            </th> -->
                            <td class="px-6 py-4">
                                {{ property.property_no }}
                            </td>
                            <td class="px-6 py-4">
                                {{ property.item_name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ property.status }}
                            </td>
                            <td class="px-6 py-4">
                                {{ property.category.catname }} > {{ property.subcategory.subcatname }}
                            </td>
                            <td class="px-6 py-4">
                                {{ property.unit_value }} {{ property.measurement_unit }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>