<template>
    <v-container fluid>
        <v-row dense>
            <v-col :cols="12" :md="5">
                <v-row dense>
                    <v-col :cols="12" :md="12">
                        <h2 class="form-title">{{ movie.title }}</h2>
                    </v-col>
                    <v-col :cols="12" :md="12">
                        <div class="form-content !font-medium">
                            <div class="details-section">
                                <div class="field-row">
                                    <div class="field-label">Description</div>
                                    <div>{{ movie.description }}</div>
                                </div>

                                <div class="columns">
                                    <div class="field-column">
                                        <div class="field-label">Release Date</div>
                                        <div class="field-value date-value">
                                            <v-icon size="small" class="icon-calendar">mdi-calendar</v-icon>
                                            {{ formatDate(movie.release_date) }}
                                        </div>
                                    </div>

                                    <v-spacer></v-spacer>

                                    <div class="field-column">
                                        <div class="field-label">Duration (minutes)</div>
                                        <div class="field-value duration-value">
                                            <v-icon size="small" class="icon-clock">mdi-clock-outline</v-icon>
                                            {{ movie.duration }}
                                        </div>
                                    </div>
                                </div>

                                <div class="columns">

                                    <div class="field-column">
                                        <div class="field-label">Classification</div>
                                        <div class="field-value country-value">
                                            <v-icon size="small" class="icon-earth">mdi-tag-outline</v-icon>
                                            {{ getClassificationName(movie.classification_id) }}
                                        </div>
                                    </div>

                                    <div class="field-column">
                                        <div class="field-label">Country</div>
                                        <div class="field-value country-value">
                                            <v-icon size="small" class="icon-earth">mdi-earth</v-icon>
                                            {{ getCountryName(movie.country_id) }}
                                        </div>
                                    </div>

                                    <div class="field-column">
                                        <div class="field-label">Language</div>
                                        <div class="field-value country-value">
                                            <v-icon size="small" class="icon-earth">mdi-translate</v-icon>
                                            {{ getLanguageName(movie.spoken_language_id) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="field-column">
                                        <div class="field-label">Thumbnail</div>
                                        <div class="field-value rating-value">
                                            <v-icon size="24" class="icon-launch"
                                                @click="showThumbnailCallback">mdi-launch</v-icon>
                                        </div>
                                    </div>

                                    <div class="field-column">
                                        <div class="field-label">Trailer</div>
                                        <div class="field-value country-value">
                                            <v-icon size="24" class="icon-play-circle"
                                                @click="showTrailerCallback">mdi-play-circle</v-icon>
                                        </div>
                                    </div>

                                    <div class="field-column">
                                        <div class="field-label">Rating (1-10)</div>
                                        <div class="field-value rating-value">
                                            <v-icon size="small" class="icon-star">mdi-star</v-icon>
                                            {{ movie.rating }}
                                        </div>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="field-column">
                                        <div class="field-label">Subtitles</div>
                                        <div class="field-value">
                                            <div v-if="
                                                movie.movieSubtitles &&
                                                movie.movieSubtitles.length
                                            " class="tags-container">
                                                <div v-for="subtitle in movie.movieSubtitles" :key="subtitle.id"
                                                    class="subtitle-tag">
                                                    {{ subtitle.name }}
                                                </div>
                                            </div>
                                            <div v-else>No subtitles available</div>
                                        </div>
                                    </div>
                                    <div class="field-column">
                                        <div class="field-label">Genres</div>
                                        <div class="field-value">
                                            <div v-if="
                                                movie.movieGenres &&
                                                movie.movieGenres.length
                                            " class="tags-container">
                                                <div v-for="genre in movie.movieGenres" :key="genre.id"
                                                    class="subtitle-tag">
                                                    {{ genre.name }}
                                                </div>
                                            </div>
                                            <div v-else>No genres available</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </v-col>
                </v-row>
            </v-col>
            <v-col :cols="12" :md="7">
                <div class="show-management">
                    <div class="show-list-container">
                        <data-table-server :showNo="true" :title="__('Shows')" :createButtonText="__('New Show')"
                            :serverItems="serverItems" :items-length="totalItems" :headers="headers" :loading="loading"
                            :itemsPerPage="itemsPerPage" item-value="id" @update:options="loadItems"
                            @view="viewCallback" @edit="editCallback" @delete="deleteCallback" @create="createCallback"
                            :emptyStateText="__('No shows found in the database')" :emptyStateAction="true"
                            :emptyStateActionText="__('Add First Show')" @empty-action="createCallback"
                            buttonVariant="outlined" :viewTooltip="__('View Show Details')"
                            :editTooltip="__('Edit Show Information')" :deleteTooltip="__('Delete this Show')"
                            titleClass="text-2xl font-bold text-primary mb-4" :hasFilter="false"
                            tableClasses="show-data-table rounded-lg" iconSize="small"
                            :deleteConfirmText="__('Are you sure you want to delete this show? This action cannot be undone.')"
                            toolbarColor="white" :showSelect="false" :hasImport="false" :hasExport="false">

                            <template v-slot:[`item.show_time`]="{ item }">
                                {{ formatDate(item.show_time) }}
                            </template>

                            <template v-slot:[`item.movie_subtitle`]="{ item }">
                                <div v-if="item.movie_subtitle">
                                    <span v-if="item.movie_subtitle.subtitle">({{ item.movie_subtitle.subtitle.name
                                        }})</span>
                                </div>
                                <span v-else>N/A</span>
                            </template>

                            <template v-slot:[`item.hall`]="{ item }">
                                {{ item.hall?.name || "N/A" }}
                            </template>

                            <template v-slot:[`item.screen_type`]="{ item }">
                                {{ item.screen_type?.name || "N/A" }}
                            </template>
                        </data-table-server>
                    </div>
                </div>
            </v-col>
        </v-row>
    </v-container>
    <v-dialog v-model="trailerDialog" max-width="800">
        <v-card>
            <v-card-title class="headline d-flex align-center">
                <v-icon class="me-2">mdi-movie</v-icon>
                {{ movie?.title }} - Trailer
            </v-card-title>
            <v-card-text>
                <div v-if="movie?.trailer_url" class="trailer-container">
                    <iframe :src="getYoutubeEmbedUrl(movie.trailer_url)" width="100%" height="400" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen class="rounded-lg"></iframe>
                </div>
                <div v-else class="trailer-placeholder d-flex align-center justify-center bg-grey-lighten-3 rounded-lg"
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
    <v-dialog v-model="thumbnailDialog" max-width="800">
        <v-card>
            <v-card-title class="headline d-flex align-center">
                <v-icon class="me-2">mdi-movie</v-icon>
                {{ movie?.title }} - Thumbnail
            </v-card-title>
            <v-card-text>
                <div v-if="movie?.trailer_url" class="trailer-container">
                    <v-img :src="movie.thumbnail_url" alt="Movie Thumbnail" class="thumbnail-image" />
                </div>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" variant="text" @click="thumbnailDialog = false">{{ __('Close') }}</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script setup>
    import { __ } from "matice";
    import { ref, computed, watch } from "vue";
    import { route } from "ziggy-js";
    import { router, usePage } from "@inertiajs/vue3";
    import { toast } from "vue3-toastify";
    import { visitModal } from "@inertiaui/modal-vue";

    const props = defineProps({
        movie: {
            type: Object,
            required: true,
        },
        countries: {
            type: Array,
            required: true,
        },
        genres: {
            type: Array,
            required: true,
        },
        languages: {
            type: Array,
            required: true,
        },
        classifications: {
            type: Array,
            required: true,
        },
        shows: {
            type: Object,
            required: true,
        },
    });

    // State variables
    const loading = ref(false);
    const page = ref(1);
    const sortBy = ref([]);
    const trailerDialog = ref(false);
    const thumbnailDialog = ref(false);

    // Computed properties
    const serverItems = computed(() => {
        return props.shows.data;
    });

    const totalItems = computed(() => {
        return props.shows?.total || 0;
    });

    const itemsPerPage = computed(() => {
        return props.shows.per_page;
    });

    // Table headers definition
    const headers = [
        {
            title: "Show Time",
            align: "start",
            sortable: true,
            key: "show_time",
            width: "180px",
        },
        {
            title: "Hall",
            align: "center",
            sortable: false,
            key: "hall",
            width: "120px",
        },
        {
            title: "Screen",
            align: "center",
            sortable: false,
            key: "screen_type",
            width: "150px",
        },
        {
            title: "Status",
            align: "center",
            sortable: true,
            key: "status",
            width: "120px",
        },
    ];

    /**
     * Show the trailer dialog
     *
     * @return void
     */
    const showTrailerCallback = () => {
        trailerDialog.value = true;
    };

    /**
     * Show the thumbnail image
     *
     * @return void
     */
    const showThumbnailCallback = () => {
        thumbnailDialog.value = true;
    }

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

        let sortKeyWithDirection =
            options.sortBy.length > 0 ? options.sortBy[0].key : null;

        if (sortKeyWithDirection) {
            sortKeyWithDirection =
                options.sortBy[0].order === "asc"
                    ? sortKeyWithDirection
                    : "-" + sortKeyWithDirection;
        }

        router.reload({
            data: {
                page: options.page,
                itemsPerPage: options.itemsPerPage,
                sort: sortKeyWithDirection,
                "filter[search]": options.search,
            },
            preserveState: true,
            only: ["shows"],
            onSuccess: () => {
                loading.value = false;
            },
            onError: () => {
                loading.value = false;
                notify("Failed to load data", "error");
            },
        });
    }

    /**
     * Open the create show slideover
     *
     * @return void
     */
    const createCallback = () => {
        visitModal(route('dashboard.movies.shows.create', {
            movie: props.movie.id,
        }));
    };

    /**
     * Open the view show slideover
     *
     * @param item
     *
     * @return void
     */
    const viewCallback = (item) => {
        visitModal(route('dashboard.movies.shows.show', {
            movie: item.id,
            show: item.id,
        }), {
            config: {
                slideover: false,
                closeExplicitly: true,
            },
        });
    };

    /**
     * Open the edit show slideover
     *
     * @param item
     *
     * @return void
     */
    const editCallback = (item) => {
        visitModal(route('dashboard.movies.shows.edit', {
            movie: item.id,
            show: item.id,
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
        visitModal(route('dashboard.movies.shows.delete', {
            movie: item.id,
            show: item.id,
        }), {
            config: {
                slideover: false,
                closeExplicitly: true
            }
        });
    };


    /**
     * Notify the user
     *
     * @param {string} message
     * @param {string} type
     *
     * @return void
     */
    const notify = (message, type = "success") => {
        toast(message, {
            autoClose: 1500,
            position: toast.POSITION.BOTTOM_RIGHT,
            type: type,
            hideProgressBar: true,
        });
    };

    const p = usePage();

    /**
     * Watch for flash messages
     *
     * @return void
     */
    watch(
        () => p.props.flash,
        (flash) => {
            const success = p.props.flash.success;
            const error = p.props.flash.error;

            if (success) {
                notify(success);
            } else if (error) {
                notify(error, "error");
            }
        },
        {
            deep: true,
        },
    );

    /**
     * Format date to a readable format
     *
     * @param {string} dateString - The date string to format
     * @returns {string} - The formatted date
     */
    const formatDate = (dateString) => {
        if (!dateString) return "";
        const date = new Date(dateString);
        return date.toLocaleDateString("en-US", {
            year: "numeric",
            month: "2-digit",
            day: "2-digit",
            hour: "2-digit",
            minute: "2-digit",
        });
    };

    /**
     * Get country name by id
     *
     * @param {number} id - The country id
     * @returns {string} - The country name
     */
    const getCountryName = (id) => {
        const country = props.countries.find((item) => item.id === id);
        return country ? country.name : "";
    };

    /**
     * Get language name by id
     *
     * @param {number} id - The language id
     * @returns {string} - The language name
     */
    const getLanguageName = (id) => {
        const language = props.languages.find((item) => item.id === id);
        return language ? language.name : "";
    };

    /**
     * Get genre name by id
     *
     * @param {number} id - The genre id
     * @returns {string} - The genre name
     */
    const getGenreName = (id) => {
        const genre = props.genres.find((item) => item.id === id);
        return genre ? genre.name : "";
    };

    /**
     * Get classification name by id
     *
     * @param {number} id - The classification id
     * @returns {string} - The classification name
     */
    const getClassificationName = (id) => {
        const classification = props.classifications.find((item) => item.id === id);
        return classification ? classification.name : "";
    };

    /**
     * Convert a YouTube URL to an embed URL
     *
     * @param {string} url - The YouTube URL (can be various formats)
     * @return {string} - The embed URL
     */
    const getYoutubeEmbedUrl = (url) => {
        if (!url) return "";

        // Extract video ID from different YouTube URL formats
        let videoId = "";

        // youtube.com/watch?v=VIDEO_ID format
        if (url.includes("youtube.com/watch")) {
            const urlParams = new URLSearchParams(new URL(url).search);
            videoId = urlParams.get("v");
        }
        // youtu.be/VIDEO_ID format
        else if (url.includes("youtu.be")) {
            videoId = url.split("youtu.be/")[1];
        }
        // youtube.com/embed/VIDEO_ID format
        else if (url.includes("/embed/")) {
            videoId = url.split("/embed/")[1];
        }

        // Remove any additional parameters
        if (videoId && videoId.includes("&")) {
            videoId = videoId.split("&")[0];
        }

        if (videoId && videoId.includes("?")) {
            videoId = videoId.split("?")[0];
        }

        // Return the embed URL
        return videoId ? `https://www.youtube.com/embed/${videoId}` : "";
    };
</script>

<style scoped>
    .details-section {
        border-bottom: 1px solid #e0e0e0;
    }

    .details-section:last-child {
        border-bottom: none;
    }

    /* column layout */
    .columns {
        display: flex;
        gap: 24px;
        margin-bottom: 16px;
    }

    .field-column {
        flex: 1;
    }

    .icon-launch,
    .icon-play-circle {
        cursor: pointer;
        color: #1976d2;
    }


    /* Tags styling */
    .tags-container {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .subtitle-tag {
        background-color: #e0f2f1;
        color: #00796b;
        padding: 4px 12px;
        border-radius: 16px;
        font-size: 14px;
    }


    /* Trailer styling */
    .trailer-container {
        margin-top: 8px;
        width: 100%;
        border-radius: 4px;
        overflow: hidden;
    }

    .trailer-placeholder {
        margin-top: 8px;
        height: 160px;
        background-color: #f5f5f5;
        border-radius: 4px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    /* Thumbnail styling */
    .thumbnail-image {
        max-width: 100%;
        max-height: 200px;
        border-radius: 4px;
        margin-top: 8px;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .columns {
            flex-direction: column;
            gap: 16px;
        }

        .movie-details-container {
            max-width: 100%;
        }
    }
</style>
