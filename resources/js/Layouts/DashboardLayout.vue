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
    import { Head, usePage } from '@inertiajs/vue3';
    import Footer from './Partials/Dashboard/Footer.vue';
    import Header from './Partials/Dashboard/Header.vue';
    import Menu from './Partials/Dashboard/Menu.vue';
    import { watch } from 'vue';
    import { toast } from 'vue3-toastify';

    defineProps({
        title: {
            type: String,
            default: 'Eternal',
        },
    });

    /**
     * Notify the user
     *
     * @param {string} message
     * @param {string} type
     *
     * @return void
     */
    const notify = (message, type = 'success') => {
        toast(message, {
            autoClose: 1500,
            position: toast.POSITION.BOTTOM_RIGHT,
            type: type,
            hideProgressBar: true,
        });
    }

    const page = usePage();

    /**
     * Watch for flash messages
     *
     * @return void
     */
    watch(() => page.props.flash, (flash) => {
        const success = page.props.flash.success;
        const error = page.props.flash.error;

        if (success) {
            notify(success);
            page.props.flash.success = null;
        } else if (error) {
            notify(error, 'error');
            page.props.flash.error = null;
        }
    }, {
        deep: true,
        immediate: true,
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
