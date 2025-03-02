<template>
    <div>
        <h1 class="text-lg font-semibold mb-4 text-primary-900 text-center">{{ __('Are you want to delete this genre?')
            }}
        </h1>

        <form @submit.prevent="submitForm">
            <button
                class="btn btn-dark text-white w-full mt-4 bg-primary-800 round-[10px] px-9 py-2 hover:bg-gray-800">{{
                    __('Delete') }}</button>
        </form>
    </div>
</template>

<script setup>
    import { defineProps } from 'vue';
    import { router } from '@inertiajs/vue3';

    const props = defineProps({
        genre: {
            type: Object,
            required: true,
        }
    });

    const submitForm = () => {
        router.delete(route('dashboard.genres.destroy', props.genre.id));
    }
</script>
