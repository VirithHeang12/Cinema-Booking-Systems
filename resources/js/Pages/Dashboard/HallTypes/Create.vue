<template>
    <Modal v-slot="{ close }">
        <div class="form-center">
            <div class="form-header">
                <h2 class="form-title">{{ __('Create Hall Type') }}</h2>
                <v-btn icon class="close-btn" @click="close">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
            </div>

            <vee-form :validation-schema="schema" @submit.prevent="submitForm" v-slot="{ meta, setErrors }">
                <hall-type-form :form="form" />
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
    import { __ } from "matice";
    import * as yup from "yup";
    import HallTypeForm from "../../../Forms/HallTypeForm.vue";

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
        // Always use FormData since we may have a file
        form.post(route("dashboard.hall_types.store"), {
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
    };
</script>
