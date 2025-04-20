<template>
    <div class="form-content grid gap-3 content-start h-100">
        <vee-field name="seat_type_id" v-slot="{ errors, field: { value, ...field } }">
            <v-autocomplete v-bind="field" :error-messages="errors" v-model="form.seat_type_id" :label="__('Seat Type')"
                variant="outlined" :items="seat_types" item-title="name" item-value="id" density="comfortable"
                prepend-inner-icon="mdi-seat-outline"></v-autocomplete>
        </vee-field>

        <div class="multiselect-container">
            <label class="multiselect-label">
                <v-icon size="small" class="me-1">mdi-format-list-numbered</v-icon>
                {{ __('Rows') }}
            </label>
            <vee-field name="rows" v-slot="{ field, errors }">
                <vue-multiselect v-bind="field" :searchable="true" v-model="form.rows" :options="available_rows"
                    label="name" track-by="id" :placeholder="__('Select rows')" :multiple="true"
                    class="vuetify-integrated"></vue-multiselect>
                <div v-if="errors.length" class="multiselect-error">{{ errors[0] }}</div>
            </vee-field>
        </div>
    </div>
</template>

<script setup>
    import { __ } from "matice";

    const props = defineProps({
        form: {
            type: Object,
            required: true,
        },
        seat_types: {
            type: Array,
            required: true,
        },
        available_rows: {
            type: Array,
            required: true,
        },
    });
</script>
