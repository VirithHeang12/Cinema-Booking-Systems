<template>
    <Modal v-slot="{ close }">
        <div class="form-container">
             <div class="form-header !mb-0">
                <h2 class="form-title">{{ movie.title }}</h2>
                <button type="button" class="btn btn-sm btn-close shadow-none" aria-label="Close" @click="close"></button>
            </div>

            <div class="form-content !font-medium">
                <!-- Basic Information -->
                <div class="details-section">
                    <div class="field-row">
                        <div class="field-label">Title</div>
                        <div class="field-value">{{ movie.title }}</div>
                    </div>

                    <div class="field-row">
                        <div class="field-label">Description</div>
                        <div class="field-value">{{ movie.description }}</div>
                    </div>

                    <div class="two-columns">
                        <div class="field-column">
                            <div class="field-label">Release Date</div>
                            <div class="field-value date-value">
                                <v-icon size="small" class="icon-calendar">mdi-calendar</v-icon>
                                {{ formatDate(movie.release_date) }}
                            </div>
                        </div>

                        <div class="field-column">
                            <div class="field-label">Duration (minutes)</div>
                            <div class="field-value duration-value">
                                <v-icon size="small" class="icon-clock">mdi-clock-outline</v-icon>
                                {{ movie.duration }}
                            </div>
                        </div>
                    </div>

                    <div class="two-columns">
                        <div class="field-column">
                            <div class="field-label">Rating (1-10)</div>
                            <div class="field-value rating-value">
                                <v-icon size="small" class="icon-star">mdi-star</v-icon>
                                {{ movie.rating }}
                            </div>
                        </div>

                        <div class="field-column">
                            <div class="field-label">Country</div>
                            <div class="field-value country-value">
                                <v-icon size="small" class="icon-earth">mdi-earth</v-icon>
                                {{ getCountryName(movie.country_id) }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Media Links Section -->
                <div class="details-section">
                    <h3 class="section-title">
                        <v-icon size="small" class="section-icon">mdi-link-variant</v-icon>
                        Media Links
                    </h3>

                    <div class="field-row">
                        <div class="field-label">Trailer</div>
                        <div class="field-value">
                            <div v-if="movie.trailer_url" class="trailer-container">
                                <iframe :src="getYoutubeEmbedUrl(movie.trailer_url)" width="100%" height="240"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                            <div v-else class="trailer-placeholder">
                                <v-icon size="48" color="grey">mdi-video-off</v-icon>
                                <p class="no-trailer-text">No trailer available</p>
                            </div>
                        </div>
                    </div>

                    <div class="field-row">
                        <div class="field-label">Thumbnail</div>
                        <div class="field-value">
                            <img v-if="movie.thumbnail_url" :src="movie.thumbnail_url" alt="Movie thumbnail"
                                class="thumbnail-image" />
                            <div v-else class="thumbnail-placeholder">No thumbnail available</div>
                        </div>
                    </div>
                </div>

                <!-- Languages Section -->
                <div class="details-section">
                    <h3 class="section-title">
                        <v-icon size="small" class="section-icon">mdi-translate</v-icon>
                        Languages
                    </h3>

                    <div class="field-row">
                        <div class="field-label">Spoken Language</div>
                        <div class="field-value">{{ getLanguageName(movie.spoken_language_id) }}</div>
                    </div>

                    <div class="field-row">
                        <div class="field-label">Subtitles</div>
                        <div class="field-value">
                            <div v-if="movie.movieSubtitles && movie.movieSubtitles.length" class="tags-container">
                                <div v-for="subtitle in movie.movieSubtitles" :key="subtitle.id" class="subtitle-tag">
                                    {{ getLanguageName(subtitle.language_id) }}
                                </div>
                            </div>
                            <div v-else>No subtitles available</div>
                        </div>
                    </div>
                </div>

                <!-- Genres Section -->
                <div class="details-section">
                    <h3 class="section-title">
                        <v-icon size="small" class="section-icon">mdi-tag-multiple</v-icon>
                        Genres
                    </h3>

                    <div class="field-row">
                        <div class="tags-container">
                            <div v-if="movie.movieGenres && movie.movieGenres.length">
                                <div v-for="genre in movie.movieGenres" :key="genre.id" class="genre-tag">
                                    {{ getGenreName(genre.genre_id) }}
                                </div>
                            </div>
                            <div v-else>No genres specified</div>
                        </div>
                    </div>
                </div>

                <!-- Classification -->
                <div class="details-section">
                    <div class="field-row">
                        <div class="field-label">Classification</div>
                        <div class="field-value">{{ getClassificationName(movie.classification_id) }}</div>
                    </div>
                </div>
            </div>

            <div class="details-footer">
                <button class="close-button-large" @click="close">
                    <v-icon class="close-icon" size="small">mdi-close</v-icon>
                    CLOSE
                </button>
            </div>
        </div>
    </Modal>
</template>

<script setup>
    import { __ } from 'matice';
    import { computed } from 'vue';

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
    });

    /**
     * Format date to a readable format
     *
     * @param {string} dateString - The date string to format
     * @returns {string} - The formatted date
     */
    const formatDate = (dateString) => {
        if (!dateString) return '';
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit'
        });
    };

    /**
     * Get country name by id
     *
     * @param {number} id - The country id
     * @returns {string} - The country name
     */
    const getCountryName = (id) => {
        const country = props.countries.find(item => item.id === id);
        return country ? country.name : '';
    };

    /**
     * Get language name by id
     *
     * @param {number} id - The language id
     * @returns {string} - The language name
     */
    const getLanguageName = (id) => {
        const language = props.languages.find(item => item.id === id);
        return language ? language.name : '';
    };

    /**
     * Get genre name by id
     *
     * @param {number} id - The genre id
     * @returns {string} - The genre name
     */
    const getGenreName = (id) => {
        const genre = props.genres.find(item => item.id === id);
        return genre ? genre.name : '';
    };

    /**
     * Get classification name by id
     *
     * @param {number} id - The classification id
     * @returns {string} - The classification name
     */
    const getClassificationName = (id) => {
        const classification = props.classifications.find(item => item.id === id);
        return classification ? classification.name : '';
    };

    /**
     * Convert a YouTube URL to an embed URL
     *
     * @param {string} url - The YouTube URL (can be various formats)
     * @return {string} - The embed URL
     */
    const getYoutubeEmbedUrl = (url) => {
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
    };
</script>

<style scoped>

    /* Modal Container */
    .movie-details-container {
        max-width: 900px;
        width: 100%;
        margin: 0 auto;
        background-color: #fff;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        height: 100%;
        overflow: hidden;
    }

    /* Header Styling */
    .details-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 24px;
        border-bottom: 1px solid #e0e0e0;
    }

    .details-title {
        font-size: 24px;
        font-weight: 500;
        color: #1976d2;
        margin: 0;
        padding-right: 24px;
        flex: 1;
    }

    .close-button {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: none;
        background-color: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    /* Body Styling */
    .details-body {
        flex: 1;
        overflow-y: auto;
        padding: 0;
    }

    .details-section {
        border-bottom: 1px solid #e0e0e0;
    }

    .details-section:last-child {
        border-bottom: none;
    }

    .section-title {
        font-size: 16px;
        font-weight: 600;
        color: #1976d2;
        margin-top: 16px;
        display: flex;
        align-items: center;
    }

    .section-icon {
        margin-right: 8px;
    }



    /* Two column layout */
    .two-columns {
        display: flex;
        gap: 24px;
        margin-bottom: 16px;
    }

    .field-column {
        flex: 1;
    }

    /* Icons styling */
    .icon-calendar,
    .icon-clock,
    .icon-star,
    .icon-earth {
        margin-right: 6px;
        opacity: 0.7;
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

    .genre-tag {
        background-color: #e3f2fd;
        color: #1976d2;
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

    .no-trailer-text {
        margin-top: 8px;
        color: #757575;
    }

    /* Thumbnail styling */
    .thumbnail-image {
        max-width: 100%;
        max-height: 200px;
        border-radius: 4px;
        margin-top: 8px;
    }

    .thumbnail-placeholder {
        margin-top: 8px;
        padding: 8px;
        background-color: #f5f5f5;
        border-radius: 4px;
        color: #757575;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .two-columns {
            flex-direction: column;
            gap: 16px;
        }

        .movie-details-container {
            max-width: 100%;
        }
    }
</style>
