<template>
    <header class="bg-[#242424] bg-blur sticky top-0 px-4 overflow-y-hidden z-50">
        <v-app-bar :elevation="0" color="#242424" flat compact class="app-bar py-3 bg-blur">
            <v-container class="px-8 px-md-0">
                <v-row class="flex justify-between align-center">
                    <!-- Left Section (Search & Buttons) -->
                    <v-col cols="4" class="flex justify-content-start pa-0">
                        <!-- Desktop Search -->
                        <div class="w-[250px] d-none d-sm-flex">
                            <v-text-field
                                :append-inner-icon="'mdi-magnify'"
                                density="compact"
                                hide-details single-line
                                :placeholder="__('Search Movies') + ' ...'"
                                @focus="dialog = true">
                            </v-text-field>
                        </div>
                        <!-- Mobile Buttons -->
                        <div class="d-flex gap-0 align-center d-sm-none">
                            <v-btn icon="mdi-ticket" color="white" class="opacity-65 hover:opacity-100" />
                            <v-btn icon="mdi-bell" color="white" class="opacity-65 hover:opacity-100"></v-btn>
                        </div>
                    </v-col>

                    <!-- Center Logo -->
                    <v-col cols="4">
                        <a href="/" class="flex justify-center">
                            <img width="50" height="20" src="/public/logo/sample_logo.png" alt="">
                        </a>
                    </v-col>

                    <!-- Right Section (Language & Account) -->
                    <v-col cols="4" class="flex justify-content-end pa-0">
                        <div class="flex align-center justify-center z-10">
                            <!-- Desktop Buttons -->
                            <div class="flex align-center d-none d-sm-flex">
                                <v-btn color="white" class="opacity-65 hover:opacity-100 d-sm-none d-sm-flex">
                                    <template v-slot:prepend>
                                        <v-icon>mdi-ticket</v-icon>
                                    </template>
                                    <span>{{ __('Tickets') }}</span>
                                </v-btn>
                                <v-btn icon="mdi-ticket" color="white" class="opacity-65 hover:opacity-100 d-sm-none"></v-btn>
                                <v-btn icon="mdi-bell" color="white" class="opacity-65 hover:opacity-100"></v-btn>
                            </div>

                            <!-- Language Switcher -->
                            <v-menu>
                                <template v-slot:activator="{ props }">
                                    <v-btn color="white" dark v-bind="props" class="opacity-65 hover:opacity-100">
                                        <flag :iso="getLocale().toLowerCase() === 'en' ? 'gb' : getLocale().toLowerCase()" />
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

                            <!-- Account Icon -->
                            <v-btn icon="mdi-account" color="white" class="opacity-65 hover:opacity-100 d-none d-md-flex"></v-btn>

                            <!-- Mobile Search Icon -->
                            <v-btn v-if="!dialog" icon="mdi-magnify" color="white" class="opacity-65 hover:opacity-100 d-sm-none" @click="dialog = true"></v-btn>
                        </div>
                    </v-col>
                </v-row>
            </v-container>
        </v-app-bar>
        <!-- Desktop Toolbar: Sticky Below Navbar -->
        <v-toolbar
            dense
            elevation="2"
            class="bg-transparent text-white z-40 mt-[90px] d-none d-sm-flex">
            <NavLinks v-model="selectedTab" justify="start"  :showProfile="false" />
        </v-toolbar>
        <!-- Mobile Bottom Navigation -->
        <v-bottom-navigation
            app
            class="text-white d-sm-none custom-blur-nav">
            <NavLinks v-model="selectedTab" justify="between"  :showProfile="true" />
        </v-bottom-navigation>
    </header>

    <!-- Search Modal -->
    <v-dialog v-model="dialog" persistent hide-overlay transition="scale-transition" max-width="600" color="#242424" class="search-dialog">
        <v-card rounded="lg" class="dialog-card">
            <v-card-title class="d-flex justify-space-between align-center bg-transparent">
                <div class="text-medium-emphasis ps-2k"><span class="text-white">{{ __('Search') }}</span></div>
                <v-btn icon="mdi-close" variant="text" @click="dialog = false"></v-btn>
            </v-card-title>

            <v-divider class="my-0"></v-divider>

            <v-card-text class="bg-transparent">
                <!-- Search Input -->
                <v-text-field
                    v-model="searchQuery"
                    :placeholder="__('Search Movies') + ' ...'"
                    prepend-inner-icon="mdi-magnify"
                    clearable
                    solo
                    autofocus>
                </v-text-field>

                <!-- Search Results -->
                <v-list v-if="searchQuery" class="bg-transparent">
                    <v-list-item v-if="loading">
                        <v-progress-circular indeterminate color="primary"></v-progress-circular>
                    </v-list-item>
                    
                    <v-list-item v-for="movie in filteredMovies" :key="movie.id" @click="selectMovie(movie)">
                        <div class="d-flex col-12">
                            <div class="col-auto">
                                <v-img :src="movie.poster" alt="Movie Poster" width="80" height="150" rounded-md contain></v-img>
                            </div>
                            <div class="col-auto ml-5 pt-5">
                                <v-list-item-title>{{ movie.title }}</v-list-item-title>
                                <v-list-item-subtitle>{{ movie.release_date }}</v-list-item-subtitle>
                            </div>
                        </div>
                        <v-divider class="my-0 col-12"></v-divider>
                    </v-list-item>

                    <v-list-item v-if="!filteredMovies.length && !loading" class="bg-transparent">
                        <v-container class="text-center bg-transparent">
                                <v-icon size="100">mdi-file-search</v-icon>
                                <p>{{ __('No movies found') }}</p>
                        </v-container>
                    </v-list-item>
                </v-list>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script setup>
    import { ref, computed, watch } from 'vue';
    import { router, usePage } from '@inertiajs/vue3';
    import { __, getLocale, setLocale } from 'matice';
    import NavLinks from './NavLink.vue';

    const selectedTab = ref('/'); // Set default tab as home

    // Static movie data for testing search functionality
    const movies = ref([
        { id: 1, title: "Serpent Beauty", release_date: "04 Apr 2025", poster: "https://tickets.legend.com.kh/CDN/media/entity/get/Movies/HO00001875" },
        { id: 2, title: "A Minecraft Movie", release_date: "3 Apr 2025", poster: "https://tickets.legend.com.kh/CDN/media/entity/get/Movies/HO00001845" },
        { id: 3, title: "Ne Zha 2", release_date: "25 May 2025", poster: "https://tickets.legend.com.kh/CDN/media/entity/get/Movies/HO00001864" },
    ]);

    const dialog = ref(false);
    const searchQuery = ref("");
    const loading = ref(false);

    // Filter movies based on search query
    const filteredMovies = computed(() => {
        return movies.value.filter(movie => 
            movie.title.toLowerCase().includes(searchQuery.value.toLowerCase())
        );
    });

    // Reset search query when dialog is closed
    watch(dialog, (val) => {
        if (!val) {
            searchQuery.value = "";
        }
    });

    const selectMovie = (movie) => {
        dialog.value = false;
        searchQuery.value = "";
    };

    // Localization
    const localizations = ref(Object.entries(usePage().props.localizations));
    const currentLocale = computed(() => localizations.value.find(([key]) => key === getLocale())?.[1]?.code);

    const switchLocale = (key) => {
        setLocale(key);
        localizations.value = Object.entries(usePage().props.localizations);
        const [, { path }] = localizations.value.find(([key]) => key === getLocale());
        router.visit(path, { method: "get" });
    };
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
    .app-bar {
    position: relative;
    overflow: hidden; /* Ensure the gradient doesn't spill out */
    }

    .app-bar::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 1px; /* Thickness of the border */
    background: linear-gradient(
        to right,
        rgba(255, 255, 255, 0), /* Lighter left */
        rgba(255, 255, 255, 0.4), /* Darker center */
        rgba(255, 255, 255, 0) /* Lighter right */
    );
    }
    .search-dialog .v-card {
        background-color: #242424;
        color: white;
        max-height: 80vh;
        overflow-y: auto;
    }
    .search-dialog >>> .v-overlay__content {
        top: 10% !important;
    }

    @media (max-width: 600px) {
    .search-dialog .v-card {
        max-height: 90vh;
        margin: 0 10px;
    }
    }
    .custom-blur-nav {
        background-color: rgba(55, 45, 35, .7); /* semi-transparent black */
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
    }
</style>
