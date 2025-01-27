<template>
    <Modal v-slot="{ close }">
        <div>
            <h1 class="mb-4">Edit HallType</h1>
            <form @submit.prevent="submitForm">
                <div class="form-group mb-3">
                    <label for="id">ID</label>
                    <input type="text" v-model="form.id" class="form-control" id="id" name="id">
                </div>
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" v-model="form.name" class="form-control" id="name" name="name">
                </div>
                <div class="form-group mb-4">
                    <label for="description">Description</label>
                    <input type="text" v-model="form.description" class="form-control" id="description" name="description">
                </div>
                <button type="submit" @click="close" class="btn btn-dark text-white">Submit</button>
            </form>
        </div>
    </Modal>
</template>

<script setup>
    import { defineProps } from 'vue';
    import { useForm } from '@inertiajs/vue3';

    const props = defineProps({
        halltype: {
            type: Object,
            required: true,
        }
    });

    const form = useForm({
        name: props.halltype.name,
        description: props.halltype.description,
        id: props.halltype.id,
    });

    const submitForm = () => {
        form.put(route('dashboard.halltypes.update', props.halltype.id));
    }
</script>
