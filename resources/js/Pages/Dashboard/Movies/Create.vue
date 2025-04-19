<template>
    <Modal v-slot="{ close }">
        <div class="form-container">
            <div class="form-header !mb-3">
                <h2 class="form-title">{{ __('Create Movie') }}</h2>
                <button type="button" class="btn btn-sm btn-close shadow-none" aria-label="Close"
                    @click="close"></button>
            </div>

            <vee-form class="form-content-container" :validation-schema="schema" @submit.prevent="submitForm"
                v-slot="{ meta, setErrors }">
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
    import MovieForm from '../../../Forms/MovieForm.vue';

    const props = defineProps({
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
        trailer_url: yup.string().url(__('trailer url must be a valid url')).required(__('trailer url is required')),
        country_id: yup.number().required(__('country is required')),
        classification_id: yup.number().required(__('classification is required')),
        spoken_language_id: yup.number().required(__('spoken language is required')),
        movieGenres: yup.array().min(1, __('at least one genre is required')).required(__('genre is required')),
        movieSubtitles: yup.array().min(1, __('At least one language is required')).required(__('Language is required')),
    });


    const form = useForm({
        title: null,
        description: null,
        release_date: null,
        duration: null,
        rating: null,
        trailer_url: null,
        thumbnail_file: null,
        country_id: null,
        classification_id: null,
        spoken_language_id: null,
        movieGenres: null,
        movieSubtitles: null,
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
        // Always use FormData since we may have a file
        form.post(route('dashboard.movies.store'), {
            preserveState: true,
            preserveScroll: true,
            forceFormData: true,
            onSuccess: () => {
                form.reset();
                close();
            },
            onError: (errors) => {
                setErrors(errors);
            },
        });
    }
</script>
