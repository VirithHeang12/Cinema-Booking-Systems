<template>
    <Modal v-slot="{ close }">
        <div class="form-container">
            <div class="form-header !mb-3">
                <h2 class="form-title">{{ __('Edit Hall') }}</h2>
                <button type="button" class="btn btn-sm btn-close shadow-none" aria-label="Close"
                    @click="close"></button>
            </div>

            <vee-form class="form-content-container" :validation-schema="schema" @submit.prevent="submitForm"
                v-slot="{ meta, setErrors }" :initialValues="form">
                <hall-form v-model:form="form" :hall_types="hall_types"></hall-form>
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
    import { onMounted } from 'vue';
    import HallForm from '../../../Forms/HallForm.vue';

    const props = defineProps({
        hall: {
            type: Object,
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
        _method: 'PUT'
    });

    /**
     * Pre-fill the form with existing movie data
     *
     * @returns void
     */
    onMounted(() => {
        form.name = props.hall.name;
        form.description = props.hall.description;
        form.hall_type_id = props.hall.hall_type_id;
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
            route("dashboard.halls.update", {
                hall: props.hall.id,
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
