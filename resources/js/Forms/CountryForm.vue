<template>
    <div class="form-content grid gap-3">
        <vee-field name="name" v-slot="{ field, errors }" class="!mb-5">
            <v-text-field v-bind="field" :error-messages="errors" v-model="form.name" :label="__('Name')"
                variant="outlined" density="comfortable"></v-text-field>
        </vee-field>
    </div>
</template>

<script setup>
    import { __ } from "matice";

    const props = defineProps({
        form: {
            type: Object,
            required: true,
        }
    });
</script>
