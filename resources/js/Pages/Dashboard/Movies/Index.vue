<template>
    <div class="movie-list-container">
        <!-- Main table component -->
        <data-table-server :showNo="true" :title="__('Movies')" :createButtonText="__('New Movie')"
            :serverItems="serverItems" :items-length="totalItems" :headers="headers" :loading="loading"
            :itemsPerPage="itemsPerPage" item-value="id" @update:options="loadItems" @view="viewCallback"
            @edit="editCallback" @delete="deleteCallback" @create="createCallback" @import="importCallback"
            @export="exportCallback" :emptyStateText="__('No movies found in the database')" :emptyStateAction="true"
            :emptyStateActionText="__('Add First Movie')" @empty-action="createCallback" buttonVariant="outlined"
            :viewTooltip="__('View Movie Details')" :editTooltip="__('Edit Movie Information')"
            :deleteTooltip="__('Delete this Movie')" titleClass="text-2xl font-bold text-primary mb-4" :hasFilter="true"
            @filter-apply="applyFilters" @filter-clear="clearFilters"
            tableClasses="movie-data-table elevation-2 rounded-lg" iconSize="small"
            :deleteConfirmText="__('Are you sure you want to delete this movie? This action cannot be undone.')"
            toolbarColor="white" :showSelect="false">

            <!-- Filter Content -->
            <template #filter>
                <div class="filter-section">
                    <v-select v-model="filterCountry" :items="countryOptions" :label="__('Country')" clearable
                        variant="outlined" density="compact" class="mb-3" hide-details></v-select>

                    <v-select v-model="filterClassification" :items="classificationOptions"
                        :label="__('Classification')" clearable variant="outlined" density="compact" class="mb-3"
                        hide-details></v-select>

                    <v-select v-model="filterYear" :items="yearOptions" :label="__('Release Year')" clearable
                        variant="outlined" density="compact" class="mb-3" hide-details></v-select>
                </div>
            </template>

            <!-- Duration custom column -->
            <template v-slot:[`item.duration`]="{ item }">
                <div class="d-flex align-center">
                    <v-icon size="x-small" color="grey" class="me-1">mdi-clock-outline</v-icon>
                    {{ item.duration }} minutes
                </div>
            </template>

            <!-- Release Date custom column -->
            <template v-slot:[`item.release_date`]="{ item }">
                <v-chip size="small" :color="isRecentRelease(item.release_date) ? 'success' : 'grey-lighten-1'"
                    :text-color="isRecentRelease(item.release_date) ? 'white' : 'grey-darken-3'" variant="flat"
                    class="font-weight-medium">
                    {{ formatDate(item.release_date) }}
                </v-chip>
            </template>

            <!-- Custom actions -->
            <template #item-actions="{ item }">
                <v-tooltip :text="__('Preview Trailer')" location="top">
                    <template v-slot:activator="{ props }">
                        <v-icon v-bind="props" color="amber-darken-2" size="small" class="ms-2"
                            @click="openTrailer(item)">
                            mdi-play-circle
                        </v-icon>
                    </template>
                </v-tooltip>
            </template>
        </data-table-server>

        <!-- Trailer Dialog -->
        <v-dialog v-model="trailerDialog" max-width="800">
            <v-card>
                <v-card-title class="headline d-flex align-center">
                    <v-icon class="me-2">mdi-movie</v-icon>
                    {{ selectedMovie?.title }} - Trailer
                </v-card-title>
                <v-card-text>
                    <div v-if="selectedMovie?.trailer_url" class="trailer-container">
                        <iframe :src="getYoutubeEmbedUrl(selectedMovie.trailer_url)" width="100%" height="400"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen class="rounded-lg"></iframe>
                    </div>
                    <div v-else
                        class="trailer-placeholder d-flex align-center justify-center bg-grey-lighten-3 rounded-lg"
                        style="height: 400px;">
                        <div class="text-center">
                            <v-icon size="64" color="grey">mdi-video-off</v-icon>
                            <p class="mt-4 text-grey">{{ __('No trailer available for this movie') }}</p>
                        </div>
                    </div>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" variant="text" @click="trailerDialog = false">{{ __('Close') }}</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script setup>
    import { ref, computed } from 'vue';
    import { __ } from 'matice';
    import { route } from 'ziggy-js';
    import { router } from '@inertiajs/vue3';
    import { visitModal } from "@inertiaui/modal-vue";

    const props = defineProps({
        movies: {
            type: Object,
            required: true,
        }
    });

    // State variables
    const loading = ref(false);
    const trailerDialog = ref(false);
    const selectedMovie = ref(null);
    const page = ref(1);
    const sortBy = ref([]);

    // Filter states
    const filterCountry = ref(null);
    const filterYear = ref(null);
    const filterClassification = ref(null);

    // Computed properties
    const serverItems = computed(() => {
        return props.movies.data;
    });

    const totalItems = computed(() => {
        return props.movies.meta.total;
    });

    const itemsPerPage = computed(() => {
        return props.movies.per_page;
    });

    // Compute countries to only show unique values
    const countryOptions = computed(() => {
        const countries = [...new Set(props.movies.data.map(movie => movie.country))];
        return countries.map(country => ({ title: country, value: country }));
    });

    // Compute classifications to only show unique values
    const classificationOptions = computed(() => {
        const classifications = [...new Set(props.movies.data.map(movie => movie.classification))];
        return classifications.map(classification => ({ title: classification, value: classification }));
    });

    // Compute classifications to only show unique values
    const yearOptions = computed(() => {
        const years = [...new Set(props.movies.data.map(movie => {
            const date = new Date(movie.release_date);
            return date.getFullYear();
        }))];
        return years.sort((a, b) => b - a).map(year => ({ title: year.toString(), value: year }));
    });

    // Table headers definition
    const headers = [
        {
            title: __('Title'),
            align: 'start',
            sortable: true,
            key: 'title',
        },
        {
            title: __('Duration'),
            align: 'center',
            sortable: true,
            key: 'duration',
            width: '150px',
        },
        {
            title: __('Release Date'),
            align: 'center',
            sortable: true,
            key: 'release_date',
            width: '180px',
        },
        {
            title: __('Country'),
            align: 'start',
            sortable: false,
            key: 'country',
        },
        {
            title: __('Classification'),
            align: 'start',
            sortable: false,
            key: 'classification',
        }
    ];

    /**
     * Load items from the server
     *
     * @param options
     *
     * @return void
     */
    function loadItems(options) {
        loading.value = true;
        page.value = options.page;
        sortBy.value = options.sortBy;

        let sortKeyWithDirection = options.sortBy.length > 0 ? options.sortBy[0].key : null;

        if (sortKeyWithDirection) {
            sortKeyWithDirection = options.sortBy[0].order === 'asc' ? sortKeyWithDirection : '-' + sortKeyWithDirection;
        }

        router.reload({
            data: {
                page: options.page,
                itemsPerPage: options.itemsPerPage,
                sort: sortKeyWithDirection,
                'filter[search]': options.search,
                'filter[country]': filterCountry.value,
                'filter[year]': filterYear.value,
                'filter[classification]': filterClassification.value,
            },
            preserveState: true,
            only: ['movies'],
            onSuccess: () => {
                loading.value = false;
            },
            onError: () => {
                loading.value = false;
                notify('Failed to load data', 'error');
            }
        });
    }

    /**
     * Format the date to a readable format
     *
     * @param dateString
     *
     * @return string
     */
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit'
        });
    }

    function isRecentRelease(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const monthsDiff = (now.getFullYear() - date.getFullYear()) * 12 + now.getMonth() - date.getMonth();
        return monthsDiff <= 12;
    }

    function openTrailer(item) {
        selectedMovie.value = item;
        trailerDialog.value = true;
    }

    function applyFilters() {
        loadItems({
            page: 1,
            itemsPerPage: itemsPerPage.value,
            sortBy: sortBy.value,
        });
    }

    /**
     * Clear all filters
     *
     * @return void
     */
    function clearFilters() {
        filterCountry.value = null;
        filterClassification.value = null;
        filterYear.value = null;
        loadItems({
            page: 1,
            itemsPerPage: itemsPerPage.value,
            sortBy: sortBy.value,
        });
    }

    /**
     * Open the create movie slideover
     *
     * @return void
     */
    const createCallback = () => {
        visitModal(route('dashboard.movies.create'));
    };

    /**
     * Open the view movie slideover
     *
     * @param item
     *
     * @return void
     */
    const viewCallback = (item) => {
        router.get(route('dashboard.movies.show', {
            movie: item.id,
        }), {
            preserveState: true,
            preserveScroll: true,
        });
    };

    /**
     * Open the edit movie slideover
     *
     * @param item
     *
     * @return void
     */
    const editCallback = (item) => {
        visitModal(route('dashboard.movies.edit', {
            movie: item.id,
        }));
    };

    /**
     * Show the delete confirmation dialog
     *
     * @param item
     *
     * @return void
     */
    const deleteCallback = (item) => {
        visitModal(route('dashboard.movies.delete', {
            movie: item.id,
        }), {
            config: {
                slideover: false
            }
        });
    };

    /**
     * Open the import movies slideover
     *
     * @return void
     */
    const importCallback = () => {
        visitModal(route('dashboard.movies.import.show'), {
            config: {
                slideover: false,
                closeExplicitly: true,
            }
        });
    };

    /**
     * Export movies
     *
     * @return void
     */
    const exportCallback = () => {
        window.location.href = route("dashboard.movies.export");
    };


    /**
     * Convert a YouTube URL to an embed URL
     *
     * @param {string} url - The YouTube URL (can be various formats)
     * @return {string} - The embed URL
     */
    function getYoutubeEmbedUrl(url) {
        if (!url) return '';

        // Extract video ID from different YouTube URL formats
        let videoId = '';

        // youtube.com/watch?v=VIDEO_ID format
        if (url.includes('youtube.com/watch')) {
            const urlParams = new URLSearchParams(new URL(url).search);
            videoId = urlParams.get('v');
        }
        // youtu.be/VIDEO_ID format
        else if (url.includes('youtu.be')) {
            videoId = url.split('youtu.be/')[1];
        }
        // youtube.com/embed/VIDEO_ID format
        else if (url.includes('/embed/')) {
            videoId = url.split('/embed/')[1];
        }

        // Remove any additional parameters
        if (videoId && videoId.includes('&')) {
            videoId = videoId.split('&')[0];
        }

        if (videoId && videoId.includes('?')) {
            videoId = videoId.split('?')[0];
        }

        // Return the embed URL
        return videoId ? `https://www.youtube.com/embed/${videoId}` : '';
    }
</script>

<style scoped>
    .movie-list-container {
        border-radius: 12px;
        border-radius: 20px;
    }

    .filter-section {
        min-width: 300px;
        padding: 16px;
        background-color: #f9f9f9;
        border-radius: 8px;
    }

    .movie-data-table :deep(.v-data-table__td) {
        padding-top: 14px !important;
        padding-bottom: 14px !important;
        font-size: 14px !important;
    }
</style>
