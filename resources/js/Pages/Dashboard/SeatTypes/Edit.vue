<template>
    <Modal v-slot="{ close }">
        <div class="form-container">
            <div class="form-header !mb-3">
                <h2 class="form-title">{{ __('Edit Seat Type') }}</h2>
                <button type="button" class="btn btn-sm btn-close shadow-none" aria-label="Close"
                    @click="close"></button>
            </div>

            <vee-form class="form-content-container" :validation-schema="schema" @submit.prevent="submitForm"
                v-slot="{ meta, setErrors }" :initialValues="form">
                <seat-type-form :form="form"></seat-type-form>
                <div class="form-actions">
                    <v-btn color="primary" :disabled="!meta.valid || form.processing" :loading="form.processing"
                        @click.prevent="submitForm(setErrors, close)" size="large" block>
                        <v-icon class="me-2">mdi-check</v-icon>
                        {{ __('Submit') }}
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
    import { onMounted } from 'vue';
    import SeatTypeForm from '../../../Forms/SeatTypeForm.vue';

    const props = defineProps({
        seat_type: {
            type: Object,
            required: true,
        },
    });

    const schema = yup.object().shape({
        name: yup.string()
            .required(__('name is required')),
        description: yup.string()
            .nullable(),
        price: yup.number()
            .min(1, __('price must be at least 1'))
            .max(30, __('price must be at most 30'))
            .typeError(__('price must be a number')),
    });

    const form = useForm({
        name: null,
        description: null,
        price: null,
        _method: 'PUT'
    });

    /**
     * Pre-fill the form with existing seat type data
     *
     * @returns void
     */
    onMounted(() => {
        form.name = props.seat_type.name;
        form.description = props.seat_type.description;
        form.price = props.seat_type.price;
    });

    /**
     * Submit the form data to the server
     *
     * @param setErrors
     * @param close
     *
     * @returns void
     */
    const submitForm = (setErrors, close) => {
        form.transform((data) => ({
            ...data,
            _method: "PUT",
        })).post(
            route("dashboard.seat_types.update", {
                seat_type: props.seat_type.id,
            }),
            {
                preserveScroll: true,
                preserveState: true,
                onError: (errors) => {
                    setErrors(errors.errors);
                },
                onSuccess: () => {
                    form.reset();
                    close();
                },
            }
        );
    };
</script>
