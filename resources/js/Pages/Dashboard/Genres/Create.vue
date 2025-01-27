<template>
    <Modal v-slot="{ close }">
        <div>
            <h1 class="text-lg font-semibold mb-4 text-primary-900 text-center">Create Genre</h1>
            <hr class="my-2" />
            <form @submit.prevent="submitForm">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" v-model="form.name" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" v-model="form.description" class="form-control" id="description" name="description">
                </div>
                <button type="submit" @click="close" class="btn btn-dark text-white w-full mt-4 bg-primary-800 round-[10px] px-9 py-2 hover:bg-gray-800">Submit</button>
            </form>
        </div>
    </Modal>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3';

    const form = useForm({
        name: '',
        description: '',
    });

    const submitForm = () => {
        form.post(route('dashboard.genres.store'));
    }
   

</script>
