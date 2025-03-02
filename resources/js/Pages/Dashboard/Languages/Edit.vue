<template>
    <div>
        <h1>Edit Language</h1>
        <form @submit.prevent="submitForm">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" v-model="form.name" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="code">Code</label>
                <input type="text" v-model="form.code" class="form-control" id="code" name="code">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script setup>
    import { defineProps } from 'vue';
    import { useForm } from '@inertiajs/vue3';

    const props = defineProps({
        language: {
            type: Object,
            required: true,
        }
    });

    const form = useForm({
        name: props.language.name,
        code: props.language.code,
    });

    const submitForm = () => {
        form.put(route('dashboard.languages.update', props.language.id));
    }
</script>
