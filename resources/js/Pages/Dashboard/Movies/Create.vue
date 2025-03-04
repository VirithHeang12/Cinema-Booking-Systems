<template>
    <Modal v-slot="{ close }">
        <v-card>
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

                <vee-field name="country_id" v-slot="{ errors }">
                    <v-autocomplete :error-messages="errors" v-model="form.country_id" :label="__('Country')"
                        variant="outlined" :items="countries" item-title="name" item-value="id"></v-autocomplete>
                </vee-field>

                <vee-field name="movieGenres" v-slot="{ field, errors }">
                    <v-select v-bind="field" :error-messages="errors" v-model="form.movieGenres" :label="__('Genre')"
                        variant="outlined" :items="genres" item-title="name" item-value="id" multiple></v-select>
                </vee-field>

                <vee-field name="movieSubtitles" v-slot="{ field, errors }">
                    <v-select v-bind="field" :error-messages="errors" v-model="form.movieSubtitles"
                        :label="__('Language')" variant="outlined" :items="languages" item-title="name" item-value="id"
                        multiple></v-select>
                </vee-field>

                <vee-field name="movieSubtitles">
                    <vue-multiselect :searchable="true" :close-on-select="false" v-model="form.movieSubtitles"
                        :options="languages" label="name" track-by="id" placeholder="Select language"
                        :multiple="true"></vue-multiselect>
                </vee-field>


                <v-btn @click="close" color="primary" :disabled="!meta.valid || form.processing"
                    :loading="form.processing" @click.prevent="submitForm(setErrors)" block>Submit</v-btn>
            </vee-form>
        </v-card>
    </Modal>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3';
    import axios from 'axios';
    import { __ } from 'matice';
    import { onMounted, ref } from 'vue';
    import * as yup from 'yup';

    const schema = yup.object().shape({
        // title: yup.string().required(__('title is required')),
        // release_date: yup.date()
        //     .required(__('release date is required'))
        //     .max(new Date(), __('release date cannot be in the future')),
        // duration: yup.number().required(__('duration is required')),
        // rating: yup.number().min(1, __('rating must be at least 1')).max(10, __('rating must be at most 10')).required(__('rating is required')).typeError(__('rating must be a number')),
        // country_id: yup.number().required(__('country is required')),
        // movieGenres: yup.array().of(yup.number()).min(1, __('at least one genre is required')).required(__('genre is required')),
        // movieLanguages: yup.array().of(yup.number()).min(1, __('at least one language is required')).required(__('language is required')),
    });

    const form = useForm({
        title: '',
        description: '',
        release_date: '',
        duration: '',
        rating: '',
        trailer_url: '',
        thumbnail_url: '',
        production_company_id: '',
        country_id: '',
        movieGenres: [],
        movieSubtitles: [],
    });

    const countries = ref([]);
    const genres = ref([]);
    const languages = ref([]);

    const submitForm = () => {
        form.post(route('dashboard.movies.store'));
    }

    /**
     * Load countries
     *
     * @returns {Promise<void>}
     */
    const loadCountries = async () => {
        try {
            const response = await axios.get('http://cinema-booking-systems.test/api/v1/dashboard/countries', {
                headers: {
                    'Accept': 'application/json',
                }
            });

            if (response.data) {
                countries.value = response.data;
            }
        } catch (error) {
            console.error(error);
        }
    }

    /**
     * Load Genres
     *
     * @returns {Promise<void>}
     */
    const loadGenres = async () => {
        try {
            const response = await axios.get('http://cinema-booking-systems.test/api/v1/dashboard/genres', {
                headers: {
                    'Accept': 'application/json',
                }
            });

            if (response.data) {
                genres.value = response.data;
            }
        } catch (error) {
            console.error(error);
        }
    }

    /**
     * Load Languages
     *
     * @returns {Promise<void>}
     */
    const loadLanguages = async () => {
        try {
            const response = await axios.get('http://cinema-booking-systems.test/api/v1/dashboard/languages', {
                headers: {
                    'Accept': 'application/json',
                }
            });

            if (response.data) {
                languages.value = response.data;
            }
        } catch (error) {
            console.error(error);
        }
    }

    /**
     * on mounted
     *
     * @returns {Promise<void>}
     */
    onMounted(async () => {
        await Promise.all([
            loadCountries(),
            loadGenres(),
            loadLanguages(),
        ]);
    });

</script>

<style>
    .im-modal-content {
        padding: 50px;
    }

    .im-close-button {
        background-color: red;
    }
</style>
