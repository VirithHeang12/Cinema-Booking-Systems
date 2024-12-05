<template>
    <div>
        <form @submit.prevent="form.post(route('users.store'))">
            <input v-model="form.name" type="text" name="name" placeholder="Name">
            <input v-model="form.email" type="email" name="email" placeholder="Email">
            <input v-model="form.password" type="password" name="password" placeholder="Password">
            <button type="submit">Submit</button>
        </form>
    </div>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3';
    import { route } from 'ziggy-js';

    const form = useForm({
        name: '',
        email: '',
        password: '',
    });
</script>
