<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import WarningAlert from '@/Components/WarningAlert.vue';
import SuccessAlert from '@/Components/SuccessAlert.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import CategoryItem from './components/CategoryItem.vue';
import CategoryList from './components/CategoryList.vue';
import CategoryTree from './components/CategoryTree.vue';
import { Head, useForm, usePage, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    categories: Array
})

const form = useForm({
    catname: '',
})

const submit = () => {
    form.post('/categories/new-category', {
        onSuccess: () => form.reset()
    });
}

// HANDLE FLASH MESSAGE SERVER RESPONSE
const page = usePage();

const clearErrorMessage = () => {
    page.props.flash.error = null;
}

const clearSuccessMessage = () => {
    page.props.flash.success = null;
}

// DELETING CATEGORY
const showModal = ref(false);
const categoryToDelete = ref({})

const deleteCategory = (category) => {
    showModal.value = true;
    categoryToDelete.value = category;
}

const closeModal = () => {
    showModal.value = false;
}

const confirmDelete = () => {
    router.delete(`/categories/remove/${categoryToDelete.value.id}`, {
        onSuccess: () => {
            closeModal()
        }
    })
}
</script>

<template>
    <Head title="Categories" />

    <AppLayout>
        <!-- <template #header>
            <h1 class="text-2xl font-semibold text-gray-700">Categories</h1>
        </template> -->

        <div class="py-12">
            <div class="w-full px-12">
                <h1 class="text-2xl text-gray-700 font-bold">Categories</h1>
                <p class="text-gray-900 mb-4">Add categories, then associate items to them from items page. You can add categories and subcategories as many as you like.</p>

                <!-- Alert -->
                <WarningAlert v-if="page.props.flash.error" @close="clearErrorMessage" class="mb-4">
                    {{ page.props.flash.error }}
                </WarningAlert>

                <SuccessAlert v-if="page.props.flash.success" @close="clearSuccessMessage" class="mb-4">
                    {{ page.props.flash.success }}
                </SuccessAlert>

                <!-- <div class="p-4 bg-white shadow-sm w-[600px] rounded-lg border-l-8 border-blue-700 mb-4">
                    <form class="flex items-center space-x-2" @submit.prevent="submit">
                        <div class="flex-1 relative">
                            <TextInput
                            v-model="form.catname"
                            id="catname"
                            class="w-full text-sm rounded-md"
                            :class="{ 'border-red-600' : form.errors.catname }"
                            placeholder="Category"
                            />

                            <button
                            v-if="form.catname !== null && form.catname !== ''"
                            type="button"
                            @click="form.reset()"
                            class="absolute right-0 top-1/2 botton-1/2 transform -translate-x-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                            </svg>
                            </button>
                        </div>

                        <button type="submit" class="text-sm text-white bg-blue-700 hover:bg-blue-600 px-4 py-2 rounded-md" :disabled="form.processing">
                            <svg v-if="form.processing" aria-hidden="true" class="inline w-4 h-4 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span v-else>Create</span>
                        </button>
                    </form>
                    <InputError :message="form.errors.catname" />
                </div> -->

                <!-- <h1 class="text-xl font-semibold text-gray-700 mb-2">List of Categories</h1> -->
                
                <!-- <CategoryList>
                    <CategoryItem v-for="cat in categories" :key="cat.id" :category="cat" @delete="deleteCategory" />
                </CategoryList> -->
                <!-- <div class="p-4 bg-white shadow-sm border rounded-md max-w-4xl w-full divide-y divide-y-200">
                    <div>
                        <div class="flex items-center space-x-2 hover:bg-gray-900 hover:opacity-10 p-2">
                            <button type="button" class="rotate-90">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                    </svg>                                  
                            </button>
                            <div class="flex-1">
                                <span class="font-medium">Equipments</span>
                            </div>
                        </div>
                        <div class="border-l-2 border-gray-500 ml-2 p-2">
                            <div class="pl-4">
                                Computers
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center space-x-2 hover:bg-gray-900 hover:opacity-10 p-2">
                            <button type="button" class="rotate-90">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                    </svg>                                  
                            </button>
                            <div class="flex-1">
                                <span class="font-medium">Equipments</span>
                            </div>
                        </div>
                        <div class="border-l-2 border-gray-500 ml-3.5 p-2">
                            <div class="pl-4">
                                Computers
                            </div>
                        </div>
                    </div>
                </div> -->
                <CategoryTree :categories="props.categories" />
            </div>
        </div>
    </AppLayout>

    <!-- Delete Modal -->
    <Modal :show="showModal" maxWidth="xl" @close="closeModal">
        <div class="p-4">
            <div class="flex space-x-3 mb-3">
                <div class="shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-red-600">
                    <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h1 class="text-lg font-semibold text-red-600">Delete Confirmation</h1>
                    <p class="font-medium">Do you want to delete "{{ categoryToDelete.catname }}"?</p>
                </div>
                <div class="shrink-0">
                    <button type="button" @click="closeModal">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" @click="closeModal" class="px-4 py-2 bg-gray-500 hover:bg-gray-400 rounded-lg text-white font-medium">Cancel</button>
                <button type="button" @click="confirmDelete" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 rounded-lg text-white font-medium">Confirm</button>
            </div>
        </div>
    </Modal>
</template>