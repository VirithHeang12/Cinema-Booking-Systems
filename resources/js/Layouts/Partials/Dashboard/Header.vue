<template>
    <header>
        <v-app-bar :elevation="0" color="#242424f1" flat compact class="relative z-1 app-bar">
            <v-container fluid>
                <v-row class="d-flex justify-space-between align-center">
                    <v-col cols="6">
                        <a href="/" class="flex justify-start">
                            <img width="50" height="20" src="/public/logo/sample_logo.png" alt="">
                        </a>
                    </v-col>
                    <v-col cols="6" class="flex gap-2 align-center justify-end">
                        <!-- Language Switcher -->
                        <v-menu>
                            <template v-slot:activator="{ props }">
                                <v-btn color="white" dark v-bind="props" class="opacity-65 hover:opacity-100">
                                    <flag
                                        :iso="getLocale().toLowerCase() === 'en' ? 'gb' : getLocale().toLowerCase()" />
                                    <span class="ml-1 d-none d-md-block">{{ currentLocale }}</span>
                                    <v-icon class="ml-1 md:ml-0">mdi-chevron-down</v-icon>
                                </v-btn>
                            </template>
                            <v-list>
                                <v-list-item v-for="([key, value], index) in localizations" :key="index">
                                    <v-list-item-title>
                                        <v-btn @click="switchLocale(key)" :elevation="0" width="100%">
                                            <template #prepend>
                                                <flag :iso="key.toLowerCase() === 'en' ? 'gb' : key.toLowerCase()" />
                                            </template>
                                            {{ value.native }}
                                        </v-btn>
                                    </v-list-item-title>
                                </v-list-item>
                            </v-list>
                        </v-menu>

                        <!-- Account Dropdown -->
                        <v-menu offset-y>
                            <template v-slot:activator="{ props }">
                                <v-btn icon color="white" class="opacity-65 hover:opacity-100" v-bind="props">
                                    <v-icon>mdi-account</v-icon>
                                </v-btn>
                            </template>

                            <v-list>
                                <v-list-item v-if="!dialog" @click="dialog = true">
                                    <v-list-item-title>
                                        <v-icon start class="mr-2">mdi-lock-reset</v-icon>
                                        Change Password
                                    </v-list-item-title>
                                </v-list-item>

                                <v-list-item @click="logout">
                                    <v-list-item-title>
                                        <v-icon start class="mr-2">mdi-logout</v-icon>
                                        {{ __('Logout') }}
                                    </v-list-item-title>
                                </v-list-item>
                            </v-list>
                        </v-menu>
                    </v-col>
                </v-row>
            </v-container>
        </v-app-bar>
    </header>
    <PasswordChangeDialog v-model:dialog="dialog" />
</template>

<script setup>
    import PasswordChangeDialog from '@/Components/PasswordChangeDialog.vue';
    import { ref, computed } from 'vue';
    import { router, usePage } from '@inertiajs/vue3';
    import { __, getLocale, setLocale } from 'matice';
    import { route } from 'ziggy-js';

    const dialog = ref(false);

    const localizations = ref(Object.entries(usePage().props.localizations));
    const currentLocale = computed(() => localizations.value.find(([key]) => key === getLocale())?.[1]?.code);

    const switchLocale = (key) => {
        setLocale(key);
        localizations.value = Object.entries(usePage().props.localizations);
        const [, { path }] = localizations.value.find(([key]) => key === getLocale());
        router.visit(path, {
            method: "get",
            onSuccess: () => {
                window.location.reload();
            },
        });
    };

    const logout = () => {
        router.post(route('logout'));
    }
</script>
