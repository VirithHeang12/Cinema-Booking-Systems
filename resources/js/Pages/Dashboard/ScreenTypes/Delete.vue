<template>
    <Modal v-slot="{ close }">
        <div class="flex items-center justify-center bg-gray-100">
            <div class="w-full max-w-sm p-6 bg-white shadow-lg rounded-2xl">
                <h1 class="mb-4 text-2xl font-semibold text-center text-red-600">Delete Screen Type</h1>
                <p class="mb-6 text-center text-gray-600">
                    Are you sure you want to delete this screen type? This action cannot be undone.
                </p>
                <form @submit.prevent="submitForm" class="space-y-4">
                    <div class="flex items-center justify-between space-x-2">
                        <button type="button" @click="close"
                            class="w-full py-2 font-medium text-gray-700 transition bg-gray-300 rounded-lg hover:bg-gray-400">
                            Cancel
                        </button>
                        <button type="button" @click="close"
                            class="w-full py-2 font-medium text-red-700 transition bg-red-700 rounded-lg hover:bg-red-700">
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
import { route } from 'ziggy-js';

const props = defineProps({
    screen_type: {
        type: Object,
        required: true,
    }
});

const submitForm = () => {
    router.delete(route('dashboard.screen_types.destroy', props.screen_type.id));
}
</script>
