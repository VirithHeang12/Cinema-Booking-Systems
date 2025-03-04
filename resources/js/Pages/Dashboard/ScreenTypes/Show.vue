<template>
    <Modal>
        <div class="bg-gradient-to-r from-gray-200 to-red-300 rounded-lg shadow-lg overflow-hidden">
            <div class="bg-red-500 text-white text-center py-2">
                <h2 class="text-xl font-bold uppercase">Screen Type</h2>
            </div>
            <div class="p-4">
                <h2 class="text-lg font-bold text-white-800">Name: {{ props.screen_type.name }}</h2>
                <p class="text-white-700 mt-2">Description: {{ props.screen_type.description }}</p>
            </div>
        </div>
    </Modal>
</template>

<script setup>
    import { defineProps } from 'vue';

    const props = defineProps({
        screen_type: {
            type: Object,
            required: true,
        }
    });
</script>
