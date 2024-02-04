<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    show: Boolean,
    categoryId: Number,
    subcategories: Array
})

const form = useForm({
    subcatname: '',
})

const submit = () => {
    form.post()
}

const showAddSubcategoryForm = ref(false)

const addNewSubcategory = () => {
    showAddSubcategoryForm.value = true;
}
</script>

<template>
    <Transition
    enter-from-class="-translate-y-4 opacity-0"
    enter-active-class="transition transform duration-300"
    enter-to-class="translate-y-0 opacity-100"
    leave-from-class="translate-y-0 opacity-100"
    leave-active-class="transition transform duration-300"
    leave-to-class="opacity-0 -translate-y-4"
    >
        <ul v-show="show" id="subcategory-list" class="pl-[40px]">
            <li id="subcategory-item">
                <div class="p-2">
                    <span v-if="!showAddSubcategoryForm" @click="addNewSubcategory">Click to add subcategory</span>
                    <input
                    v-else
                    type="text"
                    class="w-full text-sm"
                    placeholder="Add subcategory"
                    />
                </div>
            </li>
            <li id="subcategory-item" v-for="item in subcategories" :key="item.id">
                <div class="p-2">
                    {{ item.subcatname }}
                </div>
            </li>
            <!-- <li id="subcategory-item">
                <div class="p-2 flex justify-end">
                    <button type="button" @click="addNewSubcategory" class="px-3 py-2 rounded-lg bg-blue-600 hover:bg-blue-500 text-xs text-white font-medium inline-flex items-center">
                        New Subcategory
                    </button>
                </div>
            </li> -->
        </ul>
    </Transition>
</template>