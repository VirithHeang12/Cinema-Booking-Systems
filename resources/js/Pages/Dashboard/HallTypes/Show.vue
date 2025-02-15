<template>
    <Modal>
        <div class="px-4">
            <h1 class="text-center py-4">Show HallType</h1>
            <div class="text-gray-700">
                <h5>HallType ID : <span class="text-gray-600 font-normal">{{ props.hall_type.id }}</span></h5>
                <h5>Name: <span class="text-gray-600 font-normal">{{ props.hall_type.name }}</span></h5>
                <h5>Description: <span class="text-gray-600 font-normal">{{ props.hall_type.description }}</span></h5>
            </div>
        </div>
    </Modal>
</template>

<script setup>
    import { defineProps } from 'vue';

    const props = defineProps({
        hall_type: {
            type: Object,
            required: true,
        }
    });
</script>
