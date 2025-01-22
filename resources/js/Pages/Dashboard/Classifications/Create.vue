<template>
    <div class="container mt-5 d-flex flex-column align-items-center">
        <h1 class="fw-semibold">Create Classification</h1>
        <form @submit.prevent="submitForm" class="col-6">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" v-model="form.name" id="name" name="name" placeholder="Enter name">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" v-model="form.description" id="description" name="description" rows="3" placeholder="Enter description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';


const form = useForm({
    name: '',
    description: ''
});
const submitForm = () => {
    form.post(route('dashboard.classifications.store'));
};
</script>
