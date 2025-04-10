<template>
    <Modal v-slot="{ close }">
        <div class="form-container">
            <div class="form-header !mb-3">
                <h2 class="form-title">Create Hall</h2>
                <button type="button" class="btn btn-sm btn-close shadow-none" aria-label="Close"
                    @click="close"></button>
            </div>

            <vee-form class="form-content-container" :validation-schema="schema" @submit.prevent="submitForm"
                v-slot="{ meta, setErrors }">
                <hall-form :form="form" :seat_types="seat_types" :hall_types="hall_types"></hall-form>

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
        seat_types: {
            type: Array,
            required: true,
        },
        hall_types: {
            type: Array,
            required: true,
        },
    });

    const schema = yup.object().shape({
        name: yup.string().required(__('Name is required')),
        description: yup.string().nullable(),
        hall_type_id: yup.number().required(__('Hall type is required')),
    });

    const form = useForm({
        name: null,
        description: null,
        hall_type_id: null,
        hallSeatTypes: [],
        seats: [],
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
        // Validate that at least one seat type is added
        if (!form.hallSeatTypes || form.hallSeatTypes.length === 0) {
            // Replace with a better notification system
            alert(__('Please add at least one seat type'));
            return;
        }

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
