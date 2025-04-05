<template>
    <Modal v-slot="{ close }">
        <div class="movie-form-container">
            <div class="form-header">
                <h2 class="form-title">Update Movie</h2>
                <v-btn icon class="close-btn" @click="close">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
            </div>

            <vee-form :validation-schema="schema" @submit.prevent="submitForm" v-slot="{ meta, setErrors }"
                class="form-wrapper">
                <div class="form-body">
                    <MovieForm :form="form" :countries="countries" :genres="genres" :languages="languages"
                        :classifications="classifications" />
                </div>

                <div class="form-actions">
                    <v-btn color="primary" :disabled="!meta.valid || form.processing" :loading="form.processing"
                        @click.prevent="submitForm(setErrors, close)" size="large" block>
                        <v-icon class="me-2">mdi-content-save</v-icon>
                        Update
                    </v-btn>
                </div>
            </vee-form>
        </div>
    </Modal>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3';
    import { __ } from 'matice';
    import * as yup from 'yup';
    import { onMounted } from 'vue';
    import MovieForm from '../../../Forms/MovieForm.vue';

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

    const schema = yup.object().shape({
        title: yup.string().required(__('title is required')),
        description: yup.string().nullable(),
        release_date: yup.date()
            .required(__('release date is required'))
            .max(new Date(), __('release date cannot be in the future')),
        duration: yup.number().required(__('duration is required')).min(1, __('duration must be at least 1 minute')).typeError(__('duration must be a number')),
        rating: yup.number().min(1, __('rating must be at least 1')).max(10, __('rating must be at most 10')).typeError(__('rating must be a number')),
        trailer_url: yup.string().url(__('trailer url must be a valid url')),
        country_id: yup.number().required(__('country is required')),
        classification_id: yup.number().required(__('classification is required')),
        spoken_language_id: yup.number().required(__('spoken language is required')),
        movieGenres: yup.array().min(1, __('at least one genre is required')).required(__('genre is required')),
        movieSubtitles: yup.array().min(1, __('At least one language is required')).required(__('Language is required')),
    });

    const form = useForm({
        title: '',
        description: '',
        release_date: '',
        duration: '',
        rating: '',
        trailer_url: '',
        thumbnail_file: null,
        country_id: '',
        classification_id: '',
        spoken_language_id: '',
        movieGenres: [],
        movieSubtitles: [],
        _method: 'PUT'
    });

    onMounted(() => {
        // Pre-fill the form with the existing movie data
        form.title = props.movie.title;
        form.description = props.movie.description;
        form.release_date = props.movie.release_date;
        form.duration = props.movie.duration;
        form.rating = props.movie.rating;
        form.trailer_url = props.movie.trailer_url;
        form.country_id = props.movie.country_id;
        form.classification_id = props.movie.classification_id;
        form.spoken_language_id = props.movie.spoken_language_id;
        form.movieGenres = props.movie.genres;
        form.movieSubtitles = props.movie.subtitles;
    });

    /**
    * Submit the form
         *
         * @param setErrors
         * @param close
         *
         * @returns void
         */
    const submitForm = (setErrors, close) => {
        form.method = "PUT";
        form.transform((data) => ({
            ...data,
            _method: "PUT",
        })).post(
            route("dashboard.movies.update", {
                movie: props.movie.id,
            }),
            {
                preserveScroll: true,
                preserveState: true,
                onError: (errors) => {
                    setErrors(errors.errors);
                },
                onSuccess: () => {
                    form.reset();
                    close();
                },
            }
        );
    };
</script>

<style>

    /* Modal Styling */
    .movie-form-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0;
        background-color: #fff;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 24px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.12);
        flex-shrink: 0;
        /* Prevent header from shrinking */
    }

    .form-title {
        font-size: 24px;
        font-weight: 500;
        color: #1867c0;
        margin: 0;
    }

    .close-btn {
        margin-right: -8px;
    }

    .form-wrapper {
        display: flex;
        flex-direction: column;
        flex: 1;
        height: 100%;
    }

    .form-body {
        padding: 16px 24px;
        flex: 1;
        /* Fill available space */
        overflow-y: auto;
        scrollbar-width: thin;
    }

    .form-body::-webkit-scrollbar {
        width: 6px;
    }

    .form-body::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 3px;
    }

    .form-actions {
        padding: 16px 24px;
        border-top: 1px solid rgba(0, 0, 0, 0.12);
        flex-shrink: 0;
        /* Prevent footer from shrinking */
    }

    /* InertiaModal Overrides */
    .im-modal-content {
        max-width: 800px !important;
        padding: 0 !important;
        border-radius: 8px !important;
        overflow: hidden !important;
        max-height: 95vh !important;
        /* Limit height to 95% of viewport */
        display: flex !important;
        flex-direction: column !important;
    }

    .im-slideover-content {
        border-radius: 8px !important;
        padding: 0 !important;
        display: flex !important;
        flex-direction: column !important;
        max-height: 100vh !important;
        height: auto !important;
        /* Set height to auto */
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .movie-form-container {
            max-width: 100%;
        }
    }
</style>
