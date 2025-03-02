<template>
    <div>
        <h3 class="text-center mb-4">{{ __('Delete HallType') }}</h3>
        <p class="text-center text-gray-700 my-8">{{ __('Do you want to delete this HallType ?') }}</p>
        <div class="d-flex justify-content-center gap-4">
            <form @submit.prevent="submitForm">
                <button class="btn btn-danger">{{ __('Delete') }}</button>
            </form>
            <button class="btn btn-dark">{{ __('Cancel') }}</button>
        </div>
    </div>
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
