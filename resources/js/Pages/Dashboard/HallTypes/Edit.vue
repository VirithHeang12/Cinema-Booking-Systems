<template>
    <Modal v-slot="{ close }">
        <div class="container">
            <div class="form-header">
                <h2 class="form-title">{{ __('Edit Hall Type') }}</h2>
                <v-btn icon class="close-btn" @click="close">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
            </div>

            <vee-form :validation-schema="schema" @submit.prevent="submitForm" v-slot="{ meta, setErrors }"
                :initialValues="form">
                <HallTypeForm :form="form" />
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
    import { useForm } from "@inertiajs/vue3";
    import * as yup from "yup";
    import { __ } from "matice";
    import { onMounted } from 'vue';
    import HallTypeForm from '../../../Forms/HallTypeForm.vue';

    const props = defineProps({
        hall_type: {
            type: Object,
            required: true,
        }
    });

    const schema = yup.object().shape({
        name: yup
            .string()
            .required(__('Hall Type name is required.'))
            .max(50, __('Hall Type name must not exceed 50 characters.')),
        description: yup.string().nullable(),
    });

    const form = useForm({
        name: "",
        description: "",
        _method: 'PUT'
    });

    /**
     * Pre-fill the form with existing hall type data
     *
     * @returns void
     */
    onMounted(() => {
        form.name = props.hall_type.name;
        form.description = props.hall_type.description;
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
            route("dashboard.hall_types.update", {
                hall_type: props.hall_type.id,
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
<style>
    .close-btn {
        margin-right: -8px;
        box-shadow: none !important;
        opacity: 0.7 !important;
    }

    .close-btn:hover {
        background-color: #f5f5f5;
        opacity: 1;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .halltype-form-container {
            max-width: 100%;
        }
    }
</style>
