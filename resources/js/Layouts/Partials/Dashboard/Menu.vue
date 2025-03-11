<template>
    <v-navigation-drawer rail expand-on-hover :temporary="modalExists">
        <v-list density="compact">
            <v-list-item v-for="item in items" :key="item.value" :prepend-icon="item.icon" :title="__(item.title)"
                :value="item.value" @click="navigateCallback(item.route)">
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script setup>
    import { onMounted, onUnmounted, ref } from 'vue';
    import { router } from '@inertiajs/vue3';
    import { route } from 'ziggy-js';

    const modalExists = ref(false);

    /**
     * Check if modal exists
     *
     * @return void
     */
    const checkModal = () => {
        modalExists.value = document.querySelector('div[data-inertiaui-modal-id]') !== null;
    };

    /**
     * Check if modal exists on mounted and observe the body for changes
     *
     * @return void
     */
    onMounted(() => {
        checkModal();

        const observer = new MutationObserver(checkModal);
        observer.observe(document.body, { childList: true, subtree: true });

        onUnmounted(() => {
            observer.disconnect();
        });
    });

    const items = ref([
        {
            title: 'Movies',
            icon: 'mdi-movie',
            value: 'movies',
            route: 'dashboard.movies.index'
        },
        {
            title: 'Halls',
            icon: 'mdi-monitor',
            value: 'halls',
            route: 'dashboard.halls.index'
        },
        {
            title: 'Countries',
            icon: 'mdi-flag',
            value: 'countries',
            route: 'dashboard.countries.index'
        },
        {
            title: 'Languages',
            icon: 'mdi-translate',
            value: 'languages',
            route: 'dashboard.languages.index'
        },
        {
            title: 'Classifications',
            icon: 'mdi-tag',
            value: 'classifications',
            route: 'dashboard.classifications.index'
        },
        {
            title: 'Genres',
            icon: 'mdi-tag',
            value: 'genres',
            route: 'dashboard.genres.index'
        },
        {
            title: 'Screen Types',
            icon: 'mdi-monitor',
            value: 'screen_types',
            route: 'dashboard.screen_types.index'
        },
        {
            title: 'Hall Types',
            icon: 'mdi-monitor',
            value: 'hall_types',
            route: 'dashboard.hall_types.index'
        },
    ])

    const navigateCallback = (r) => {
        router.get(route(r));
    }
</script>
