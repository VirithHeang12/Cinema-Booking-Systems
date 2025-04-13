<template>
    <div class="form-content mt-4">
        <div class="form-section">
            <vee-field name="name" v-slot="{ field, errors }">
                <v-text-field
                    v-bind="field"
                    :error-messages="errors"
                    v-model="form.name"
                    :label="__('Name')"
                    variant="outlined"
                    class="mb-3"
                    density="comfortable"
                ></v-text-field>
            </vee-field>

            <vee-field name="description" v-slot="{ field, errors }">
                <v-textarea
                    v-bind="field"
                    :error-messages="errors"
                    v-model="form.description"
                    :label="__('Description')"
                    variant="outlined"
                    class="mb-3"
                    rows="3"
                    auto-grow
                ></v-textarea>
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
});
</script>
