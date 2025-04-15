<template>
    <Modal v-slot="{ close }">
        <div class="form-container">
            <div class="form-header !mb-0">
                <h2 class="form-title">{{ seat_type.name }}</h2>
                <button type="button" class="btn btn-sm btn-close shadow-none" aria-label="Close"
                    @click="close"></button>
            </div>

            <div class="form-content !font-medium">
                <!-- Basic Information -->
                <div class="details-section">
                    <div class="field-row">
                        <div class="field-label">{{ __('Name') }}</div>
                        <div class="field-value">{{ seat_type.name }}</div>
                    </div>

                    <div class="field-row">
                        <div class="field-label">{{ __('Description') }}</div>
                        <div class="field-value">{{ seat_type.description }}</div>
                    </div>

                    <div class="field-row">
                        <div class="field-label">{{ __('Price') }}</div>
                        <div class="field-value">{{ seat_type.price }}</div>
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
        seat_type: {
            type: Object,
            required: true,
        },
    });
</script>
