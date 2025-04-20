<template>
    <div class="form-content">
        <vee-field name="name" v-slot="{ field, errors }">
            <div class="mb-6">
                <v-text-field v-bind="field" :error-messages="errors" v-model="form.name" variant="outlined"
                    density="comfortable" :placeholder="__('Enter Hall Name')" class="rounded-lg" bg-color="surface"
                    hide-details="auto" prepend-inner-icon="mdi-chair-rolling"></v-text-field>
            </div>
        </vee-field>

        <vee-field name="description" v-slot="{ field, errors }">
            <div class="mb-6">
                <v-textarea v-bind="field" :error-messages="errors" v-model="form.description" variant="outlined"
                    rows="3" auto-grow :placeholder="__('Enter Hall Description')" class="rounded-lg" bg-color="surface"
                    hide-details="auto" prepend-inner-icon="mdi-text-box-outline"></v-textarea>
            </div>
        </vee-field>

        <vee-field name="hall_type_id" v-slot="{ errors, field: { value, ...field } }">
            <div class="mb-6">
                <v-autocomplete v-bind="field" :error-messages="errors" v-model="form.hall_type_id" variant="outlined"
                    :items="hall_types" item-title="name" item-value="id" density="comfortable"
                    prepend-inner-icon="mdi-theater" :placeholder="__('Select Hall Type')" class="rounded-lg"
                    bg-color="surface" hide-details="auto"></v-autocomplete>
            </div>
        </vee-field>

        <vee-field name="maximum_seats_per_row" v-slot="{ field, errors }">
            <v-text-field type="number" v-bind="field" :error-messages="errors" v-model="form.maximum_seats_per_row"
                :label="__('Maximum Seats Per Row')" variant="outlined" prepend-inner-icon="mdi-counter"
                density="comfortable"></v-text-field>
        </vee-field>
    </div>
</template>

<script setup>
    import { __ } from 'matice';

    const props = defineProps({
        hall_types: {
            type: Array,
            required: true
        }
    });

    const form = defineModel('form', {
        type: Object,
        required: true,
    });
</script>
