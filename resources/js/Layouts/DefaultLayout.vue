<template>

    <Head title="Welcome" />
    <v-app>
        <Header />
        <v-main class="d-flex align-center justify-center" style="min-height: 300px;">
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

</script>

<style scoped></style>
