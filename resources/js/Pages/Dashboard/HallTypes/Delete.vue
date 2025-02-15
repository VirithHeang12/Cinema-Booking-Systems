<template>
    <Modal v-slot="{ close }">
        <div>
            <h3 class="text-center mb-4">Delete HallType</h3>
            <p class="text-center text-gray-700 my-8">Do you want to delete this HallType ?</p>
            <div class="d-flex justify-content-center gap-4">
                <form @submit.prevent="submitForm">
                    <button class="btn btn-danger" @click="close">Delete</button>
                </form>
                <button class="btn btn-dark" @click="close">Cancel</button>
            </div>
        </div>
    </Modal>
</template>

<script setup>
    import { defineProps } from 'vue';
    import { router } from '@inertiajs/vue3';

    const props = defineProps({
        hall_type: {
            type: Object,
            required: true,
        }
    });

    const submitForm = () => {
        router.delete(route('dashboard.hall_types.destroy', props.hall_type.id));
    }
</script>
