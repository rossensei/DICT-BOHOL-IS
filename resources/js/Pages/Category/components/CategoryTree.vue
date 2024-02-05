<script setup>
import { ref } from 'vue';
import AddCategoryForm from './AddCategoryForm.vue';
import AddSubcategoryForm from './AddSubcategoryForm.vue';
import CategoryItem from './CategoryItem.vue';
import SubcategoryItem from './SubcategoryItem.vue';
import SubcategoryList from './SubcategoryList.vue';

const props = defineProps({
    categories: Array,
})

const collapsedCategories = ref([]);

const toggleCollapse = (categoryId) => {
    const index = collapsedCategories.value.indexOf(categoryId);

    if (index === -1) {
    collapsedCategories.value.push(categoryId);
    } else {
    collapsedCategories.value.splice(index, 1);
    }
}
</script>

<template>
    <div id="tree" class="p-4 shadow max-w-4xl rounded-lg bg-white">
        <AddCategoryForm></AddCategoryForm>
        <ul id="category-list">
            <li id="category-item" v-for="catItem in categories" :key="catItem.id">
                <div id="details" class="p-2 rounded-lg">
                    <div class="flex items-center space-x-2">
                        <button type="button" @click="toggleCollapse(catItem.id)" class="h-8 w-8 rounded-full hover:bg-gray-100 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 duration-300" :class="{ 'rotate-90' : !collapsedCategories.includes(catItem.id) }">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>                                  
                        </button>
        
                        <CategoryItem :category="catItem"></CategoryItem>
                    </div>
                    
                    <!-- <SubcategoryList :show="collapsedCategories.includes(catItem.id)" :categoryId="catItem.id" :subcategories="catItem.subcategories"></SubcategoryList> -->
                    <Transition
                    enter-from-class="-translate-y-4 opacity-0"
                    enter-active-class="transition transform duration-300"
                    enter-to-class="translate-y-0 opacity-100"
                    leave-from-class="translate-y-0 opacity-100"
                    leave-active-class="transition transform duration-300"
                    leave-to-class="opacity-0 -translate-y-4"
                    >
                        <ul v-show="collapsedCategories.includes(catItem.id)" id="subcategory-list" class="pl-[40px]">
                            <li id="subcategory-item">
                                <AddSubcategoryForm :categoryId="catItem.id"></AddSubcategoryForm>
                            </li>
                            <li id="subcategory-item" v-for="item in catItem.subcategories" :key="item.id">
                                <SubcategoryItem :subcategory="item"></SubcategoryItem>
                            </li>
                        </ul>
                    </Transition>
                </div>
            </li>
        </ul>
    </div>
</template>