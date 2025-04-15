<template>
    <v-navigation-drawer class="cinema-sidebar" :rail="!expanded" :expand-on-hover="!expanded" :temporary="modalExists"
        :width="240" color="#f5f5f5">
        <div class="app-title py-4 px-4" v-if="expanded">
            <h2 class="text-h6 font-weight-bold">Eternal Cineplex</h2>
        </div>

        <v-list density="compact" nav class="mt-2">
            <!-- Movies -->
            <v-list-item prepend-icon="mdi-movie" :title="__('Movies')" class="sidebar-item"
                :class="{ 'active-item': isActive('dashboard.movies.index') }"
                @click="navigateCallback('dashboard.movies.index')">
            </v-list-item>

            <!-- Halls -->
            <v-list-item prepend-icon="mdi-monitor" :title="__('Halls')" class="sidebar-item"
                :class="{ 'active-item': isActive('dashboard.halls.index') }"
                @click="navigateCallback('dashboard.halls.index')">
            </v-list-item>

            <!-- Countries -->
            <v-list-item prepend-icon="mdi-flag" :title="__('Countries')" class="sidebar-item"
                :class="{ 'active-item': isActive('dashboard.countries.index') }"
                @click="navigateCallback('dashboard.countries.index')">
            </v-list-item>

            <!-- Languages -->
            <v-list-item prepend-icon="mdi-translate" :title="__('Languages')" class="sidebar-item"
                :class="{ 'active-item': isActive('dashboard.languages.index') }"
                @click="navigateCallback('dashboard.languages.index')">
            </v-list-item>

            <!-- Classifications -->
            <v-list-item prepend-icon="mdi-tag" :title="__('Classifications')" class="sidebar-item"
                :class="{ 'active-item': isActive('dashboard.classifications.index') }"
                @click="navigateCallback('dashboard.classifications.index')">
            </v-list-item>

            <!-- Genres -->
            <v-list-item prepend-icon="mdi-tag-multiple" :title="__('Genres')" class="sidebar-item"
                :class="{ 'active-item': isActive('dashboard.genres.index') }"
                @click="navigateCallback('dashboard.genres.index')">
            </v-list-item>

            <!-- Screen Types -->
            <v-list-item prepend-icon="mdi-monitor-screenshot" :title="__('Screen Types')" class="sidebar-item"
                :class="{ 'active-item': isActive('dashboard.screen_types.index') }"
                @click="navigateCallback('dashboard.screen_types.index')">
            </v-list-item>

            <!-- Hall Types -->
            <v-list-item prepend-icon="mdi-seat" :title="__('Hall Types')" class="sidebar-item"
                :class="{ 'active-item': isActive('dashboard.hall_types.index') }"
                @click="navigateCallback('dashboard.hall_types.index')">
            </v-list-item>

            <!-- Seat Types -->
            <v-list-item prepend-icon="mdi-seat-outline" :title="__('Seat Types')" class="sidebar-item"
                :class="{ 'active-item': isActive('dashboard.seat_types.index') }"
                @click="navigateCallback('dashboard.seat_types.index')">
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script setup>
    import { onMounted, onUnmounted, ref } from 'vue';
    import { router } from '@inertiajs/vue3';
    import { route } from 'ziggy-js';
    import { __ } from 'matice';

    const modalExists = ref(false);
    const expanded = ref(false);

    /**
     * Check if a route is active
     *
     * @param {string} routeName
     *
     * @return {boolean}
     */
    const isActive = (routeName) => {
        const current = route().current();

        if (current === routeName) {
            return true;
        }

        return false;
    };

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

        // Get expanded state from localStorage if exists
        const savedExpanded = localStorage.getItem('sidebarExpanded');
        if (savedExpanded !== null) {
            expanded.value = savedExpanded === 'true';
        }

        onUnmounted(() => {
            observer.disconnect();
        });
    });


    const navigateCallback = (r) => {
        router.get(route(r));
    };
</script>

<style scoped>
    .cinema-sidebar {
        border-right: 1px solid #e0e0e0;
        background-color: #f5f5f5 !important;
    }

    .cinema-sidebar .v-list {
        background-color: transparent;
    }

    .app-title {
        color: #333;
        font-weight: bold;
    }

    .sidebar-item {
        color: #555;
        margin-bottom: 4px;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .active-item {
        background-color: #4285F4 !important;
        color: white !important;
        font-weight: 500;
        position: relative;
    }

    .active-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background-color: #1a56db;
    }

    .settings-item {
        color: #777;
        font-size: 12px;
        letter-spacing: 1px;
        margin-bottom: 8px;
        border-radius: 8px;
        border-top: 1px solid #e0e0e0;
        padding-top: 16px;
    }

    /* Override default Vuetify styles */
    :deep(.v-list-item__overlay) {
        opacity: 0 !important;
    }

    :deep(.v-list-item:hover) {
        background-color: rgba(66, 133, 244, 0.1);
    }
</style>
