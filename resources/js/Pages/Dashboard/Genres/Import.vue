<template>
    <Modal v-slot="{ close }">
        <div class="form-container">
            <div class="form-header">
                <h2 class="form-title">Import Genres</h2>
                <button
                    type="button"
                    class="btn btn-sm btn-close shadow-none"
                    aria-label="Close"
                    @click="close"
                ></button>
            </div>

            <vee-form :validation-schema="schema" @submit="submitForm">
                <div class="form-content">
                    <h3 class="!text-[16px] text-zinc-700 my-2">
                        Browse Excel file to import
                    </h3>

                    <v-file-input
                        v-model="form.file"
                        :error-messages="form.errors.file"
                        accept=".xlsx"
                        label="Please select Excel file"
                        prepend-icon=""
                        prepend-inner-icon="mdi-file-excel"
                        show-size
                        truncate-length="30"
                        variant="outlined"
                        class="my-5"
                        density="comfortable"
                        persistent-hint
                        hint="Supported format: .xlsx"
                    >
                        <template v-slot:selection="{ fileNames }">
                            <v-chip
                                color="primary"
                                label
                                size="small"
                                class="me-2"
                            >
                                {{ fileNames[0] }}
                            </v-chip>
                        </template>
                    </v-file-input>
                </div>

                <div class="form-actions">
                    <v-btn
                        color="primary"
                        :disabled="!form.file || form.processing"
                        :loading="form.processing"
                        @click="submitForm(close)"
                        type="button"
                        size="large"
                        block
                        height="56"
                        class="!text-lg"
                    >
                        <v-icon size="24" class="me-2">mdi-upload</v-icon>
                        UPLOAD
                    </v-btn>
                </div>
            </vee-form>
        </div>
    </Modal>
</template>

<script setup>
import { watch, ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import { __ } from "matice";
import * as yup from "yup";

// File validation - allow only Excel (.xlsx) files with size limit
const ALLOWED_FILE_TYPES = [
    "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", // xlsx
];

const MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB

// Validation schema
const schema = yup.object().shape({
    file: yup
        .mixed()
        .required(__("Please select a file to import"))
        .test("fileRequired", __("Please select a file to import"), (value) => {
            return value !== null && value !== undefined;
        })
        .test("fileSize", __("File size must be less than 10MB"), (value) => {
            if (!value) return true;
            return value.size <= MAX_FILE_SIZE;
        })
        .test("fileType", __("File must be Excel (.xlsx) format"), (value) => {
            if (!value) return true;
            return (
                ALLOWED_FILE_TYPES.includes(value.type) ||
                value.name.endsWith(".xlsx")
            );
        }),
});

const form = useForm({
    file: null,
});

/**
 * Submit the form
 *
 * @returns void
 */
const submitForm = (close) => {
    // Set the file from the file input
    if (form.file) {
        form.post(route("dashboard.genres.import"), {
            preserveState: true,
            preserveScroll: true,
            forceFormData: true,
            onSuccess: () => {
                form.reset();
                close();
            },
            onError: (errors) => {
                console.error(errors);
            },
        });
    }
};

// Watch for file changes and update form data
watch(
    () => form.file,
    (newFile) => {
        if (newFile instanceof File) {
            // File is selected
            form.clearErrors("file");
        }
    },
);
</script>
