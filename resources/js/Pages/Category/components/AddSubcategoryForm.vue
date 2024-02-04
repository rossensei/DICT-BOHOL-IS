<script setup>
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    categoryId: Number,
})

const form = useForm({
    category_id: props.categoryId,
    subcatname: '',
})

const submit = () => {
    form.post('/subcategories/new-subcategory', {
        onSuccess: () => form.reset()
    })
}


const addNewSubcategory = () => {
    showAddSubcategoryForm.value = true;
}
</script>

<template>
    <div class="p-2">
        <form @submit.prevent="submit" class="flex items-center">
            <label for="add-subcategory" class="relative flex-1">
                <TextInput
                v-model="form.subcatname"
                id="add-subcategory"
                type="text"
                class="w-full"
                placeholder="New subcategory"
                />
    
                <button type="button" @click="form.reset()" class="absolute right-1 top-1/2 -translate-y-1/2 p-1.5 hover:bg-gray-100 text-xs text-gray-700 font-medium inline-flex items-center rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                      </svg>                                                                         
                </button>
            </label>
    
            <button type="submit" class="p-1.5 hover:bg-green-200 text-xs text-gray-700 hover:text-green-700 font-medium inline-flex items-center rounded-full ml-2">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                  </svg> -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>                                                                                  
            </button>
        </form>
    </div>
</template>