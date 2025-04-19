<template>
    <Modal v-slot="{ close }">
        <div class="form-container">
            <div class="form-header !mb-0">
                <h2 class="form-title">{{ country.name }}</h2>
                <button type="button" class="btn btn-sm btn-close shadow-none" aria-label="Close"
                    @click="close"></button>
            </div>

            <div class="form-content !font-medium">
                <!-- Basic Information -->
                <div class="details-section">
                    <div class="field-row">
                        <div class="field-label">{{ __('Name') }}</div>
                        <div class="field-value">{{ country.name }}</div>
                    </div>
                </div>
            </div>

            <div class="details-footer">
                <button class="close-button-large" @click="close">
                    <v-icon class="close-icon" size="small">mdi-close</v-icon>
                    {{ __('CLOSE') }}
                </button>
            </div>
        </div>
    </Modal>
</template>

<script setup>
    import { __ } from 'matice';

    const props = defineProps({
        country: {
            type: Object,
            required: true,
        },
    });
</script>
