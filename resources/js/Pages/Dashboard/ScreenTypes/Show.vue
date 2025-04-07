<template>
    <Modal v-slot="{ close }">
        <div class="screen-type-details-container">
            <div class="details-header">
                <h2 class="details-title">{{ screen_type.name }}</h2>
                <button class="close-button" @click="close">
                    <v-icon>mdi-close</v-icon>
                </button>
            </div>

            <div class="details-body">
                <!-- Basic Information -->
                <div class="details-section">
                    <div class="field-row">
                        <div class="field-label">Name</div>
                        <div class="field-value">{{ screen_type.name }}</div>
                    </div>

                    <div class="field-row">
                        <div class="field-label">Description</div>
                        <div class="field-value">
                            {{ screen_type.description }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Modal>
</template>

<script setup>
    import { __ } from "matice";

    const props = defineProps({
        screen_type: {
            type: Object,
            required: true,
        },
    });
</script>

<style scoped>
    /* Modal Container */
    .screen-type-details-container {
        max-width: 900px;
        width: 100%;
        margin: 0 auto;
        background-color: #fff;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        height: 100%;
        overflow: hidden;
    }

    /* Header Styling */
    .details-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 24px;
        border-bottom: 1px solid #e0e0e0;
    }

    .details-title {
        font-size: 24px;
        font-weight: 500;
        color: #1976d2;
        margin: 0;
        padding-right: 24px;
        flex: 1;
    }

    .close-button {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: none;
        background-color: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    /* Body Styling */
    .details-body {
        flex: 1;
        overflow-y: auto;
        padding: 0;
    }

    .details-section {
        padding: 16px 24px;
        border-bottom: 1px solid #e0e0e0;
    }

    .details-section:last-child {
        border-bottom: none;
    }

    .section-title {
        font-size: 16px;
        font-weight: 500;
        color: #1976d2;
        margin: 0 0 16px 0;
        display: flex;
        align-items: center;
    }

    .section-icon {
        margin-right: 8px;
    }

    /* Field Rows and Values */
    .field-row {
        margin-bottom: 16px;
    }

    .field-row:last-child {
        margin-bottom: 0;
    }

    .field-label {
        font-size: 14px;
        color: #757575;
        margin-bottom: 4px;
    }

    .field-value {
        font-size: 16px;
        color: #212121;
    }

    /* Two column layout */
    .two-columns {
        display: flex;
        gap: 24px;
        margin-bottom: 16px;
    }

    .field-column {
        flex: 1;
    }

    /* Icons styling */
    .icon-calendar,
    .icon-clock,
    .icon-star,
    .icon-earth {
        margin-right: 6px;
        opacity: 0.7;
    }

    /* Tags styling */
    .tags-container {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .subtitle-tag {
        background-color: #e0f2f1;
        color: #00796b;
        padding: 4px 12px;
        border-radius: 16px;
        font-size: 14px;
    }

    .genre-tag {
        background-color: #e3f2fd;
        color: #1976d2;
        padding: 4px 12px;
        border-radius: 16px;
        font-size: 14px;
    }

    /* Trailer styling */
    .trailer-container {
        margin-top: 8px;
        width: 100%;
        border-radius: 4px;
        overflow: hidden;
    }

    .trailer-placeholder {
        margin-top: 8px;
        height: 160px;
        background-color: #f5f5f5;
        border-radius: 4px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .no-trailer-text {
        margin-top: 8px;
        color: #757575;
    }

    /* Thumbnail styling */
    .thumbnail-image {
        max-width: 100%;
        max-height: 200px;
        border-radius: 4px;
        margin-top: 8px;
    }

    .thumbnail-placeholder {
        margin-top: 8px;
        padding: 8px;
        background-color: #f5f5f5;
        border-radius: 4px;
        color: #757575;
    }

    /* Footer styling */
    .details-footer {
        padding: 16px 24px;
        border-top: 1px solid #e0e0e0;
    }

    .close-button-large {
        width: 100%;
        padding: 10px;
        border: none;
        background-color: #1976d2;
        color: white;
        border-radius: 4px;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .close-icon {
        margin-right: 8px;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .two-columns {
            flex-direction: column;
            gap: 16px;
        }

        .screen-type-details-container {
            max-width: 100%;
        }
    }
</style>
