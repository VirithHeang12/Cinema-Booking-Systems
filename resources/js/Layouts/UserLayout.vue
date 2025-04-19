<template>

    <Head :title="title" />
    <v-app>
        <Header />
        <v-main class="d-flex align-start justify-center bg-neutral-50 py-0 user-content" style="min-height: 300px;">
            <slot>
                <!-- Main content goes here -->
            </slot>
        </v-main>
        <Footer />
    </v-app>

</template>

<script setup>
    import { Head, usePage } from '@inertiajs/vue3';
    import Header from './Partials/Header.vue';
    import Footer from './Partials/Footer.vue';
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

    .user-content {
        position: relative;
        background-color: #242424;
        min-height: 100vh;
        z-index: 1;
    }

    .user-content::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at center,
                rgba(255, 0, 0, 0.2) 0%,
                rgba(128, 0, 0, 0.1) 50%,
                rgba(0, 0, 0, 0) 60%);
        z-index: -10;
        filter: blur(150px);
        pointer-events: none;
    }
</style>
