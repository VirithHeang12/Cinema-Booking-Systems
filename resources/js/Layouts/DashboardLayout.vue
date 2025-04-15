<template>

    <Head :title="title" />
    <v-app class="app-background">
        <Header />
        <v-main class="mt-2">
            <div class="main-content-wrapper">
                <slot>
                    Main content
                </slot>
            </div>
        </v-main>
        <Footer />
        <Menu />
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

<style scoped>
    .app-background {
        background-color: #f5f5f5;
    }

    .main-content-wrapper {
        max-width: 1600px;
        margin: 0 0 0 32px !important;
        padding: 0 16px;
    }

    /* Make sure the content area takes full height */
    .v-main {
        min-height: calc(100vh - 64px - 64px);
        /* Subtract header and footer heights */
        display: flex;
        flex-direction: column;
    }

    /* Make sure the content is properly aligned with the menu */
    @media (min-width: 960px) {
        .main-content-wrapper {
            margin-left: 72px;
            /* Width of collapsed menu */
            width: calc(100% - 72px);
            transition: margin-left 0.2s ease, width 0.2s ease;
        }
    }

    /* Adjust when menu is expanded */
    :deep(.v-navigation-drawer--expand-on-hover:hover)~.v-main .main-content-wrapper {
        margin-left: 240px;
        /* Width of expanded menu */
        width: calc(100% - 240px);
    }
</style>
