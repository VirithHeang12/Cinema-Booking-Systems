<template>
    <Modal v-slot="{ close }">
        <div class="container mt-5 d-flex flex-column align-items-center">
            <h1 class="fw-semibold mb-4 text-zinc-800">{{ __('Update HallType') }}</h1>
            <form @submit.prevent="submitForm" class="col-12">
                <div class="mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input
                    type="text"
                    class="form-control"
                    v-model="form.name"
                    id="name"
                    name="name"
                    placeholder="Enter name"
                />
                </div>
                <div class="mb-3">
                <label for="description" class="form-label">{{ __('Description') }}</label>
                <textarea
                    class="form-control"
                    v-model="form.description"
                    id="description"
                    name="description"
                    rows="3"
                    placeholder="Enter description"
                ></textarea>
                </div>
                <button
                type="submit"
                @click="close"
                class="btn btn-primary !font-medium !text-zinc-50"
                >
                    {{ __('Submit') }}
                </button>
            </form>
        </div>
    </Modal>
</template>

<script setup>
    import { defineProps } from 'vue';
    import { useForm } from '@inertiajs/vue3';

    const props = defineProps({
        hall_type: {
            type: Object,
            required: true,
        }
    });

    const form = useForm({
        name: props.hall_type.name,
        description: props.hall_type.description,
        id: props.hall_type.id,
    });

    const submitForm = () => {
        form.put(route('dashboard.hall_types.update', props.hall_type.id));
    }
</script>
