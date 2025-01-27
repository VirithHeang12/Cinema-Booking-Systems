<template>
    <Modal>
        <div>
            <h4 class="text-gray-600">Show Country</h4>
            <ul class="list-group">
                <li class="list-group-item text-gray-600"><span class="fw-semibold text-gray-600">Name: </span> {{ props.country.name }}</li>
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
