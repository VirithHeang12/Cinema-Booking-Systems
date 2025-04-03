<template>
    <div class="movie-list-container pa-4">
        <!-- Main table component -->
        <data-table-server :showNo="true" title="Movies" :serverItems="serverItems" :items-length="totalItems"
            :headers="headers" :loading="loading" :itemsPerPage="itemsPerPage" item-value="id"
            @update:options="loadItems" @view="viewCallback" @edit="editCallback" @delete="deleteCallback"
            @create="createCallback" @import="importCallback" @export="exportCallback" @search="handleSearch"
            emptyStateText="No movies found in the database" :emptyStateAction="true"
            emptyStateActionText="Add First Movie" @empty-action="createCallback" buttonVariant="elevated"
            viewTooltip="View Movie Details" editTooltip="Edit Movie Information" deleteTooltip="Delete this Movie"
            titleClass="!text-3xl !text-primary" :hasFilter="true" @filter-apply="applyFilters"
            @filter-clear="clearFilters" :tableClasses="'movie-data-table elevation-1'" iconSize="small"
            deleteConfirmText="Are you sure you want to delete this movie? This action cannot be undone."
            toolbarColor="grey-lighten-4" v-model:selected="selectedItems" :showSelect="true">

            <!-- Filter Content -->
            <template #filter>
                <div class="filter-section">
                    <v-select v-model="filterCountry" :items="countryOptions" label="Country" clearable
                        variant="outlined" density="compact" class="mb-3"></v-select>

                    <v-select v-model="filterYear" :items="yearOptions" label="Release Year" clearable
                        variant="outlined" density="compact" class="mb-3"></v-select>

                    <v-checkbox v-model="filterRecent" label="Recent Releases (Last 12 Months)"
                        hide-details></v-checkbox>
                </div>
            </template>

            <!-- Custom buttons for the toolbar -->
            <!-- <template #buttons>
                <v-btn color="info" variant="tonal" class="me-2 fw-medium" prepend-icon="mdi-star">
                    {{ __('Popular') }}
                </v-btn>
            </template> -->

            <!-- Duration custom column -->
            <template #item.duration="{ item }">
                <div class="d-flex align-center">
                    <v-icon size="x-small" color="grey" class="me-1">mdi-clock-outline</v-icon>
                    {{ item.duration }} minutes
                </div>
            </template>

            <!-- Release Date custom column -->
            <template #item.release_date="{ item }">
                <v-chip size="small" :color="isRecentRelease(item.release_date) ? 'success' : 'grey'"
                    :text-color="isRecentRelease(item.release_date) ? 'white' : ''" variant="outlined"
                    class="font-weight-medium">
                    {{ formatDate(item.release_date) }}
                </v-chip>
            </template>

            <!-- Custom actions -->
            <template #item-actions="{ item }">
                <v-tooltip text="Preview Trailer" location="top">
                    <template v-slot:activator="{ props }">
                        <v-icon v-bind="props" color="amber-darken-2" size="small" class="ms-2"
                            @click="openTrailer(item)">
                            mdi-play-circle
                        </v-icon>
                    </template>
                </v-tooltip>
            </template>

            <!-- Custom header content -->
            <template #header>
                <div class="d-flex align-center px-4 py-2 bg-primary-lighten-5" v-if="selectedItems.length > 0">
                    <span class="text-subtitle-1 me-4">{{ selectedItems.length }} items selected</span>
                    <v-btn size="small" color="error" variant="tonal" @click="bulkDelete">
                        Delete Selected
                    </v-btn>
                    <v-btn size="small" color="primary" variant="tonal" class="ms-2" @click="exportSelected">
                        Export Selected
                    </v-btn>
                </div>
            </template>

            <!-- Custom footer content -->
            <template #footer>
                <div class="d-flex justify-space-between align-center pa-4 bg-grey-lighten-4">
                    <div class="text-caption text-grey">Last updated: {{ lastUpdated }}</div>
                    <div class="text-caption">
                        <v-icon size="x-small" color="primary" class="me-1">mdi-information</v-icon>
                        Showing {{ serverItems.length }} of {{ totalItems }} movies
                    </div>
                </div>
            </template>
        </data-table-server>

        <!-- Trailer Dialog -->
        <v-dialog v-model="trailerDialog" max-width="800">
            <v-card>
                <v-card-title class="headline">{{ selectedMovie?.title }} - Trailer</v-card-title>
                <v-card-text>
                    <div class="trailer-placeholder d-flex align-center justify-center bg-grey-lighten-3"
                        style="height: 400px;">
                        <v-icon size="64" color="grey">mdi-video</v-icon>
                    </div>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" variant="text" @click="trailerDialog = false">Close</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script setup>
    import { ref, computed, watch, onMounted } from 'vue';
    import { __ } from 'matice';
    import { route } from 'ziggy-js';
    import { router, usePage } from '@inertiajs/vue3';
    import { toast } from 'vue3-toastify';
    import { visitModal } from "@inertiaui/modal-vue";

    const props = defineProps({
        movies: {
            type: Object,
            required: true,
        }
    });

    // State variables
    const loading = ref(false);
    const selectedItems = ref([]);
    const trailerDialog = ref(false);
    const selectedMovie = ref(null);
    const searchTerm = ref('');
    const lastUpdated = ref(new Date().toLocaleString());
    const page = ref(1);
    const sortBy = ref([]);

    // Filter states
    const filterCountry = ref(null);
    const filterYear = ref(null);
    const filterRecent = ref(false);

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

    // Options for filters
    const countryOptions = computed(() => {
        const countries = [...new Set(props.movies.data.map(movie => movie.country))];
        return countries.map(country => ({ title: country, value: country }));
    });

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
            title: 'Title',
            align: 'start',
            sortable: true,
            key: 'title',
        },
        {
            title: 'Duration',
            align: 'center',
            sortable: true,
            key: 'duration',
            width: '150px',
        },
        {
            title: 'Release Date',
            align: 'center',
            sortable: true,
            key: 'release_date',
            width: '180px',
        },
        {
            title: 'Country',
            align: 'start',
            sortable: true,
            key: 'country',
        },
    ];

    // Methods
    function loadItems(options) {
        loading.value = true;
        page.value = options.page;
        sortBy.value = options.sortBy;

        // Simulate API call
        setTimeout(() => {
            router.reload({
                data: {
                    page: options.page,
                    itemsPerPage: options.itemsPerPage,
                    sort: options.sortBy.length > 0 ? options.sortBy[0].key : null,
                    direction: options.sortBy.length > 0 ? options.sortBy[0].order : null,
                    'filter[search]': searchTerm.value,
                    country: filterCountry.value,
                    year: filterYear.value,
                    recent: filterRecent.value ? 1 : 0
                },
                preserveState: true,
                only: ['movies'],
                onSuccess: () => {
                    loading.value = false;
                    lastUpdated.value = new Date().toLocaleString();
                },
                onError: () => {
                    loading.value = false;
                    notify('Failed to load data', 'error');
                }
            });
        }, 500);
    }

    function handleSearch(value) {
        searchTerm.value = value;
        loadItems({ page: 1, itemsPerPage: itemsPerPage.value, sortBy: sortBy.value });
    }

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
        loadItems({ page: 1, itemsPerPage: itemsPerPage.value, sortBy: sortBy.value });
    }

    function clearFilters() {
        filterCountry.value = null;
        filterYear.value = null;
        filterRecent.value = false;
        loadItems({ page: 1, itemsPerPage: itemsPerPage.value, sortBy: sortBy.value });
    }

    function bulkDelete() {
        if (selectedItems.value.length === 0) return;

        const ids = selectedItems.value.map(item => item.id);
        router.delete(route('dashboard.movies.bulk-destroy'), {
            data: { ids },
            onSuccess: () => {
                selectedItems.value = [];
                notify('Selected movies deleted successfully');
            }
        });
    }

    function exportSelected() {
        if (selectedItems.value.length === 0) return;

        const ids = selectedItems.value.map(item => item.id).join(',');
        window.location.href = route("dashboard.movies.export", { ids });
    }

    const viewCallback = (item) => {
        router.get(route('dashboard.movies.show', {
            movie: item.id,
        }));
    };

    const editCallback = (item) => {
        visitModal(route('dashboard.movies.edit', {
            movie: item.id,
        }));
    };

    const deleteCallback = (item) => {
        router.delete(route('dashboard.movies.destroy', {
            movie: item.id,
        }), {
            onSuccess: () => {
                notify('Movie deleted successfully');
            }
        });
    };

    const createCallback = () => {
        visitModal(route('dashboard.movies.create'));
    };

    const importCallback = () => {
        router.get(route('dashboard.movies.import.show'));
    };

    const exportCallback = () => {
        window.location.href = route("dashboard.movies.export");
    };

    /**
     * Notify the user
     *
     * @param {string} message
     * @param {string} type
     *
     * @return void
     */
    const notify = (message, type = 'success') => {
        toast(message, {
            autoClose: 1500,
            position: toast.POSITION.BOTTOM_RIGHT,
            type: type,
            hideProgressBar: true,
        });
    }

    const p = usePage();

    /**
     * Watch for flash messages
     *
     * @return void
     */
    watch(() => p.props.flash, (flash) => {
        const success = p.props.flash.success;
        const error = p.props.flash.error;

        if (success) {
            notify(success);
        } else if (error) {
            notify(error, 'error');
        }
    }, {
        deep: true,
    });

    // Initial load
    onMounted(() => {
        loadItems({ page: 1, itemsPerPage: itemsPerPage.value, sortBy: [] });
    });
</script>

<style scoped>
    .movie-list-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    .filter-section {
        min-width: 300px;
        padding: 8px;
    }

    .movie-data-table :deep(.v-data-table__td) {
        padding-top: 12px !important;
        padding-bottom: 12px !important;
    }

    /* Custom styling for the data table */
    :deep(.v-data-table-server .v-data-table) {
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        border-radius: 8px;
    }

    :deep(.v-data-table__tbody tr:hover) {
        background-color: rgba(0, 0, 0, 0.02);
    }
</style>
