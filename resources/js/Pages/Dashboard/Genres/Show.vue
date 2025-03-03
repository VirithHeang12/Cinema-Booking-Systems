<template>
    <Modal>
        <div>
            <h1 class="text-lg font-semibold mb-4 text-primary-900 text-center">{{ __('Genres') }}</h1>
            <hr class="my-2" />
            <div class="flex justify-between text-primary-900">
                <span>{{ __('Name') }} : </span>
                <span>{{ props.genre.name }}</span>
            </div>
            <div class="flex justify-between text-primary-900">
                <span>{{ __('Description') }} : </span>
                <span>{{ props.genre.description }}</span>
            </div>
            <!-- <h1>Name: {{ props.genre.name }}</h1> -->
            <!-- <h1>Description: {{ props.genre.description }}</h1> -->
        </div>
    </Modal>
</template>

<script setup>
    import { defineProps } from 'vue';

    const props = defineProps({
        genre: {
            type: Object,
            required: true,
        }
    });
</script>
