<template>
    <v-app-bar :elevation="0" color="#242424f1" flat compact class="relative z-1 app-bar">
        <v-container class="flex justify-between">
            <v-card max-width="400" flat class="pa-0 h-fit z-10">
                <v-card-text class="pa-0">
                    <v-text-field :width="300" append-inner-icon="mdi-magnify" density="compact"
                        label="Search templates" variant="solo" hide-details single-line flat></v-text-field>
                </v-card-text>
            </v-card>
            <v-card flat class="z-10">
                <img width="50" height="20" src="/resources/assets/ChillGuy.jpg" alt="">
            </v-card>
            <div class="flex align-center justify-center z-10">
                <div class="flex gap-2 align-center">
                    <v-btn color="white" class="opacity-65 hover:opacity-100">
                        <template v-slot:prepend>
                            <v-icon>mdi-ticket</v-icon>
                        </template>
                        Tickets
                    </v-btn>

                    <v-btn icon="mdi-account" color="white" class="opacity-65 hover:opacity-100"></v-btn>

                    <v-btn icon="mdi-bell" color="white" class="opacity-65 hover:opacity-100"></v-btn>
                </div>
                <v-menu>
                    <template v-slot:activator="{ props }">
                        <v-btn color="primary" dark v-bind="props">
                            <flag :iso="getLocale().toLowerCase() === 'en' ? 'gb' : getLocale().toLowerCase()" />
                        </v-btn>
                    </template>

                    <v-list>
                        <v-list-item v-for="([key, value], index) in languages" :key="index">
                            <v-list-item-title>
                                <v-btn @click="switchLocale(key, value)" :elevation="0" width="100%">
                                    <template #prepend>
                                        <flag :iso="key.toLowerCase() === 'en' ? 'gb' : key.toLowerCase()" />
                                    </template>
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
    import { ref } from 'vue';

    const languages = ref(Object.entries(usePage().props.languages));

    const switchLocale = (key, locale) => {
        // Set the locale without reloading the page
        setLocale(key);

        languages.value = Object.entries(usePage().props.languages);

        const [, { path }] = languages.value.find(([key, value]) => key === getLocale());

        // Visit the current page with the new locale
        router.visit(path, {
            method: "get",
        });
    }
</script>

<style scoped>
    .bg-blur::before {
        content: '';
        width: 65%;
        height: 100%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, 100%);
        background-color: red;
        filter: blur(200px);
        border-radius: 100%;
        z-index: -1;
    }
</style>
