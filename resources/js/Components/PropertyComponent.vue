<script setup>
const props = defineProps({
    property: Object,
})
</script>
<template>
    <div class="w-[280px] bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
            <img class="p-8 rounded-t-lg" src="https://cdn.shopify.com/s/files/1/0070/7032/files/image5_4578a9e6-2eff-4a5a-8d8c-9292252ec848.jpg?v=1620247043" alt="product image" />
        </a>
        <div class="px-5 pb-5">
            <!-- <a href="#">
                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ property.item_name }}</h5>
            </a>
            <div class="flex items-center mt-2.5 mb-5">
                {{ property.property_no }}
            </div>
            <div class="flex items-center justify-between">
                <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ property.unit_value }} {{ property.measurement_unit }}</span>
                <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add to cart</a>
            </div> -->
        </div>
    </div>
</template>