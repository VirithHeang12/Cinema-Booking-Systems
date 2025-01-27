<template>
    <Modal v-slot="{ close }">
        <div>
            <h4 class="text-gray-600">Create Country</h4>
            <form @submit.prevent="submitForm">
                <div class="form-group">
                    <label for="name" class="text-gray-600">Name</label>
                    <input type="text" v-model="form.name" class="form-control" id="name" name="name">
                </div>
                <button type="submit" @click="close" class="btn btn-primary mt-5 text-white">Submit</button>
            </form>
        </div>
    </Modal>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3';

    const form = useForm({
        name: '',
    });

    const submitForm = () => {
        form.post(route('dashboard.countries.store'));
    }

</script>
