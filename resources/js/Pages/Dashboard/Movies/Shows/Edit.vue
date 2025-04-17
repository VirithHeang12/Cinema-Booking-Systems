<template>
    <Modal v-slot="{ close }">
        <div class="form-container">
            <div class="form-header !mb-3">
                <h2 class="form-title">{{ __('Edit Show') }}</h2>
                <button type="button" class="btn btn-sm btn-close shadow-none" aria-label="Close"
                    @click="close"></button>
            </div>

            <vee-form class="form-content-container" :validation-schema="schema" @submit.prevent="submitForm"
                v-slot="{ meta, setErrors }" :initialValues="form">
                <show-form :form="form" :languages="languages" :halls="halls" :screen-types="screen_types"></show-form>
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
    import ShowForm from "../../../../Forms/ShowForm.vue";
    import { onMounted } from "vue";

    const props = defineProps({
        languages: {
            type: Array,
            required: true,
        },
        halls: {
            type: Array,
            required: true,
        },
        screen_types: {
            type: Array,
            required: true,
        },
        movie: {
            type: Object,
            required: true,
        },
        show: {
            type: Object,
            required: true,
        },
    });

    const schema = yup.object().shape({
        language_id: yup
            .number()
            .required(__("Language is required")),
        hall_id: yup
            .number()
            .required(__("Hall is required")),
        screen_type_id: yup
            .number()
            .required(__("Screen Type is required")),
        show_time: yup
            .string()
            .required(__("Show Time is required")),
        status: yup.string().nullable(),
    });

    const form = useForm({
        language_id: null,
        hall_id: null,
        screen_type_id: null,
        show_time: null,
        status: null,
        _method: 'PUT'
    });

    /**
     * Pre-fill the form with existing movie data
     *
     * @returns void
     */
    onMounted(() => {
        form.language_id = props.show.language_id;
        form.hall_id = props.show.hall_id;
        form.screen_type_id = props.show.screen_type_id;
        form.show_time = formatDate(props.show.show_time);
        form.status = props.show.status;
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
            route("dashboard.movies.shows.update", {
                movie: props.movie.id,
                show: props.show.id,
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

    /**
     * Format date
     *
     * @param dateString
     *
     * @returns {string|null}
     */
    const formatDate = (dateString) => {
        if (!dateString) return null;
        const date = new Date(dateString);
        return date.toISOString().slice(0, 16);
    };
</script>
