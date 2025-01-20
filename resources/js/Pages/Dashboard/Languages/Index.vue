<template>
    <button @click="createCallback">Create</button>
</template>

<script setup>
    import { router } from '@inertiajs/vue3';

    const createCallback = () => {
        router.get(route('dashboard.languages.create'));
    }

</script>
