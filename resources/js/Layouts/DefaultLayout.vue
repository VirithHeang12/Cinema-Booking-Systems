<template>
    <v-app>
        <Header />
        <!-- <v-navigation-drawer>
            <v-list>
                <v-list-item title="Drawer left"></v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-navigation-drawer location="right">
            <v-list>
                <v-list-item title="Drawer right"></v-list-item>
            </v-list>
        </v-navigation-drawer> -->
        <v-main class="d-flex align-center justify-center" style="min-height: 300px;">
            <slot>
                Main content
            </slot>
        </v-main>
        <Footer />
    </v-app>

</template>

<script setup>
    import Header from './Partials/Header.vue';
    import Footer from './Partials/Footer.vue';

</script>

<style scoped></style>
