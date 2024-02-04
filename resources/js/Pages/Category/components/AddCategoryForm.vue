<script setup>
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    catname: ''
})

const submit = () => {
    form.post('/categories/new-category', {
        onSuccess: () => form.reset()
    })
}
</script>

<template>
    <div>
        <div v-show="form.errors.catname" class="rounded-lg p-2 bg-red-50 mb-3">
            <InputError :message="form.errors.catname" />
        </div>
        <form @submit.prevent="submit">
            <label for="new-category" class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                <path d="M19.5 21a3 3 0 0 0 3-3v-4.5a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3V18a3 3 0 0 0 3 3h15ZM1.5 10.146V6a3 3 0 0 1 3-3h5.379a2.25 2.25 0 0 1 1.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 0 1 3 3v1.146A4.483 4.483 0 0 0 19.5 9h-15a4.483 4.483 0 0 0-3 1.146Z" />
                </svg>
        
                <TextInput
                v-model="form.catname"
                id="new-category"
                type="text"
                class="w-full text-base rounded-lg pl-12 py-3"
                :class="{ 'border-red-700' : form.errors.catname }"
                placeholder="New Category"
                />
        
                <button type="submit" @click="addNewCategory" class="absolute right-2 top-1/2 -translate-y-1/2 px-4 py-2 text-sm text-white font-medium rounded-md bg-blue-600 hover:bg-blue-500">
                    Submit   
                </button>
            </label>
        </form>
    </div>
</template>