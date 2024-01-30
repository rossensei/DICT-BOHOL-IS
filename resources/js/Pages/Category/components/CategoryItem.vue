<script setup>
import TextInput from '@/Components/TextInput.vue';
import Modal from '@/Components/Modal.vue';
import InputError from '@/Components/InputError.vue';
import { router, useForm, usePage, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    category: Object
})

// EDITING CATEGORY
const editMode = ref(false);

const editCategory = () => {
    editMode.value = true;
}

const cancelEdit = () => {
    editMode.value = false;
    form.reset();
    form.clearErrors();
}

// UPDATING CATEGORY
const form = useForm({
    catname: props.category.catname,
})

const submit = () => {
    form.patch('/categories/update/' + props.category.id, {
        onSuccess: () => {
            editMode.value = false;
        },
        preserveScroll: true,
    })
}

// HANDLE DELETE
const emits = defineEmits(['delete'])
</script>
<template>
    <li class="group">
        <div class="p-3">
            <div>
                <div class="flex space-x-3" :class="{ 'items-center' : editMode }">
                    <div class="flex-1">
                        <!-- category name -->
                        <Link v-if="!editMode" :href="`/categories/${category.id}/subcategories`" class="underline text-blue-700">{{ category.catname }}</Link>
                        <TextInput v-else v-model="form.catname" class="w-full rounded-md" :class="{ 'border-red-600' : form.errors.catname }" @keyup.enter="submit" />
                    </div>
                    <div class="shrink-0">
                        <!-- action buttons -->
                        <div v-if="!editMode" class="space-x-3 invisible group-hover:visible">
                            <button type="button" @click="editCategory">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>
                            </button>
                            <button type="button" @click="emits('delete', props.category)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </div>
                        <div v-else class="space-x-3">
                            <button type="button" @click.prevent="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </button>
                            <button type="button" @click="cancelEdit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <InputError v-if="editMode" :message="form.errors.catname" />
            </div>
            
        </div>
    </li>
</template>