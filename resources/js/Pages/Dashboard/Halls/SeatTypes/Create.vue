<template>
    <Modal v-slot="{ close }">
        <div class="form-container">
            <div class="form-header !mb-3">
                <h2 class="form-title">{{ __('Create Hall Seat Type') }}</h2>
                <button type="button" class="btn btn-sm btn-close shadow-none" aria-label="Close"
                    @click="close"></button>
            </div>

            <vee-form class="form-content-container" :validation-schema="schema" @submit.prevent="submitForm"
                v-slot="{ meta, setErrors }">
                <hall-seat-type-form :form="form" :available_rows="available_rows"
                    :seat_types="seat_types"></hall-seat-type-form>

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
    import HallSeatTypeForm from '../../../../Forms/HallSeatTypeForm.vue';

    const props = defineProps({
        seat_types: {
            type: Array,
            required: true,
        },
        available_rows: {
            type: Array,
            required: true,
        },
        hall: {
            type: Object,
            required: true,
        }
    });

    const schema = yup.object().shape({
        seat_type_id: yup.number().required(__('Seat type is required')),
    });

    const form = useForm({
        seat_type_id: null,
        rows: null,
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
        form.post(route('dashboard.halls.seat_types.store', {
            hall: props.hall.id,
        }), {
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
