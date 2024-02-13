<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Table from '@/Components/Table.vue';
import TableHeadCell from '@/Components/TableHeadCell.vue';
import TableRow from '@/Components/TableRow.vue';
import TableDataCell from '@/Components/TableDataCell.vue';
import Dropdown from '@/Components/Dropdown.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { watch, ref } from 'vue';
import debounce from 'lodash/debounce';

const props = defineProps({
    offices: Array,
    filters: Object,
})

const params = ref({
    search: props.filters?.search,
    classifications: props.filters?.classifications,
})

watch(() => params, debounce(() => {
    const q = params.value;

    Object.keys(q).forEach(key => {
        // if((Array.isArray(q[key]) && q[key].length === 0) || q[key] === '' || q[key] === null) {
        //     delete q[key];
        // }
        console.log(q[key])
    })

    // router.get('/offices', q, { preserveState: true, replace: true });
}, 300), {
    deep: true,
})
</script>

<template>
    <Head title="Manage Offices" />

    <AppLayout>
        <div class="py-12">
            <div class="w-full px-12">
                <h1 class="text-2xl text-gray-700 font-bold">Manage Offices</h1>
                <p class="text-sm text-gray-500 mb-4">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>

                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center space-x-2">

                        <Dropdown align="left" width="48">
                            <template #trigger>
                                <button type="button" class="px-4 w py-2 text-sm text-white font-medium bg-blue-700 hover:bg-blue-600 rounded-lg">Filter</button>
                            </template>
                            <template #content>
                                <div class="p-2">
                                    <p class="text-md font-medium mb-1">Classification</p>
                                    <ul class="text-sm text-gray-600">
                                        <li>
                                            <div class="flex items-center p-2 rounded hover:bg-gray-100">
                                                <input id="checkbox-item-1" type="checkbox" v-model="params.classifications" value="DICT-DTC" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                                <label for="checkbox-item-1" class="w-full ms-2 text-sm font-medium text-gray-900 rounded">DICT-DTC</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="flex items-center p-2 rounded hover:bg-gray-100">
                                                <input id="checkbox-item-2" type="checkbox" v-model="params.classifications" value="Tech4ED Center" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                                <label for="checkbox-item-2" class="w-full ms-2 text-sm font-medium text-gray-900 rounded">Tech4ED Center</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </template>
                        </Dropdown>

                        <!-- Search Input-->
                        <label for="search" class="relative">
                            <input 
                            id="search"
                            v-model="params.search"
                            type="text" 
                            class="rounded-lg text-sm pl-8 w-[200px] focus:w-[300px] transition-[width] ease-out border-gray-300" 
                            placeholder="Search for office"
                            >

                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </span>
                        </label>
                    </div>
                </div>

                <Table>
                    <template #table-head>
                        <TableHeadCell>Office Name</TableHeadCell>
                        <TableHeadCell>Location</TableHeadCell>
                        <TableHeadCell>Date Created</TableHeadCell>
                        <TableHeadCell>Actions</TableHeadCell>
                    </template>
                    <template #table-body>
                        <TableRow v-for="office in offices" :key="office.id" class="bg-white">
                            <TableDataCell>
                                <div>
                                    <div class="text-[1rem] font-medium text-gray-700">{{ office.office_name }}</div>
                                    <div class="text-sm text-gray-500">{{ office.classification }}</div>
                                </div>
                            </TableDataCell>
                            <TableDataCell>
                                <div class="text-gray-500">
                                    {{ office.location }}
                                </div>
                            </TableDataCell>
                            <TableDataCell>{{ new Date(office.created_at).toLocaleDateString() }}</TableDataCell>
                            <TableDataCell>
                                <div class="flex items-center space-x-2">
                                    <Link id="edit-button" :href="`/offices/edit/${office.id}`" data-tool-tip="Edit" class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </Link>
                                    <Link id="delete-button" :href="`/offices/${office.id}`" method="DELETE" as="button" data-tool-tip="Delete" class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </Link>
                                </div>
                            </TableDataCell>
                        </TableRow>
                    </template>
                </Table>
            </div>
        </div>
    </AppLayout>
</template>