<template>
    <div>
        <h1 class="text-lg font-semibold mb-4 text-primary-900 text-center">{{ __('Edit Genre') }}</h1>
        <hr class="my-2" />
        <form @submit.prevent="submitForm">
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input type="text" v-model="form.name" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="description">{{ __('Description') }}</label>
                <input type="text" v-model="form.description" class="form-control" id="description" name="description">
            </div>
            <button type="submit"
                class="btn btn-dark text-white w-full mt-4 bg-primary-800 round-[10px] px-9 py-2 hover:bg-gray-800">{{ __('Submit') }}</button>
        </form>
    </div>
</template>

<script setup>
    import { defineProps } from 'vue';
    import { useForm } from '@inertiajs/vue3';

    const props = defineProps({
        genre: {
            type: Object,
            required: true,
        }
    });

    const form = useForm({
        name: props.genre.name,
        description: props.genre.description,
    });

    const submitForm = () => {
        form.put(route('dashboard.genres.update', props.genre.id));
    }
</script>
