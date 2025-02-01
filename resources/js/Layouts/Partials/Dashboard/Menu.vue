<template>
    <v-navigation-drawer rail app expand-on-hover :temporary="modalExists">
        <v-list density="compact">
            <template v-for="item in items" :key="item.group">
                <v-list-group :value="item.group">
                    <template v-slot:activator="{ props }">
                        <v-list-item v-bind="props" :prepend-icon="item.icon" :title="__(item.group)"></v-list-item>
                    </template>
                    <v-list-item v-for="subItem in item.items" :key="subItem.value" :prepend-icon="subItem.icon"
                        :title="__(subItem.title)" :value="subItem.value"
                        @click="navigateCallback(subItem.route)"></v-list-item>
                </v-list-group>
            </template>
        </v-list>
    </v-navigation-drawer>
</template>

<script setup>
    import { onMounted, onUnmounted, ref } from 'vue';
    import { router } from '@inertiajs/vue3';
    import { route } from 'ziggy-js';

    const modalExists = ref(false);

    const checkModal = () => {
        modalExists.value = document.querySelector('div[data-inertiaui-modal-id]') !== null;
    };

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
            group: 'Setting',
            icon: 'mdi-cog-outline',
            items: [
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
                }
            ]
        },

    ]);

    const navigateCallback = (r) => {
        router.get(route(r));
    }
</script>
