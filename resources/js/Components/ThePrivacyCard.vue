<template>
    <v-container>
        <div class="grid grid-cols-1 gap-6">
            <v-card-title class="py-0 text-lg font-bold text-gray-300">{{ title }}</v-card-title>
            <p class="px-[16px] whitespace-pre-line ">{{ description }}</p>
        </div>
    </v-container>
</template>

<script setup>
defineProps(['title', 'description'])
</script>
