<template>
    <v-app>
        <v-main class="d-flex align-center justify-center" style="min-height: 300px;">
            <slot>
                Main content
            </slot>
        </v-main>
        <Footer />
    </v-app>

</template>

<script setup>
    import Footer from './Partials/Footer.vue';

</script>

<style scoped></style>
