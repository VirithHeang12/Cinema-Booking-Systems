<template>
    <Modal v-slot="{ close }">
        <div class="screen-type-form-center">
            <div class="form-header">
                <h2 class="form-title">{{__('Edit ScreenType')}}</h2>
                <v-btn icon class="close-btn" @click="close">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
            </div>

            <vee-form
                :validation-schema="schema"
                @submit.prevent="submitForm"
                v-slot="{ meta, setErrors }"
                :initialValues="form"
            >
                <screen-type-form :form="form" />
                <div class="form-actions">
                    <v-btn
                        color="primary"
                        :disabled="!meta.valid || form.processing"
                        :loading="form.processing"
                        @click.prevent="submitForm(setErrors, close)"
                        size="large"
                        block
                    >
                        <v-icon class="me-2">mdi-check</v-icon>
                       {{__('Submit')}}
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
    import ScreenTypeForm from "../../../Forms/ScreenTypeForm.vue";

    const schema = yup.object().shape({
        name: yup.string().required(__("Name is required")),
        description: yup.string().required(__("Description is required")),
    });

    const props = defineProps({
        screen_type: {
            type: Object,
            required: true,
        },
    });

    const form = useForm({
        name: "",
        description: "",
        _method: "PUT",
    });

    /**
     * Pre-fill the form with existing screen type data
     *
     * @returns void
     */
    onMounted(() => {
        form.name = props.screen_type.name;
        form.description = props.screen_type.description;
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
            route("dashboard.screen_types.update", {
                screen_type: props.screen_type.id,
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
    /* Modal Styling */
    .screen-type-form-center {
        max-width: 800px;
        margin: 0 auto;
        padding: 0;
        background-color: #fff;
        border-radius: 8px;
    }

    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 24px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.12);
        margin-bottom: 16px;
    }

    .form-title {
        font-size: 24px;
        font-weight: 500;
        color: #1867c0;
        margin: 0;
    }

    .close-btn {
        margin-right: -8px;
    }

    /* .form-content {
        padding: 0 24px;
        max-height: 70vh;
        overflow-y: auto;
        scrollbar-width: thin;
    }

    .form-content::-webkit-scrollbar {
        width: 6px;
    }

    .form-content::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 3px;
    } */

    .form-section {
        margin-bottom: 24px;
    }

    .section-title {
        font-size: 18px;
        margin-bottom: 16px;
        color: #424242;
        font-weight: 500;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .subtitle-card,
    .genre-card {
        height: 100%;
    }

    .form-actions {
        padding: 16px 24px;
        border-top: 1px solid rgba(0, 0, 0, 0.12);
    }

    /* Multiselect Styling */
    .multiselect__tags {
        border-radius: 4px;
        border: 1px solid rgba(0, 0, 0, 0.38);
        padding: 12px;
        min-height: 56px;
        background-color: #fff;
        font-size: 16px;
        font-family: inherit;
    }

    .multiselect__tags:hover {
        border-color: rgba(0, 0, 0, 0.87);
    }

    .multiselect--active .multiselect__tags {
        border-color: #1867c0;
        box-shadow: 0 0 0 1px #1867c0;
    }

    .multiselect__placeholder {
        color: rgba(0, 0, 0, 0.6);
        padding: 0;
        margin: 0;
    }

    .multiselect__tag {
        background: #1867c0;
        margin: 3px;
        padding: 6px 10px;
        border-radius: 16px;
        color: white;
        font-size: 14px;
        max-width: calc(100% - 10px);
    }

    .multiselect__tag-icon {
        background: #1867c0;
        border-radius: 50%;
    }

    .multiselect__tag-icon:after {
        color: #fff;
        font-weight: bold;
    }

    .multiselect__tag-icon:focus,
    .multiselect__tag-icon:hover {
        background: #0d47a1;
    }

    .multiselect__option {
        padding: 12px;
        min-height: 40px;
        line-height: 1.3;
        font-size: 16px;
    }

    .multiselect__option--highlight {
        background: #1867c0;
        color: white;
    }

    .multiselect__option--selected {
        background: #e8f0fe;
        color: #1867c0;
        font-weight: 500;
    }

    .multiselect__option--selected.multiselect__option--highlight {
        background: #ff5252;
        color: white;
    }

    .multiselect__content-wrapper {
        border: 1px solid rgba(0, 0, 0, 0.12);
        border-top: none;
        border-radius: 0 0 4px 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Multiselect Styling */
    .multiselect__tags {
        border-radius: 4px;
        border: 1px solid rgba(0, 0, 0, 0.38);
        padding: 12px;
        min-height: 56px;
        background-color: #fff;
        font-size: 16px;
        font-family: inherit;
    }

    .multiselect__tags:hover {
        border-color: rgba(0, 0, 0, 0.87);
    }

    .multiselect--active .multiselect__tags {
        border-color: #1867c0;
        box-shadow: 0 0 0 1px #1867c0;
    }

    .multiselect__placeholder {
        color: rgba(0, 0, 0, 0.6);
        padding: 0;
        margin: 0;
    }

    .multiselect__tag {
        background: #1867c0;
        margin: 3px;
        padding: 6px 10px;
        border-radius: 16px;
        color: white;
        font-size: 14px;
        max-width: calc(100% - 10px);
    }

    .multiselect__tag-icon {
        background: #1867c0;
        border-radius: 50%;
    }

    .multiselect__tag-icon:after {
        color: #fff;
        font-weight: bold;
    }

    .multiselect__tag-icon:focus,
    .multiselect__tag-icon:hover {
        background: #0d47a1;
    }

    .multiselect__option {
        padding: 12px;
        min-height: 40px;
        line-height: 1.3;
        font-size: 16px;
    }

    .multiselect__option--highlight {
        background: #1867c0;
        color: white;
    }

    .multiselect__option--selected {
        background: #e8f0fe;
        color: #1867c0;
        font-weight: 500;
    }

    .multiselect__option--selected.multiselect__option--highlight {
        background: #ff5252;
        color: white;
    }

    .multiselect__content-wrapper {
        border: 1px solid rgba(0, 0, 0, 0.12);
        border-top: none;
        border-radius: 0 0 4px 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Multiselect Container Styling */
    .multiselect-container {
        display: flex;
        flex-direction: column;
    }

    .multiselect-label {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        font-size: 16px;
        font-weight: 500;
        color: rgba(0, 0, 0, 0.87);
    }

    .multiselect-error {
        color: #ff5252;
        font-size: 12px;
        margin-top: 4px;
        padding-left: 12px;
    }

    .vuetify-integrated {
        width: 100%;
    }

    /* Error text styling */
    .text-error {
        color: #ff5252;
    }

    .text-xs {
        font-size: 0.75rem;
    }

    .mt-1 {
        margin-top: 0.25rem;
    }

    .ml-3 {
        margin-left: 0.75rem;
    }

    .form-wrapper {
        display: flex;
        flex-direction: column;
        flex: 1;
        height: 100%;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .screen-type-form-center {
            max-width: 100%;
        }
    }
</style>
