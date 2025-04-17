<template>
    <Modal v-slot="{ close }">
        <div class="form-container">
            <div class="form-header !mb-3">
                <h2 class="form-title">{{__('Create Show')}}</h2>
                <button
                    type="button"
                    class="btn btn-sm btn-close shadow-none"
                    aria-label="Close"
                    @click="close"
                ></button>
            </div>

            <vee-form
                class="form-content-container"
                :validation-schema="schema"
                @submit.prevent="submitForm"
                v-slot="{ meta, setErrors }"
            >
                <show-form
                    :form="form"
                    :movie-subtitles="filteredMovieSubtitles"
                    :halls="halls"
                    :screen-types="screenTypes"
                ></show-form>
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
import ShowForm from "../../../Forms/ShowForm.vue";
import { computed } from "vue";

const props = defineProps({
    movieSubtitles: {
        type: Array,
        required: true,
    },
    halls: {
        type: Array,
        required: true,
    },
    screenTypes: {
        type: Array,
        required: true,
    },
    movieId: {
        type: [String, Number],
        default: null,
    },
});

console.log("Create.vue - Props received:", props);
const movieTitle = computed(() => {
    if (props.movieId && props.movieSubtitles.length > 0) {
        const firstMS = props.movieSubtitles[0];
        return firstMS?.label?.split(" (")[0] || __("Unknown Movie");
    }
    return __("Unknown Movie");
});

const filteredMovieSubtitles = computed(() => {
    if (props.movieId) {
        return props.movieSubtitles.filter((ms) =>
            ms.label.includes(movieTitle.value),
        );
    }
    return props.movieSubtitles;
});

const schema = yup.object().shape({
    movie_subtitle_id: yup
        .number()
        .required(__("Movie & Subtitle is required"))
        .nullable(),
    hall_id: yup.number().required(__("Hall is required")).nullable(),
    screen_type_id: yup
        .number()
        .required(__("Screen Type is required"))
        .nullable(),
    show_time: yup.string().required(__("Show Time is required")).nullable(),
    status: yup.string().nullable(),
});

const form = useForm({
    movie_subtitle_id: null,
    hall_id: null,
    screen_type_id: null,
    show_time: null,
    status: "Scheduled",
});
console.log("Create.vue - Initial form data:", form);
const submitForm = (setErrors, close) => {
    console.log(
        "Create.vue - submitForm called. Form data before post:",
        form.data(),
    );
    form.post(route("dashboard.shows.store"), {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            console.log("Create.vue - Form submitted successfully");
            form.reset();
            close();
        },
        onError: (errors) => {
            console.log(
                "Create.vue - Form submission failed with errors:",
                errors,
            );
            setErrors(errors);
        },
    });
};
</script>
