<template>
    <v-app-bar :elevation="0" color="#161616ab" flat compact class="app-bar">
        <v-container class="flex justify-between">
            <v-card max-width="400" flat class="pa-0 h-fit">
                <v-card-text class="pa-0">
                    <v-text-field :width="300" :loading="loading" append-inner-icon="mdi-magnify" density="compact"
                        label="Search templates" variant="solo" hide-details single-line @click:append-inner="onClick"
                        flat></v-text-field>
                </v-card-text>
            </v-card>
            <v-card flat>
                <img width="50" height="20" src="/resources/assets/ChillGuy.jpg" alt="">
            </v-card>
            <div class="flex align-center justify-center">
                <div class="flex gap-2 align-center">
                    <v-btn color="white">
                        <template v-slot:prepend>
                            <v-icon>mdi-ticket</v-icon>
                        </template>
                        Tickets
                    </v-btn>

                    <v-btn icon="mdi-account" color="white"></v-btn>

                    <v-btn icon="mdi-bell" color="white"></v-btn>
                </div>
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

<style scoped>
    .app-bar {
        backdrop-filter: blur(2px);
    }
</style>
