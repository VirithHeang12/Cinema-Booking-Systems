<template>
    <v-app-bar color="surface-variant" title="Application bar">
        <v-menu>
            <template v-slot:activator="{ props }">
                <v-btn color="primary" dark v-bind="props">
                    <lang-flag :iso="getLocale().toLowerCase()" />
                </v-btn>
            </template>

            <v-list>
                <v-list-item v-for="([key, value], index) in languages" :key="index">
                    <v-list-item-title>
                        <v-btn @click="switchLocale(key, value)">
                            {{ value.native }}
                        </v-btn>
                    </v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
    </v-app-bar>

</template>

<script setup>
    import { router, usePage } from '@inertiajs/vue3'
    import { __, getLocale, setLocale } from 'matice';
    import { computed } from 'vue';

    const { props } = usePage();

    const languages = computed(() => {
        return Object.entries(props.languages);
    });

    const switchLocale = (key, locale) => {
        // Set the locale without reloading the page
        setLocale(key);

        router.visit(locale.path, {
            method: "get",
            replace: true,
        });
    }
</script>

<style scoped></style>
