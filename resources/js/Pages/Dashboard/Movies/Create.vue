<template>
    <Modal v-slot="{ close }">
        <div class="movie-form-container">
            <div class="form-header">
                <h2 class="form-title">Create Movie</h2>
                <v-btn icon class="close-btn" @click="close">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
            </div>

            <vee-form :validation-schema="schema" @submit.prevent="submitForm" v-slot="{ meta, setErrors }">
                <div class="form-content">
                    <div class="form-section">
                        <vee-field name="title" v-slot="{ field, errors }">
                            <v-text-field v-bind="field" :error-messages="errors" v-model="form.title"
                                :label="__('Title')" variant="outlined" class="mb-3"
                                density="comfortable"></v-text-field>
                        </vee-field>

                        <vee-field name="description" v-slot="{ field, errors }">
                            <v-textarea v-bind="field" :error-messages="errors" v-model="form.description"
                                :label="__('Description')" variant="outlined" class="mb-3" rows="3"
                                auto-grow></v-textarea>
                        </vee-field>
                    </div>

                    <div class="form-section form-grid">
                        <div>
                            <vee-field name="release_date" v-slot="{ field, errors }">
                                <v-text-field type="date" v-bind="field" :error-messages="errors"
                                    v-model="form.release_date" :label="__('Release Date')" variant="outlined"
                                    class="mb-3" prepend-inner-icon="mdi-calendar" density="comfortable"></v-text-field>
                            </vee-field>
                        </div>

                        <div>
                            <vee-field name="duration" v-slot="{ field, errors }">
                                <v-text-field type="number" v-bind="field" :error-messages="errors"
                                    v-model="form.duration" :label="__('Duration (minutes)')" variant="outlined"
                                    class="mb-3" prepend-inner-icon="mdi-clock-outline"
                                    density="comfortable"></v-text-field>
                            </vee-field>
                        </div>
                    </div>

                    <div class="form-section form-grid">
                        <div>
                            <vee-field name="rating" v-slot="{ field, errors }">
                                <v-text-field v-bind="field" :error-messages="errors" v-model="form.rating"
                                    :label="__('Rating (1-10)')" variant="outlined" class="mb-3"
                                    prepend-inner-icon="mdi-star" density="comfortable"></v-text-field>
                            </vee-field>
                        </div>

                        <div>
                            <vee-field name="country_id" v-slot="{ errors, field: { value, ...field } }">
                                <v-autocomplete v-bind="field" :error-messages="errors" v-model="form.country_id"
                                    :label="__('Country')" variant="outlined" :items="countries" item-title="name"
                                    item-value="id" class="mb-3" density="comfortable"
                                    prepend-inner-icon="mdi-earth"></v-autocomplete>
                            </vee-field>
                        </div>
                    </div>

                    <div class="form-section">
                        <vee-field name="classification_id" v-slot="{ errors, field: { value, ...field } }">
                            <v-autocomplete v-bind="field" :error-messages="errors" v-model="form.classification_id"
                                :label="__('Classification')" variant="outlined" :items="classifications"
                                item-title="name" item-value="id" class="mb-3" density="comfortable"
                                prepend-inner-icon="mdi-certificate"></v-autocomplete>
                        </vee-field>
                    </div>

                    <div class="form-section">
                        <v-expansion-panels>
                            <v-expansion-panel title="Media Links" class="mb-3">
                                <v-expansion-panel-text>
                                    <vee-field name="trailer_url" v-slot="{ field, errors }">
                                        <v-text-field v-bind="field" :error-messages="errors" v-model="form.trailer_url"
                                            :label="__('Trailer URL')" variant="outlined" class="mb-3"
                                            prepend-inner-icon="mdi-youtube" density="comfortable"></v-text-field>
                                    </vee-field>

                                    <div class="mb-3">
                                        <vee-field name="thumbnail_file" v-slot="{ errors }">
                                            <div>
                                                <ImageUpload v-model="form.thumbnail_file" label="Thumbnail"
                                                    input-id="movie-thumbnail" />
                                                <div v-if="errors.length" class="text-error text-xs mt-1 ml-3">{{
                                                    errors[0] }}</div>
                                            </div>
                                        </vee-field>
                                    </div>
                                </v-expansion-panel-text>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </div>

                    <div class="form-section">
                        <h3 class="section-title">Languages</h3>
                        <vee-field name="spoken_language_id" v-slot="{ errors, field: { value, ...field } }">
                            <v-autocomplete v-bind="field" :error-messages="errors" v-model="form.spoken_language_id"
                                :label="__('Spoken Language')" variant="outlined" :items="languages" item-title="name"
                                item-value="id" class="mb-3" density="comfortable"
                                prepend-inner-icon="mdi-microphone"></v-autocomplete>
                        </vee-field>

                        <div class="multiselect-container mb-3">
                            <label class="multiselect-label">
                                <v-icon size="small" class="me-1">mdi-closed-caption</v-icon>
                                Subtitles
                            </label>
                            <vee-field name="movieSubtitles" v-slot="{ field, errors }">
                                <vue-multiselect v-bind="field" :searchable="true" v-model="form.movieSubtitles"
                                    :options="languages" label="name" :track-by="'id'"
                                    :placeholder="__('Select subtitle languages')" :multiple="true"
                                    class="vuetify-integrated"></vue-multiselect>
                                <div v-if="errors.length" class="multiselect-error">{{ errors[0] }}</div>
                            </vee-field>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="multiselect-container mb-3">
                            <label class="multiselect-label">
                                <v-icon size="small" class="me-1">mdi-tag-multiple</v-icon>
                                Genres
                            </label>
                            <vee-field name="movieGenres" v-slot="{ field, errors }">
                                <vue-multiselect v-bind="field" :searchable="true" v-model="form.movieGenres"
                                    :options="genres" label="name" track-by="id"
                                    :placeholder="__('Select movie genres')" :multiple="true"
                                    class="vuetify-integrated"></vue-multiselect>
                                <div v-if="errors.length" class="multiselect-error">{{ errors[0] }}</div>
                            </vee-field>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <v-btn color="primary" :disabled="!meta.valid || form.processing" :loading="form.processing"
                        @click.prevent="submitForm(setErrors, close)" size="large" block>
                        <v-icon class="me-2">mdi-check</v-icon>
                        Submit
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
        trailer_url: yup.string().url(__('trailer url must be a valid url')),
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

<style>

    /* Modal Styling */
    .movie-form-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0;
        background-color: #fff;
        border-radius: 8px;
    }

    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 24px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.12);
        margin-bottom: 16px;
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

    .form-content {
        padding: 0 24px;
        max-height: 70vh;
        overflow-y: auto;
        scrollbar-width: thin;
    }

    .form-content::-webkit-scrollbar {
        width: 6px;
    }

    .form-content::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 3px;
    }

    .form-section {
        margin-bottom: 24px;
    }

    .section-title {
        font-size: 18px;
        margin-bottom: 16px;
        color: #424242;
        font-weight: 500;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .subtitle-card,
    .genre-card {
        height: 100%;
    }

    .form-actions {
        padding: 16px 24px;
        border-top: 1px solid rgba(0, 0, 0, 0.12);
    }

    /* Multiselect Styling */
    .multiselect__tags {
        border-radius: 4px;
        border: 1px solid rgba(0, 0, 0, 0.38);
        padding: 12px;
        min-height: 56px;
        background-color: #fff;
        font-size: 16px;
        font-family: inherit;
    }

    .multiselect__tags:hover {
        border-color: rgba(0, 0, 0, 0.87);
    }

    .multiselect--active .multiselect__tags {
        border-color: #1867c0;
        box-shadow: 0 0 0 1px #1867c0;
    }

    .multiselect__placeholder {
        color: rgba(0, 0, 0, 0.6);
        padding: 0;
        margin: 0;
    }

    .multiselect__tag {
        background: #1867c0;
        margin: 3px;
        padding: 6px 10px;
        border-radius: 16px;
        color: white;
        font-size: 14px;
        max-width: calc(100% - 10px);
    }

    .multiselect__tag-icon {
        background: #1867c0;
        border-radius: 50%;
    }

    .multiselect__tag-icon:after {
        color: #fff;
        font-weight: bold;
    }

    .multiselect__tag-icon:focus,
    .multiselect__tag-icon:hover {
        background: #0d47a1;
    }

    .multiselect__option {
        padding: 12px;
        min-height: 40px;
        line-height: 1.3;
        font-size: 16px;
    }

    .multiselect__option--highlight {
        background: #1867c0;
        color: white;
    }

    .multiselect__option--selected {
        background: #e8f0fe;
        color: #1867c0;
        font-weight: 500;
    }

    .multiselect__option--selected.multiselect__option--highlight {
        background: #ff5252;
        color: white;
    }

    .multiselect__content-wrapper {
        border: 1px solid rgba(0, 0, 0, 0.12);
        border-top: none;
        border-radius: 0 0 4px 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

    /* Multiselect Styling */
    .multiselect__tags {
        border-radius: 4px;
        border: 1px solid rgba(0, 0, 0, 0.38);
        padding: 12px;
        min-height: 56px;
        background-color: #fff;
        font-size: 16px;
        font-family: inherit;
    }

    .multiselect__tags:hover {
        border-color: rgba(0, 0, 0, 0.87);
    }

    .multiselect--active .multiselect__tags {
        border-color: #1867c0;
        box-shadow: 0 0 0 1px #1867c0;
    }

    .multiselect__placeholder {
        color: rgba(0, 0, 0, 0.6);
        padding: 0;
        margin: 0;
    }

    .multiselect__tag {
        background: #1867c0;
        margin: 3px;
        padding: 6px 10px;
        border-radius: 16px;
        color: white;
        font-size: 14px;
        max-width: calc(100% - 10px);
    }

    .multiselect__tag-icon {
        background: #1867c0;
        border-radius: 50%;
    }

    .multiselect__tag-icon:after {
        color: #fff;
        font-weight: bold;
    }

    .multiselect__tag-icon:focus,
    .multiselect__tag-icon:hover {
        background: #0d47a1;
    }

    .multiselect__option {
        padding: 12px;
        min-height: 40px;
        line-height: 1.3;
        font-size: 16px;
    }

    .multiselect__option--highlight {
        background: #1867c0;
        color: white;
    }

    .multiselect__option--selected {
        background: #e8f0fe;
        color: #1867c0;
        font-weight: 500;
    }

    .multiselect__option--selected.multiselect__option--highlight {
        background: #ff5252;
        color: white;
    }

    .multiselect__content-wrapper {
        border: 1px solid rgba(0, 0, 0, 0.12);
        border-top: none;
        border-radius: 0 0 4px 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Multiselect Container Styling */
    .multiselect-container {
        display: flex;
        flex-direction: column;
    }

    .multiselect-label {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        font-size: 16px;
        font-weight: 500;
        color: rgba(0, 0, 0, 0.87);
    }

    .multiselect-error {
        color: #ff5252;
        font-size: 12px;
        margin-top: 4px;
        padding-left: 12px;
    }

    .vuetify-integrated {
        width: 100%;
    }

    /* Error text styling */
    .text-error {
        color: #ff5252;
    }

    .text-xs {
        font-size: 0.75rem;
    }

    .mt-1 {
        margin-top: 0.25rem;
    }

    .ml-3 {
        margin-left: 0.75rem;
    }

    .form-wrapper {
        display: flex;
        flex-direction: column;
        flex: 1;
        height: 100%;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .movie-form-container {
            max-width: 100%;
        }
    }
</style>
