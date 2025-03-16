<template>
    <Head :title="title" />
    <v-app class="!bg-yellow-50">
        <Header />
        <v-main class="d-flex align-start justify-center bg-neutral-50" style="min-height: 300px;">
            <v-container>
                <slot>
                    Main content
                </slot>
            </v-container>
        </v-main>
        <Footer/>
        <Menu/>
    </v-app>

</template>

<script setup>
    import { Head } from '@inertiajs/vue3';
    import Footer from './Partials/Dashboard/Footer.vue';
    import Header from './Partials/Dashboard/Header.vue';
    import Menu from './Partials/Dashboard/Menu.vue';

    defineProps({
        title: {
            type: String,
            default: 'Eternal',
        },
    });
</script>
