<template>
    <Modal v-slot="{ close }">
        <div>
            <h4 class="text-gray-600">Edit Country</h4>
            <form @submit.prevent="submitForm">
                <div class="form-group">
                    <label for="name" class="text-gray-600">Name</label>
                    <input type="text" v-model="form.name" class="form-control" id="name" name="name">
                </div>
                <button type="submit" @click="close" class="btn btn-primary text-white mt-5">Submit</button>
            </form>
        </div>
    </Modal>
</template>

<script setup>
    import { defineProps } from 'vue';
    import { useForm } from '@inertiajs/vue3';

    const props = defineProps({
        country: {
            type: Object,
            required: true,
        }
    });

    const form = useForm({
        name: props.country.name,
    });

    const submitForm = () => {
        form.put(route('dashboard.countries.update', props.country.id));
    }
</script>
