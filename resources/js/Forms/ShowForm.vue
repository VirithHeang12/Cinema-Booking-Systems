<template>
    <div class="form-content grid gap-3">
        <vee-field
            name="movie_subtitle_id"
            v-slot="{ errors, field: { value, ...field } }"
        >
            <v-autocomplete
                v-bind="field"
                :error-messages="errors"
                v-model="form.movie_subtitle_id"
                :label="__('Subtitle')"
                variant="outlined"
                :items="movieSubtitles"
                item-title="label"
                item-value="id"
                density="comfortable"
                prepend-inner-icon="mdi-closed-caption"
            ></v-autocomplete>
        </vee-field>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <vee-field
                name="hall_id"
                v-slot="{ errors, field: { value, ...field } }"
            >
                <v-autocomplete
                    v-bind="field"
                    :error-messages="errors"
                    v-model="form.hall_id"
                    :label="__('Hall')"
                    variant="outlined"
                    :items="halls"
                    item-title="label"
                    item-value="id"
                    density="comfortable"
                    prepend-inner-icon="mdi-seat"
                ></v-autocomplete>
            </vee-field>

            <vee-field
                name="screen_type_id"
                v-slot="{ errors, field: { value, ...field } }"
            >
                <v-autocomplete
                    v-bind="field"
                    :error-messages="errors"
                    v-model="form.screen_type_id"
                    :label="__('Screen Type')"
                    variant="outlined"
                    :items="screenTypes"
                    item-title="label"
                    item-value="id"
                    density="comfortable"
                    prepend-inner-icon="mdi-monitor"
                ></v-autocomplete>
            </vee-field>
        </div>

        <vee-field name="show_time" v-slot="{ field, errors }">
            <v-text-field
                type="datetime-local"
                v-bind="field"
                :error-messages="errors"
                v-model="form.show_time"
                :label="__('Show Time')"
                variant="outlined"
                prepend-inner-icon="mdi-clock-outline"
                density="comfortable"
            ></v-text-field>
        </vee-field>

        <vee-field name="status" v-slot="{ field, errors }">
            <v-select
                v-bind="field"
                :error-messages="errors"
                v-model="form.status"
                :label="__('Status')"
                variant="outlined"
                :items="['Scheduled', 'Already', 'Showing']"
                density="comfortable"
                prepend-inner-icon="mdi-progress-check"
            ></v-select>
        </vee-field>
    </div>
</template>

<script setup>
import { __ } from "matice";

const props = defineProps({
    form: {
        type: Object,
        required: true,
    },
    movieSubtitles: {
        type: Array,
        required: true,
    },
    halls: {
        type: Array,
        required: true,
    },
    screenTypes: {
        type: Array,
        required: true,
    },
});
</script>
