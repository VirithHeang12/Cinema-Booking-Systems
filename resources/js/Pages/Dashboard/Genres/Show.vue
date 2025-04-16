<template>
    <Modal v-slot="{ close }">
        <div class="form-container">
            <div class="form-header !mb-0">
                <h2 class="form-title">{{ genre.name }}</h2>
                <button
                    type="button"
                    class="btn btn-sm btn-close shadow-none"
                    aria-label="Close"
                    @click="close"
                ></button>
            </div>

            <div class="form-content h-full !font-medium">
                <div class="details-section">
                    <div class="field-row">
                        <div class="field-label">{{__('Name')}}</div>
                        <div class="field-value">{{ genre.name }}</div>
                    </div>

                    <div class="field-row">
                        <div class="field-label">{{__('Genre')}}</div>
                        <div class="field-value">{{ genre.description }}</div>
                    </div>
                </div>
            </div>

            <div class="details-footer">
                <button class="close-button-large" @click="close">
                    <v-icon class="close-icon" size="small">mdi-close</v-icon>
                    {{__('CLOSE')}}
                </button>
            </div>
        </div>
    </Modal>
</template>
<script setup>
import { defineProps } from "vue";
import { __ } from "matice";

const props = defineProps({
    genre: {
        type: Object,
        required: true,
    },
});
</script>
