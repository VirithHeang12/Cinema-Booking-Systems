<template>
    <div>
        <h1>Create Country</h1>
        <form @submit.prevent="submitForm">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" v-model="form.name" class="form-control" id="name" name="name">
            </div>
            <button class="btn btn-dark me-3 mt-5 " @click="btnBack">Back</button>
            <button type="submit" class="btn btn-primary mt-5 text-white">Submit</button>
        </form>
    </div>
</template>

<script setup>
    import { useForm} from '@inertiajs/vue3';

    const form = useForm({
        name: '',
    });

    const submitForm = () => {
        form.post(route('dashboard.countries.store'));
    }





</script>
