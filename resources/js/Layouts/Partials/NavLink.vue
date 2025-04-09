<script setup>
    import { Link } from '@inertiajs/vue3';
    import { __ } from 'matice';

    const props = defineProps({
        modelValue: String,
        justify: {
            type: String,
            default: 'space-between', // or 'start' for left alignment
        },
        showProfile: {
            type: Boolean,
            default: true, // Show profile by default
        },
    });

    const emit = defineEmits(['update:modelValue']);

    const navItems = [
        { title: __('home'), icon: 'mdi-home', path: '/' },
        { title: __('Promotions'), icon: 'mdi-tag', path: '/promotions' },
    ];

    // Conditionally add the Profile item for the bottom navigation
    if (props.showProfile) {
        navItems.push({ title: __('Profile'), icon: 'mdi-account', path: '#' });
    }

    const updateTab = (path) => {
        emit('update:modelValue', path);
    };
</script>

<template>
    <v-container class="d-flex gap-4 align-center" :class="`justify-${justify}`">
        <Link v-for="item in navItems" :key="item.path" :href="item.path"
            :class="{ 'active-tab': modelValue === item.path }" class="opacity-65 hover:opacity-100 text-white p-sm-1"
            @click="updateTab(item.path)">
        <v-btn size="small" text :prepend-icon="item.icon">
            <span class="text-[10px] md:text-base">{{ item.title }}</span>
        </v-btn>
        </Link>
    </v-container>
</template>

<style scoped>
    .active-tab {
        color: white !important;
        border-radius: 5px;
        background-color: rgba(255, 255, 255, 0.3);
    }
</style>
