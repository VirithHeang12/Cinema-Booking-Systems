<template>
    <Modal v-slot="{ close }">
        <div>
            <h1>Create Language</h1>
            <form @submit.prevent="submitForm">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" v-model="form.name" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" v-model="form.code" class="form-control" id="code" name="code">
                </div>
                <button type="submit" @click="close" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </Modal>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3';

    const form = useForm({
        name: '',
        code: '',
    });

    const submitForm = () => {
        form.post(route('dashboard.languages.store'));
    }

</script>
