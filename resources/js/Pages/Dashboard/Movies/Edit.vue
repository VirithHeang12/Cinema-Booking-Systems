<template>
    <Modal v-slot="{ close }">
        <div class="form-container">
            <div class="form-header !mb-3">
                <h2 class="form-title">{{ __('Edit Movie') }}</h2>
                <button type="button" class="btn btn-sm btn-close shadow-none" aria-label="Close"
                    @click="close"></button>
            </div>

            <vee-form class="form-content-container" :validation-schema="schema" @submit.prevent="submitForm"
                v-slot="{ meta, setErrors }" :initialValues="form">
                <movie-form :form="form" :countries="countries" :genres="genres" :languages="languages"
                    :classifications="classifications"></movie-form>
                <div class="form-actions">
                    <v-btn color="primary" :disabled="!meta.valid || form.processing" :loading="form.processing"
                        @click.prevent="submitForm(setErrors, close)" size="large" block>
                        <v-icon class="me-2">mdi-check</v-icon>
                        {{ __("Submit") }}
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
        thumbnail_url: null,
        thumbnail_file: null,
        country_id: '',
        classification_id: '',
        spoken_language_id: '',
        movieGenres: [],
        movieSubtitles: [],
        _method: 'PUT'
    });

    /**
     * Pre-fill the form with existing movie data
     *
     * @returns void
     */
    onMounted(() => {
        form.title = props.movie.title;
        form.description = props.movie.description;
        form.release_date = props.movie.release_date;
        form.duration = props.movie.duration;
        form.rating = props.movie.rating;
        form.trailer_url = props.movie.trailer_url;
        form.thumbnail_url = props.movie.thumbnail_url;
        form.country_id = props.movie.country_id;
        form.classification_id = props.movie.classification_id;
        form.spoken_language_id = props.movie.spoken_language_id;
        form.movieGenres = props.movie.movieGenres;
        form.movieSubtitles = props.movie.movieSubtitles;
    });

    /**
     * Submit the form data to the server
     *
     * @param setErrors
     * @param close
     *
     * @returns void
     */
    const submitForm = (setErrors, close) => {
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
