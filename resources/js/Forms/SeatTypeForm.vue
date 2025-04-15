<template>
    <div class="form-content grid gap-3">
        <div class="form-section">
            <vee-field name="name" v-slot="{ field, errors }">
                <v-text-field v-bind="field" :error-messages="errors" v-model="form.name" :label="__('Name')"
                    variant="outlined" density="comfortable" prepend-inner-icon="mdi-seat-outline"></v-text-field>
            </vee-field>

            <vee-field name="description" v-slot="{ field, errors }">
                <v-textarea v-bind="field" :error-messages="errors" v-model="form.description"
                    :label="__('Description')" variant="outlined" rows="3" auto-grow
                    prepend-inner-icon="mdi-text-box-outline"></v-textarea>
            </vee-field>

            <vee-field name="price" v-slot="{ field, errors }">
                <v-text-field type="number" v-bind="field" :error-messages="errors" v-model="form.price"
                    :label="__('Price')" variant="outlined" prepend-inner-icon="mdi-currency-usd" class="mb-3"
                    density="comfortable"></v-text-field>
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
    });
</script>
