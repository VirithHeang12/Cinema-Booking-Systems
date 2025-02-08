<template>
    <v-app-bar :elevation="0" color="#242424f1" flat compact class="relative z-1 app-bar">
        <v-container class="flex justify-between">
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
