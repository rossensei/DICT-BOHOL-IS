<script setup>
import { ref, defineEmits } from 'vue';

const isVisible = ref(true);

const emits = defineEmits(['close']);
</script>

<template>
    <div class="flex p-3 space-x-3 rounded-lg bg-green-200">
        <div class="shrink-0">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-700">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
            </span>
        </div>
        <div class="flex-1">
            <h1 class="text-lg font-semibold text-green-700">Success!</h1>
            <p class="text-green-700">
                <slot />
            </p>
        </div>
        <div class="shrink-0">
            <button type="button" @click="emits('close')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
</template>