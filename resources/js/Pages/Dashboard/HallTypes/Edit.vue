<template>
    <Modal v-slot="{ close }">
        <div class="halltype-form-container">
            <div class="form-header">
                <h2 class="form-title">Edit Halltype</h2>
                <v-btn icon class="close-btn" @click="close">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
            </div>

            <vee-form :validation-schema="schema" @submit.prevent="submitForm" v-slot="{ meta, setErrors }"
                :initialValues="form">
                <HallTypeForm :form="form"/>
                <div class="form-actions">
                    <v-btn color="primary" :disabled="!meta.valid || form.processing" :loading="form.processing"
                        @click.prevent="submitForm(setErrors, close)" size="large" block>
                        <v-icon class="me-2">mdi-check</v-icon>
                        Submit
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
            .required(__('HallType name is required.'))
            .max(50, __('HallType name must not exceed 50 characters.')),
        description: yup.string().nullable(),
    });

    const form = useForm({
        name: "",
        description: "",
        _method: 'PUT'
    });

    /**
     * Pre-fill the form with existing movie data
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

    /* Modal Styling */
    .halltype-form-container {
        max-width: 800px;
        /* margin: 0 auto; */
        padding: 0;
        background-color: #fff;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 24px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.12);
        flex-shrink: 0;
        /* Prevent header from shrinking */
    }

    .form-title {
        font-size: 24px;
        font-weight: 500;
        color: #1867c0;
        margin: 0;
    }

    .close-btn {
        margin-right: -8px;
        box-shadow: none !important;
        opacity: 0.7 !important;
    }
    .close-btn:hover {
        background-color: #f5f5f5;
        opacity: 1;
    }

    .form-wrapper {
        display: flex;
        flex-direction: column;
        flex: 1;
        height: 100%;
    }

    .form-body {
        padding: 16px 24px;
        flex: 1;
        /* Fill available space */
        overflow-y: auto;
        scrollbar-width: thin;
    }

    .form-body::-webkit-scrollbar {
        width: 6px;
    }

    .form-body::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 3px;
    }

    .form-actions {
        padding: 16px 24px;
        border-top: 1px solid rgba(0, 0, 0, 0.12);
        flex-shrink: 0;
        /* Prevent footer from shrinking */
    }

    /* InertiaModal Overrides */
    .im-modal-content {
        max-width: 800px !important;
        padding: 0 !important;
        border-radius: 8px !important;
        overflow: hidden !important;
        max-height: 95vh !important;
        /* Limit height to 95% of viewport */
        display: flex !important;
        flex-direction: column !important;
    }

    .im-slideover-content {
        border-radius: 8px !important;
        padding: 0 !important;
        display: flex !important;
        flex-direction: column !important;
        max-height: 100vh !important;
        height: auto !important;
        /* Set height to auto */
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .halltype-form-container {
            max-width: 100%;
        }
    }
</style>
