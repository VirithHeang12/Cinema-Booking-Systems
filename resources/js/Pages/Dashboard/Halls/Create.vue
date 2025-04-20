<template>
    <Modal v-slot="{ close }">
        <div class="form-container">
            <div class="form-header !mb-3">
                <h2 class="form-title">{{ __('Create Hall') }}</h2>
                <button type="button" class="btn btn-sm btn-close shadow-none" aria-label="Close"
                    @click="close"></button>
            </div>

            <vee-form class="form-content-container" :validation-schema="schema" @submit.prevent="submitForm"
                v-slot="{ meta, setErrors }">
                <hall-form :form="form" :hall_types="hall_types"></hall-form>

                <div class="form-actions">
                    <v-btn color="primary" :disabled="!meta.valid || form.processing" :loading="form.processing"
                        @click.prevent="submitForm(setErrors, close)" size="large" block>
                        <v-icon class="me-2">mdi-check</v-icon>
                        {{ __("Submit") }}
                    </v-btn>
                </div>
            </vee-form>
        </div>
    </Modal>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3';
    import { __ } from 'matice';
    import * as yup from 'yup';
    import HallForm from '../../../Forms/HallForm.vue';

    const props = defineProps({
        hall_types: {
            type: Array,
            required: true,
        },
    });

    const schema = yup.object().shape({
        name: yup.string().required(__('Name is required')),
        description: yup.string().nullable(),
        hall_type_id: yup.number().required(__('Hall type is required')),
        maximum_seats_per_row: yup.number().required(__('Maximum seats per row is required')),
    });

    const form = useForm({
        name: null,
        description: null,
        hall_type_id: null,
        maximum_seats_per_row: null,
    });

    /**
     * Submit the form
     *
     * @param setErrors
     * @param close
     *
     * @returns void
     */
    const submitForm = (setErrors, close) => {
        form.post(route('dashboard.halls.store'), {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                form.reset();
                close();
            },
            onError: (errors) => {
                setErrors(errors);
            },
        });
    }
</script>
