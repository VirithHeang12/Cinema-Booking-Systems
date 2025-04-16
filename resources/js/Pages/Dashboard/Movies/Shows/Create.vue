<template>
    <Modal v-slot="{ close }">
        <div class="form-container">
            <div class="form-header !mb-3">
                <h2 class="form-title">{{ __('Create Show') }}</h2>
                <button type="button" class="btn btn-sm btn-close shadow-none" aria-label="Close"
                    @click="close"></button>
            </div>

            <vee-form class="form-content-container" :validation-schema="schema" @submit.prevent="submitForm"
                v-slot="{ meta, setErrors }">
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
    import { computed } from "vue";

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
        status: "Scheduled",
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
        form.post(route("dashboard.movies.shows.store", {
            movie: props.movie.id,
        }), {
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
