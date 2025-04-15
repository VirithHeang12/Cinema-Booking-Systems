<template>
    <Modal v-slot="{ close }">
        <div class="form-container">
            <div class="form-header !mb-3">
                <h2 class="form-title">{{ __('Edit Country') }}</h2>
                <button type="button" class="btn btn-sm btn-close shadow-none" aria-label="Close"
                    @click="close"></button>
            </div>

            <vee-form class="form-content-container" :validation-schema="schema" @submit.prevent="submitForm"
                v-slot="{ meta, setErrors }" :initialValues="form">
                <country-form :form="form"></country-form>

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
    import { useForm } from "@inertiajs/vue3";
    import { __ } from "matice";
    import * as yup from "yup";
    import { onMounted } from "vue";
    import CountryForm from "../../../Forms/CountryForm.vue";

    const props = defineProps({
        country: {
            type: Object,
            required: true,
        },
    });

    const schema = yup.object().shape({
        name: yup
            .string()
            .required(__("Country name is required."))
            .max(50, __("Country name must not exceed 50 characters.")),
    });

    const form = useForm({
        name: "",
        _method: "PUT",
    });

    /**
     * Pre-fill the form with existing country data
     *
     * @returns void
     */
    onMounted(() => {
        form.name = props.country.name;
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
        form
            .transform((data) => ({
                ...data,
                _method: "PUT",
            }))
            .post(
                route("dashboard.countries.update", {
                    country: props.country.id,
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
