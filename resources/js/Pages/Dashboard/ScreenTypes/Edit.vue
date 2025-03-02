<template>
    <div>
        <h1>Edit Screen Type</h1>
        <form @submit.prevent="submitForm">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" v-model="form.name" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="code">Description</label>
                <input type="text" v-model="form.description" class="form-control" id="description" name="description">
            </div>
            <button type="submit"
                class="mt-4 duration-200 ease-in-out transform border-none hover:scale-105 btn btn-primary bg-gradient-to-r from-gray-200 to-red-300">Submit</button>
        </form>
    </div>
</template>

<script setup>
    import { defineProps } from 'vue';
    import { useForm } from '@inertiajs/vue3';
    import { route } from 'ziggy-js';

    const props = defineProps({
        screen_type: {
            type: Object,
            required: true,
        }
    });

    const form = useForm({
        name: props.screen_type.name,
        description: props.screen_type.description,
    });

    const submitForm = () => {
        form.put(route('dashboard.screen_types.update', props.screen_type.id));
    }
</script>
