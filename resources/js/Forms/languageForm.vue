<template>
    <div class="form-content">
        <div class="form-section">
            <vee-field name="name" v-slot="{ field, errors }">
                <v-text-field v-bind="field" :error-messages="errors" v-model="form.name" :label="__('Name')"
                    variant="outlined" class="mb-3" density="comfortable"></v-text-field>
            </vee-field>

            <vee-field name="code" v-slot="{ field, errors }">
                <v-text-field v-bind="field" :error-messages="errors" v-model="form.code" :label="__('Code')"
                    variant="outlined" class="mb-3" rows="3" auto-grow></v-text-field>
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
