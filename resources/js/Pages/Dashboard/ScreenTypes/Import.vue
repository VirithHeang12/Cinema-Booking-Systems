<template>
    <Modal v-slot="{ close }">
        <div class="screen-type-form-container">
            <div class="form-header">
                <h2 class="form-title text-h4">Import Screen Type</h2>
                <v-btn icon class="close-btn" @click="close">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
            </div>

            <vee-form :validation-schema="schema" @submit="submitForm" v-slot="{ errors }">
                <div class="form-content">
                    <div class="file-upload-section">
                        <h3 class="mb-6 upload-title">Select File to Import</h3>

                        <v-file-input v-model="form.file" :error-messages="form.errors.file" accept=".xlsx"
                            label="Please select Excel file" prepend-icon="mdi-file-excel" show-size
                            truncate-length="30" variant="outlined" class="mb-2" density="comfortable" persistent-hint
                            hint="Supported format: .xlsx">
                            <template v-slot:selection="{ fileNames }">
                                <v-chip color="primary" label size="small" class="me-2">
                                    {{ fileNames[0] }}
                                </v-chip>
                            </template>
                        </v-file-input>

                        <div class="mt-6 mb-8 text-center supported-formats">
                            <div class="divider-text">
                                <span class="text-body-2 text-grey">Supported format: .xlsx</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 file-info" v-if="form.file">
                        <v-card variant="outlined" class="pa-4">
                            <div class="d-flex align-center">
                                <v-icon size="large" color="primary" class="me-4">mdi-information-outline</v-icon>
                                <div>
                                    <p class="mb-1 text-h6">{{ form.file.name }}</p>
                                    <p class="text-body-2 text-grey-darken-1">{{ formatFileSize(form.file.size) }}</p>
                                </div>
                            </div>
                        </v-card>
                    </div>

                    <div class="flex-grow-1"></div>
                </div>

                <div class="form-actions">
                    <v-btn color="primary" :disabled="!form.file || form.processing" :loading="form.processing"
                        @click="submitForm(close)" type="button" size="large" block height="56"
                        class="upload-button text-h6">
                        <v-icon size="24" class="me-2">mdi-upload</v-icon>
                        UPLOAD
                    </v-btn>
                </div>
            </vee-form>
        </div>
    </Modal>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3';
    import { ref, computed, watch } from 'vue';
    import { __ } from 'matice';
    import * as yup from 'yup';

    // File validation - allow only Excel (.xlsx) files with size limit
    const ALLOWED_FILE_TYPES = [
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' // xlsx
    ];
    const MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB

    // Validation schema
    const schema = yup.object().shape({
        file: yup
            .mixed()
            .required(__('Please select a file to import'))
            .test('fileRequired', __('Please select a file to import'), (value) => {
                return value !== null && value !== undefined;
            })
            .test('fileSize', __('File size must be less than 10MB'), (value) => {
                if (!value) return true;
                return value.size <= MAX_FILE_SIZE;
            })
            .test('fileType', __('File must be Excel (.xlsx) format'), (value) => {
                if (!value) return true;
                return ALLOWED_FILE_TYPES.includes(value.type) ||
                    value.name.endsWith('.xlsx');
            })
    });

    // Form setup
    const form = useForm({
        file: null
    });

    // Helper function to format file size
    const formatFileSize = (bytes) => {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    };

    /**
     * Submit the form
     *
     * @returns void
     */
    const submitForm = (close) => {
        // Set the file from the file input
        if (form.file) {
            form.post(route('dashboard.screen_types.import'), {
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
    watch(() => form.file, (newFile) => {
        if (newFile instanceof File) {
            // File is selected
            form.clearErrors('file');
        }
    });
</script>

<style scoped>

    /* Styled container with increased size */
    .screen-type-form-container {
        max-width: 800px;
        width: 100%;
        margin: 0 auto;
        padding: 0;
        background-color: #fff;
        border-radius: 8px;
        min-height: 400px;
        display: flex;
        flex-direction: column;
    }

    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 24px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.12);
        margin-bottom: 0;
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

    .form-content {
        padding: 32px;
        flex: 1;
        min-height: 250px;
        overflow-y: auto;
        scrollbar-width: thin;
        display: flex;
        flex-direction: column;
    }

    .form-content::-webkit-scrollbar {
        width: 6px;
    }

    .form-content::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 3px;
    }

    .form-actions {
        padding: 24px 32px;
        border-top: 1px solid rgba(0, 0, 0, 0.12);
    }

    .upload-button {
        letter-spacing: 1.5px;
        font-weight: 500;
    }

    .upload-title {
        font-size: 18px;
        color: #424242;
        font-weight: 500;
    }

    .divider-text {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .divider-text:before,
    .divider-text:after {
        content: "";
        height: 1px;
        background-color: rgba(0, 0, 0, 0.12);
        flex-grow: 1;
    }

    .divider-text span {
        padding: 0 16px;
    }

    .file-upload-section {
        display: flex;
        flex-direction: column;
        align-items: stretch;
    }
</style>
