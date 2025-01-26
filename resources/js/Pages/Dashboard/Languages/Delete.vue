<template>
    <Modal v-slot="{ close }">
        <div>
            <h1>Delete Language</h1>
            <form @submit.prevent="submitForm">
                <button @click="close">Delete</button>
            </form>
        </div>
    </Modal>
</template>

<script setup>
    import { defineProps } from 'vue';
    import { router } from '@inertiajs/vue3';

    const props = defineProps({
        language: {
            type: Object,
            required: true,
        }
    });

    const submitForm = () => {
        router.delete(route('dashboard.languages.destroy', props.language.id));
    }
</script>
