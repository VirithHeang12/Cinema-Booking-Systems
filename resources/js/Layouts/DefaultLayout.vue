<template>

    <Head :title="title" />
    <v-app>
        <Header />
        <v-main class="d-flex align-start justify-center bg-neutral-50" style="min-height: 300px;">
            <slot>
                Main content
            </slot>
        </v-main>
        <Footer />
    </v-app>

</template>

<script setup>
    import { Head } from '@inertiajs/vue3';
    import Header from './Partials/Header.vue';
    import Footer from './Partials/Footer.vue';

    defineProps({
        title: {
            type: String,
            default: 'Eternal',
        },
    });
</script>

<style scoped></style>
