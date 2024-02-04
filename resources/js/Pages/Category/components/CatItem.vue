<script setup>
const props = defineProps({
    category: Object,
})
</script>

<template>
    <li id="category-item">
        <div id="details" class="p-2 rounded-lg">
            <div class="flex items-center space-x-2">
                <button type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 rotate-90">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                      </svg>                                  
                </button>

                <span id="category-name">{{ category.catname }}</span>
            </div>

            <ul id="subcategory-list" v-if="category.subcategories.length" class="pl-[36px]">
                <li id="subcategory-item" v-for="subcatItem in category.subcategories" :key="subcatItem.id">
                    <div class="p-2">
                        {{ subcatItem.subcatname }}
                    </div>
                </li>
            </ul>
        </div>
    </li>
</template>