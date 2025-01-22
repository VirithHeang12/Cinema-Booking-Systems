<template>
    <div class="container my-5 d-flex justify-content-center">
        <button class="btn btn-dark" @click="createCallback">Create</button>
    </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3';

const createCallback = () => {
    router.get(route('dashboard.classifications.create'));
}

</script>
