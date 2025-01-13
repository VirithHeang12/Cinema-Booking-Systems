<template>
    <div>
        <h1>{{ __('about') }}</h1>
        <p>{{ __('about_description') }}</p>
        <p>{{ name }}</p>
        <p>{{ age }}</p>
        <p>{{ location }}</p>
    </div>
</template>

<script>
    import Layout from '@/Layouts/TestLayout.vue';
    export default {
        layout: Layout,
    }
</script>

<script setup>

    const props = defineProps({
        name: {
            type: String,
            required: true,
        },
        age: {
            type: Number,
            required: true,
        },
        location: {
            type: String,
            required: true,
        }
    });
</script>
