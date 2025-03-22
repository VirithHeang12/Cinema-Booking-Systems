<template>
    <Modal v-slot="{ close }">
        <h4 class="text-gray-600">Create Movie</h4>
        <vee-form :validation-schema="schema" @submit.prevent="submitForm" v-slot="{ meta, setErrors }">
            <vee-field name="title" v-slot="{ field, errors }">
                <v-text-field v-bind="field" :error-messages="errors" v-model="form.title" :label="__('Title')"
                    variant="outlined"></v-text-field>
            </vee-field>

            <vee-field name="description" v-slot="{ field, errors }">
                <v-textarea v-bind="field" :error-messages="errors" v-model="form.description"
                    :label="__('Description')" variant="outlined"></v-textarea>
            </vee-field>

            <vee-field name="release_date" v-slot="{ field, errors }">
                <v-text-field type="date" v-bind="field" :error-messages="errors" v-model="form.release_date"
                    :label="__('Release Date')" variant="outlined"></v-text-field>
            </vee-field>

            <vee-field name="duration" v-slot="{ field, errors }">
                <v-text-field type="number" v-bind="field" :error-messages="errors" v-model="form.duration"
                    :label="__('Duration')" variant="outlined"></v-text-field>
            </vee-field>

            <vee-field name="rating" v-slot="{ field, errors }">
                <v-text-field v-bind="field" :error-messages="errors" v-model="form.rating" :label="__('Rating')"
                    variant="outlined"></v-text-field>
            </vee-field>

            <vee-field name="trailer_url" v-slot="{ field, errors }">
                <v-text-field v-bind="field" :error-messages="errors" v-model="form.trailer_url"
                    :label="__('Trailer URL')" variant="outlined"></v-text-field>
            </vee-field>

            <vee-field name="thumbnail_url" v-slot="{ field, errors }">
                <v-text-field v-bind="field" :error-messages="errors" v-model="form.thumbnail_url"
                    :label="__('Thumbnail URL')" variant="outlined"></v-text-field>
            </vee-field>

            <vee-field name="country_id" v-slot="{ errors, field: { value, ...field } }">
                <v-autocomplete v-bind="field" :error-messages="errors" v-model="form.country_id" :label="__('Country')"
                    variant="outlined" :items="countries" item-title="name" item-value="id"></v-autocomplete>
            </vee-field>

            <vee-field name="classification_id" v-slot="{ errors, field: { value, ...field } }">
                <v-autocomplete v-bind="field" :error-messages="errors" v-model="form.classification_id"
                    :label="__('Classification')" variant="outlined" :items="classifications" item-title="name"
                    item-value="id"></v-autocomplete>
            </vee-field>


            <vee-field name="spoken_language_id" v-slot="{ errors, field: { value, ...field } }">
                <v-autocomplete v-bind="field" :error-messages="errors" v-model="form.spoken_language_id"
                    :label="__('Spoken Language')" variant="outlined" :items="languages" item-title="name"
                    item-value="id"></v-autocomplete>
            </vee-field>

            <label for="movieSubtitles">Subtitles</label>
            <vee-field name="movieSubtitles">
                <vue-multiselect :searchable="true" :close-on-select="false" v-model="form.movieSubtitles"
                    :options="languages" label="name" track-by="id" :placeholder="__('Select language')"
                    :multiple="true"></vue-multiselect>
            </vee-field>

            <label for="movieSubtitles">Genres</label>
            <vee-field name="movieGenres">
                <vue-multiselect :searchable="true" :close-on-select="false" v-model="form.movieGenres"
                    :options="genres" label="name" track-by="id" :placeholder="__('Select genre')"
                    :multiple="true"></vue-multiselect>
            </vee-field>


            <v-btn color="primary" :disabled="!meta.valid || form.processing" :loading="form.processing"
                @click.prevent="submitForm(setErrors, close)" block>Submit</v-btn>
        </vee-form>
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
        thumbnail_url: yup.string().url(__('thumbnail url must be a valid url')),
        country_id: yup.number().required(__('country is required')),
        classification_id: yup.number().required(__('classification is required')),
        spoken_language_id: yup.number().required(__('spoken language is required')),
        movieGenres: yup.array().of(yup.number()).min(1, __('at least one genre is required')).required(__('genre is required')),
        movieSubtitles: yup.array().of(yup.number()).min(1, __('at least one language is required')).required(__('language is required')),
    });

    const form = useForm({
        title: null,
        description: null,
        release_date: null,
        duration: null,
        rating: null,
        trailer_url: null,
        thumbnail_url: null,
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
        form.post(route('dashboard.movies.store'), {
            preserveState: true,
            preserveScroll: true,
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
    .im-modal-content {
        padding: 50px;
    }

    .im-close-button {
        margin: 15px;
    }

    .im-close-button svg path {
        stroke: rgb(114, 114, 114);
        transition: 0.3s;
    }

    .im-close-button:hover.im-close-button svg path {
        stroke: rgb(56, 56, 56);
    }

    .im-slideover-container {

        scrollbar-width: none !important;
    }

    .im-slideover-positioner {
        padding: 9px;
    }

    .im-slideover-content {

        min-height: 98vh !important;
        border-radius: 10px;
    }
</style>
