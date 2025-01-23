<template>
    <Modal v-slot="{ close }">
        <div>
            <h1>Create Screen Type</h1>
            <form @submit.prevent="submitForm">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" v-model="form.name" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" v-model="form.description" class="form-control" id="description"
                        name="description">
                </div>
                <button type="submit" @click="close" class="btn btn-primary mt-4">Submit</button>
            </form>
        </div>
    </Modal>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    name: '',
    description: '',
});

const submitForm = () => {
    form.post(route('dashboard.screen-types.store'));
}
</script>
