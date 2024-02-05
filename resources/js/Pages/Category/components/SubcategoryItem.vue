<script setup>
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import { ref } from 'vue';
import { router, useForm } from '@inertiajs/vue3';

const props = defineProps({
    subcategory: Object,
})

// EDITING CATEGORY
const editMode = ref(false);

const showEditForm = () => {
    editMode.value = true;
}

const cancelEdit = () => {
    editMode.value = false;
    form.reset();
    form.clearErrors();
}

// UPDATING CATEGORY
const form = useForm({
    subcatname: props.subcategory.subcatname,
})

const submit = () => {
    form.patch(`/subcategories/${props.subcategory.id}/update`, {
        onSuccess: () => {
            editMode.value = false;
        },
        preserveScroll: true,
    })
}

// HANDLE DELETE
// const emits = defineEmits(['delete'])
const deleteSubcategory = () => {
    router.delete(`/subcategories/${props.subcategory.id}/delete`)
}
</script>

<template>
    <div class="p-2 group">
        <div v-if="!editMode" class="flex justify-between items-center">
            <span id="subcategory-name">{{ subcategory.subcatname }}</span>
        
            <div class="flex items-center space-x-1 invisible group-hover:visible">
                <button type="button" @click="showEditForm" class="h-8 w-8 rounded-full hover:bg-gray-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                    </svg>                                      
                </button>
                <button type="button" @click="deleteSubcategory" class="h-8 w-8 rounded-full hover:bg-gray-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>                                      
                </button>
            </div>
        </div>
        <div v-else class="w-full">
            <!-- <div class="fixed inset-0 transform transition-all" @click="toggleEditForm">
                <div class="absolute inset-0 bg-black opacity-50" />
            </div> -->

            <div v-show="form.errors.subcatname" class="rounded-lg p-2 bg-red-50 mb-3">
                <InputError :message="form.errors.subcatname" />
            </div>

            <div class="">
                <form @submit.prevent="submit" class="flex justify-between items-center">
                    <label for="edit-category" class="relative w-full">
    
    
                        <TextInput
                        id="edit-category"
                        type="text"
                        v-model="form.subcatname"
                        class="w-full"
                        :class="{ 'border-red-700' : form.errors.subcatname }"
                        />
        
                        <button type="button" @click="form.reset()" class="absolute right-2 top-1/2 -translate-y-1/2 h-8 w-8 rounded-full hover:bg-gray-200 flex items-center justify-center">
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg> -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2z"/>
                                <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466"/>
                            </svg>                                                      
                        </button>
                    </label>

                    <div class="flex items-center space-x-2 ml-2">
                        <button type="submit" class="p-2 hover:bg-gray-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>                                                    
                        </button>
                        <button type="button" @click="cancelEdit" class="p-2 hover:bg-gray-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>                                                       
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>