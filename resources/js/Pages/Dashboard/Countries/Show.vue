<template>
    <Modal v-slot="{ close }">
        <div>
            <div class="d-flex justify-between align-items-start">
                <h4 class="text-gray-700 mb-3 fw-medium text-center">{{ __('Show Country') }}</h4>
                <button type="button" class="btn-close shadow-none " aria-label="Close" @click="close"></button>
            </div>
            <ul class="list-group">
                <li class="list-group-item text-gray-600"><span class="fw-semibold text-gray-600">{{ __('Name') }}:
                    </span> {{ props.country.name }}</li>
            </ul>
        </div>
    </Modal>
</template>

<script setup>
    import { defineProps } from 'vue';

    const props = defineProps({
        country: {
            type: Object,
            required: true,
        }
    });
</script>
