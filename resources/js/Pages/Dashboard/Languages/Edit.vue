<template>
    <Modal v-slot="{ close }">
        <div class="language-form-center">
            <div class="form-header">
                <h2 class="form-title">Edite Language</h2>
                <v-btn icon class="close-btn" @click="close">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
            </div>

            <vee-form :validation-schema="schema" @submit.prevent="submitForm" v-slot="{ meta, setErrors }"
                :initialValues="form">
                <language-form :form="form" />
                <div class="form-actions">
                    <v-btn color="primary" :disabled="!meta.valid || form.processing" :loading="form.processing"
                        @click.prevent="submitForm(setErrors, close)" size="large" block>
                        <v-icon class="me-2">mdi-check</v-icon>
                        update
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
    import LanguageForm from "../../../Forms/LanguageForm.vue";

    const schema = yup.object().shape({
        name: yup.string().required(__("Language name is required")),
        code: yup.string().required(__("Language code is required")),
    });

    const props = defineProps({
        language: {
            type: Object,
            required: true,
        },
    });

    const form = useForm({
        name: "",
        code: "",
        _method: "PUT",
    });

    /**
     * Pre-fill the form with existing screen type data
     *
     * @returns void
     */
    onMounted(() => {
        form.name = props.language.name;
        form.code = props.language.code;
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
        form.transform((data) => ({
            ...data,
            _method: "PUT",
        })).post(
            route("dashboard.languages.update", {
                language: props.language.id,
            }),
            {
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
            }
        );
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
