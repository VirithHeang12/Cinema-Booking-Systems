<template>
    <div>
        <h1>Edit Language</h1>
        <h1>Name: {{ props.language.name }}</h1>
        <h1>Code: {{ props.language.code }}</h1>
    </div>
</template>

<script setup>
    import { defineProps } from 'vue';

    const props = defineProps({
        language: {
            type: Object,
            required: true,
        }
    });
</script>
