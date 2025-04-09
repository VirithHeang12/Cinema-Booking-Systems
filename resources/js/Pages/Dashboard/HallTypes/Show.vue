<template>
    <Modal v-slot="{ close }">
        <div class="halltype-details-container">
            <div class="details-header">
                <h2 class="details-title">{{ hall_type.name }}</h2>
                <button class="close-button" @click="close">
                    <v-icon>mdi-close</v-icon>
                </button>
            </div>

            <div class="details-body">
                <!-- Basic Information -->
                <div class="details-section">
                    <div class="field-row">
                        <div class="field-label">Title</div>
                        <div class="field-value">{{ hall_type.name }}</div>
                    </div>

                    <div class="field-row">
                        <div class="field-label">Description</div>
                        <div class="field-value">{{ hall_type.description }}</div>
                    </div>
                </div>
            </div>

            <div class="details-footer">
                <button class="close-button-large" @click="close">
                    <v-icon class="close-icon" size="small">mdi-close</v-icon>
                    CLOSE
                </button>
            </div>
        </div>
    </Modal>
</template>

<script setup>
    import { defineProps } from 'vue';

    const props = defineProps({
        hall_type: {
            type: Object,
            required: true,
        }
    });
</script>
<style scoped>

    /* Modal Container */
    .halltype-details-container {
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
        border-radius: 5px;
        border: none;
        opacity: 0.7;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
    .close-button:hover {
        background-color: #f5f5f5;
        opacity: 1;
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

        .movie-details-container {
            max-width: 100%;
        }
    }
</style>
