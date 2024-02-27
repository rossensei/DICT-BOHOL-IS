<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Modal from '@/Components/Modal.vue';
import Table from '@/Components/Table.vue';
import TableDataCell from '@/Components/TableDataCell.vue';
import TableHeadCell from '@/Components/TableHeadCell.vue';
import TableRow from '@/Components/TableRow.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';


const props = defineProps({
    categories: Object
})

const showModal = ref(false);
const categoryToDelete = ref(null);

const showConfirmationModal = (category) => {
    categoryToDelete.value = category;
    showModal.value = true;
}

const hideConfirmationModal = () => {
    showModal.value = false;
    categoryToDelete.value = null;
}

const confirmDelete = () => {
    if(categoryToDelete.value) {
        router.delete(route('category.destroy', categoryToDelete.value.id), {
            onFinish: () => hideConfirmationModal()
        });
    }
}
</script>

<template>
    <Head title="Categories" />

    <AppLayout>
        <div class="py-12">
            <div class="w-full px-12">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-2xl text-gray-700 font-bold">Categories</h1>

                    <Link :href="route('category.create')" class="px-4 py-2 text-white text-sm font-medium bg-blue-600 hover:bg-blue-500 rounded-lg inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Create
                    </Link>
                </div>

                <div class="p-4 bg-white mt-4 shadow-md rounded-lg">
                    <!-- <ul class="text-sm w-full divide-y divide-gray-300 bg-white">
                        <li v-for="category in categories.data" :key="category.id">
                            <div class="flex items-start space-x-3 hover:bg-gray-50 p-4 rounded-lg">
                                <div class="flex-1 text-gray-500">
                                    {{ category.catname }} &#8208; <span class="text-gray-700 font-semibold">{{ category.code }}</span>
                                </div>
                                <div class="shrink-0 divide-x divide-gray-600">
                                    <Link :href="route('category.edit', category.id)" class="px-2 font-medium text-blue-600">Edit</Link>
                                    <Link :href="route('category.destroy', category.id)" as="button" method="DELETE" class="px-2 font-medium text-red-600">Delete</Link>
                                    <button type="button" @click="showConfirmationModal(category)" class="px-2 font-medium text-red-600">Delete</button>
                                </div>
                            </div>
                        </li>
                    </ul> -->

                    <Table>
                        <template #table-head>
                            <TableHeadCell class="w-[50px]">#</TableHeadCell>
                            <TableHeadCell class="w-[400px]">Category name</TableHeadCell>
                            <TableHeadCell>Code</TableHeadCell>
                            <!-- <TableHeadCell>Created At</TableHeadCell> -->
                            <TableHeadCell class="w-[200px]">Actions</TableHeadCell>
                        </template>
                        <template #table-body>
                            <TableRow v-for="category in categories.data" :key="category.id">
                                <TableDataCell>{{ category.id }}</TableDataCell>
                                <TableDataCell class="text-gray-700 font-medium">{{ category.catname }}</TableDataCell>
                                <TableDataCell>{{ category.code }}</TableDataCell>
                                <TableDataCell>Edit | Delete</TableDataCell>
                            </TableRow>
                        </template>
                    </Table>
                </div>
            </div>
        </div>
    </AppLayout>

    <!-- Delete Modal -->
    <Modal :show="showModal" maxWidth="lg" @close="hideConfirmationModal">
        <div class="p-6 space-y-3">
            <!-- <div class="flex space-x-3 mb-3">
                <div class="shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-red-600">
                    <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h1 class="text-xl font-semibold text-red-600 mb-2">Delete Confirmation</h1>
                    <p class="font-medium text-sm">Do you want to delete "{{ categoryToDelete.catname }}"?</p>
                </div>
                <div class="shrink-0">
                    <button type="button" @click="hideConfirmationModal">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div> -->
            <div>
                <h1 class="text-xl font-semibold text-red-600 mb-2">Delete Confirmation</h1>
                <p class="font-medium text-sm">You are about to delete "{{ categoryToDelete.catname }}", you will not be able to recover it. Do you want to proceed?</p>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" @click="hideConfirmationModal" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg text-sm text-gray-700 font-medium">Cancel</button>
                <button type="button" @click="confirmDelete" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 rounded-lg text-sm text-white font-medium">Confirm</button>
            </div>
        </div>
    </Modal>
</template>