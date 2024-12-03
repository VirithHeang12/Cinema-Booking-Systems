<template>
    <div>
        <h1 class="bg-red-400">Index Page</h1>
        <v-btn @click="clickCallback">Cars</v-btn>
    </div>
</template>

<script setup>
    import { router } from '@inertiajs/vue3';

    const clickCallback = () => {
        router.get('/cars');
    }
</script>
