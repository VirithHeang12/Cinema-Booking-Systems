<template>
    <v-app-bar :elevation="0" color="grey-lighten-5" flat compact>
        <v-container class="flex justify-between">
            <div>
                <v-text-field :width="200" :elevation="0"></v-text-field>
            </div>
            <div class="flex align-center justify-center">
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
                <div class="flex gap-2 align-center">
                    <v-btn>
                        <template v-slot:prepend>
                            <v-icon>mdi-ticket</v-icon>
                        </template>
                        Tickets
                    </v-btn>

                    <v-btn icon="mdi-account"></v-btn>

                    <v-btn icon="mdi-bell"></v-btn>
                </div>
            </div>
        </v-container>
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
