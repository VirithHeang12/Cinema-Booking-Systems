<template>
    <div>
        <h1>Create Screen Type</h1>
        <form @submit.prevent="submitForm">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" v-model="form.name" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" v-model="form.description" class="form-control" id="description" name="description">
            </div>
            <button type="submit"
                class="mt-4 duration-200 ease-in-out transform border-none hover:scale-105 btn btn-primary bg-gradient-to-r from-gray-200 to-red-300">Submit</button>
        </form>
    </div>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3'
    import { route } from 'ziggy-js'

    const form = useForm({
        name: '',
        description: '',
    });

    const submitForm = () => {
        form.post(route('dashboard.screen_types.store'));
    }
</script>
