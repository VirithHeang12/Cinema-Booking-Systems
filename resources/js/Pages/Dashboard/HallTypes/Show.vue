<template>
    <Modal>
        <div class="px-4">
            <h4 class="text-gray-600 mb-4">{{ __('Show HallType') }}</h4>
            <ul class="list-group">
                <li class="list-group-item text-gray-600">
                    <span class="fw-semibold text-gray-600">{{ __('Name') }}: </span>
                    {{ props.hall_type.name }}
                </li>
                <li class="list-group-item text-gray-600">
                    <span class="fw-semibold text-gray-600">{{ __('Description') }}: </span>
                    {{ props.hall_type.description }}
                </li>
            </ul>
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
