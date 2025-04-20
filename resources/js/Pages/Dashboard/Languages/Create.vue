<template>
    <Modal v-slot="{ close }">
        <div class="language-form-center">
            <div class="form-header">
                <h2 class="form-title">{{ __('Create Language') }}</h2>
                <v-btn icon class="close-btn" @click="close">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
            </div>

            <vee-form :validation-schema="schema" @submit.prevent="submitForm" v-slot="{ meta, setErrors }">
                <language-form :form="form" />
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
    import LanguageForm from "../../../Forms/languageForm.vue";

    const schema = yup.object().shape({
        name: yup.string().required(__("Language name is required")),
        code: yup.string().required(__("Language code is required")),
    });

    const form = useForm({
        name: "",
        code: "",
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
        form.post(route("dashboard.languages.store"), {
            preserveState: true,
            preserveScroll: true,
            forceFormData: true,
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
<style scoped>
    .form-actions {
        position: absolute;
        right: 0;
        left: 0;
        bottom: 0;
    }
</style>
