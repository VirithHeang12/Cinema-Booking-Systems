<template>
    <Modal v-slot="{ close }">
        <div class="form-container">
            <div class="form-header !mb-3">
                <h2 class="form-title">Edit Genre</h2>
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
                :initialValues="form"
            >
                <genre-form :form="form"></genre-form>

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
import { defineProps } from "vue";
import { useForm } from "@inertiajs/vue3";
import * as yup from "yup";
import { __ } from "matice";
import GenreForm from "../../../Forms/GenreForm.vue";
import { onMounted } from "vue";

const props = defineProps({
    genre: {
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
 * Pre-fill the form with existing movie data
 *
 * @returns void
 */
onMounted(() => {
    form.name = props.genre.name;
    form.description = props.genre.description;
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
        route("dashboard.genres.update", {
            genre: props.genre.id,
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
        },
    );
};
</script>
