<template>
    <div class="form-content">
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

<style scoped>
    /* .form-content {
        padding: 0 24px;
        max-height: 70vh;
        overflow-y: auto;
        scrollbar-width: thin;
    }

    .form-content::-webkit-scrollbar {
        width: 6px;
    }

    .form-content::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 3px;
    } */

    .form-section {
        padding-top: 10px;
        margin-bottom: 24px;
    }

    .section-title {
        font-size: 18px;
        margin-bottom: 16px;
        color: #424242;
        font-weight: 500;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .subtitle-card,
    .genre-card {
        height: 100%;
    }
</style>
