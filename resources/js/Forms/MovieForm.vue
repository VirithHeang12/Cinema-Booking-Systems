<template>
    <div class="form-content grid gap-3">
        <vee-field name="title" v-slot="{ field, errors }">
            <v-text-field v-bind="field" :error-messages="errors" v-model="form.title" :label="__('Title')"
                variant="outlined" density="comfortable" prepend-inner-icon="mdi-movie-open-outline"></v-text-field>
        </vee-field>

        <vee-field name="description" v-slot="{ field, errors }">
            <v-textarea v-bind="field" :error-messages="errors" v-model="form.description" :label="__('Description')"
                variant="outlined" rows="3" auto-grow prepend-inner-icon="mdi-text-box-outline"></v-textarea>
        </vee-field>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <vee-field name="release_date" v-slot="{ field, errors }">
                <v-text-field type="date" v-bind="field" :error-messages="errors" v-model="form.release_date"
                    :label="__('Release Date')" variant="outlined" prepend-inner-icon="mdi-calendar"
                    density="comfortable"></v-text-field>
            </vee-field>

            <vee-field name="duration" v-slot="{ field, errors }">
                <v-text-field type="number" v-bind="field" :error-messages="errors" v-model="form.duration"
                    :label="__('Duration (minutes)')" variant="outlined" prepend-inner-icon="mdi-clock-outline"
                    density="comfortable"></v-text-field>
            </vee-field>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <vee-field name="rating" v-slot="{ field, errors }">
                <v-text-field v-bind="field" :error-messages="errors" v-model="form.rating" :label="__('Rating (1-10)')"
                    variant="outlined" prepend-inner-icon="mdi-star" density="comfortable"></v-text-field>
            </vee-field>

            <vee-field name="country_id" v-slot="{ errors, field: { value, ...field } }">
                <v-autocomplete v-bind="field" :error-messages="errors" v-model="form.country_id" :label="__('Country')"
                    variant="outlined" :items="countries" item-title="name" item-value="id" density="comfortable"
                    prepend-inner-icon="mdi-earth"></v-autocomplete>
            </vee-field>
        </div>

        <vee-field name="classification_id" v-slot="{ errors, field: { value, ...field } }">
            <v-autocomplete v-bind="field" :error-messages="errors" v-model="form.classification_id"
                :label="__('Classification')" variant="outlined" :items="classifications" item-title="name"
                item-value="id" density="comfortable" prepend-inner-icon="mdi-certificate"></v-autocomplete>
        </vee-field>

        <v-expansion-panels>
            <v-expansion-panel :title="__('Media Links')">
                <v-expansion-panel-text>
                    <vee-field name="trailer_url" v-slot="{ field, errors }">
                        <v-text-field v-bind="field" :error-messages="errors" v-model="form.trailer_url"
                            :label="__('Trailer URL')" variant="outlined" prepend-inner-icon="mdi-youtube"
                            density="comfortable"></v-text-field>
                    </vee-field>

                    <div>
                        <vee-field name="thumbnail_file" v-slot="{ errors }">
                            <div>
                                <ImageUpload :placeholderUrl="form.thumbnail_url" v-model="form.thumbnail_file"
                                    :label="__('Thumbnail')" input-id="movie-thumbnail" />
                                <div v-if="errors.length" class="text-error text-xs mt-1 ml-3">{{
                                    errors[0] }}</div>
                            </div>
                        </vee-field>
                    </div>
                </v-expansion-panel-text>
            </v-expansion-panel>
        </v-expansion-panels>

        <div>
            <h3 class="section-title">{{ __('Languages') }}</h3>
            <vee-field name="spoken_language_id" v-slot="{ errors, field: { value, ...field } }">
                <v-autocomplete v-bind="field" :error-messages="errors" v-model="form.spoken_language_id"
                    :label="__('Spoken Language')" variant="outlined" :items="languages" item-title="name"
                    item-value="id" density="comfortable" prepend-inner-icon="mdi-microphone"></v-autocomplete>
            </vee-field>
        </div>

        <div class="multiselect-container">
            <label class="multiselect-label">
                <v-icon size="small" class="me-1">mdi-closed-caption</v-icon>
                {{ __('Subtitles') }}
            </label>
            <vee-field name="movieSubtitles" v-slot="{ field, errors }">
                <vue-multiselect v-bind="field" :searchable="true" v-model="form.movieSubtitles" :options="languages"
                    label="name" :track-by="'id'" :placeholder="__('Select subtitle languages')" :multiple="true"
                    class="vuetify-integrated"></vue-multiselect>
                <div v-if="errors.length" class="multiselect-error">{{ errors[0] }}</div>
            </vee-field>
        </div>

        <div class="multiselect-container">
            <label class="multiselect-label">
                <v-icon size="small" class="me-1">mdi-tag-multiple</v-icon>
                {{ __('Genres') }}
            </label>
            <vee-field name="movieGenres" v-slot="{ field, errors }">
                <vue-multiselect v-bind="field" :searchable="true" v-model="form.movieGenres" :options="genres"
                    label="name" track-by="id" :placeholder="__('Select movie genres')" :multiple="true"
                    class="vuetify-integrated"></vue-multiselect>
                <div v-if="errors.length" class="multiselect-error">{{ errors[0] }}</div>
            </vee-field>
        </div>
    </div>
</template>

<script setup>
    import { __ } from 'matice';

    const props = defineProps({
        form: {
            type: Object,
            required: true
        },
        countries: {
            type: Array,
            required: true
        },
        genres: {
            type: Array,
            required: true
        },
        languages: {
            type: Array,
            required: true
        },
        classifications: {
            type: Array,
            required: true
        }
    });
</script>
