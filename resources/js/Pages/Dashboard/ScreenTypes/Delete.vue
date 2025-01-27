<template>
    <Modal v-slot="{ close }">
        <div class="flex items-center justify-center bg-gray-100">
            <div class="bg-white rounded-2xl shadow-lg p-6 max-w-sm w-full">
                <h1 class="text-2xl font-semibold text-red-600 text-center mb-4">Delete Screen Type</h1>
                <p class="text-gray-600 text-center mb-6">
                    Are you sure you want to delete this screen type? This action cannot be undone.
                </p>
                <form @submit.prevent="submitForm" class="space-y-4">
                    <div class="flex items-center justify-between space-x-2">
                        <button type="button" @click="close"
                            class="w-full bg-gray-300 text-gray-700 font-medium py-2 rounded-lg hover:bg-gray-400 transition">
                            Cancel
                        </button>
                        <button type="submit"
                            class="w-full bg-red-600 text-white font-medium py-2 rounded-lg hover:bg-red-700 transition">
                            Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </Modal>
</template>

<script setup>
import { defineProps } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    screen_type: {
        type: Object,
        required: true,
    }
});

const submitForm = () => {
    router.delete(route('dashboard.screen-types.destroy', props.screen_type.id));
}
</script>
