<template>
    <div class="image-upload-component">
        <div class="image-upload-header" v-if="showLabel">
            <span class="image-upload-label">
                <v-icon size="small" class="me-1">{{ icon }}</v-icon>
                {{ label }}
            </span>
        </div>

        <div class="image-upload-area">
            <div v-if="modelValue" class="image-preview">
                <img :src="previewUrl" :alt="label + ' preview'" class="preview-image" />
                <button type="button" class="remove-image" @click="removeImage">
                    <v-icon size="small">mdi-close</v-icon>
                </button>
            </div>
            <div v-else class="image-upload-placeholder">
                <label :for="inputId" class="upload-button">
                    <v-icon class="me-1">mdi-upload</v-icon>
                    {{ uploadButtonText }}
                </label>
                <input type="file" :id="inputId" accept="image/*" @change="handleFileUpload" class="file-input" />
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref, computed, watch, onMounted } from 'vue';

    const props = defineProps({
        modelValue: {
            type: [File, null],
            default: null
        },
        label: {
            type: String,
            default: 'Image'
        },
        icon: {
            type: String,
            default: 'mdi-image'
        },
        uploadButtonText: {
            type: String,
            default: 'Upload Image'
        },
        showLabel: {
            type: Boolean,
            default: true
        },
        inputId: {
            type: String,
            default: 'image-upload'
        }
    });

    const emit = defineEmits(['update:modelValue']);

    // Create reactive state for image preview
    const previewUrl = ref(null);

    // Generate preview when file changes
    const generatePreview = (file) => {
        if (!file) {
            previewUrl.value = null;
            return;
        }

        const reader = new FileReader();
        reader.onload = (e) => {
            previewUrl.value = e.target.result;
        };
        reader.readAsDataURL(file);
    };

    // Watch for changes to modelValue
    watch(() => props.modelValue, (newFile) => {
        generatePreview(newFile);
    }, { immediate: true });

    // Handle file upload
    const handleFileUpload = (event) => {
        const file = event.target.files[0];
        if (!file) return;

        emit('update:modelValue', file);
    };

    // Remove image
    const removeImage = () => {
        emit('update:modelValue', null);

        // Clear the file input
        const fileInput = document.getElementById(props.inputId);
        if (fileInput) {
            fileInput.value = '';
        }
    };
</script>

<style scoped>
    .image-upload-component {
        width: 100%;
    }

    .image-upload-header {
        margin-bottom: 8px;
    }

    .image-upload-label {
        display: flex;
        align-items: center;
        font-size: 16px;
        font-weight: 500;
        color: rgba(0, 0, 0, 0.87);
    }

    .image-upload-area {
        width: 100%;
        height: 180px;
        border: 1px dashed rgba(0, 0, 0, 0.38);
        border-radius: 4px;
        overflow: hidden;
    }

    .image-preview {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f5f5f5;
    }

    .preview-image {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .remove-image {
        position: absolute;
        top: 8px;
        right: 8px;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        border: none;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.2s;
    }

    .remove-image:hover {
        background: rgba(0, 0, 0, 0.8);
    }

    .image-upload-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: #f5f5f5;
    }

    .upload-button {
        display: flex;
        align-items: center;
        background-color: #e0e0e0;
        color: rgba(0, 0, 0, 0.87);
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .upload-button:hover {
        background-color: #d0d0d0;
    }

    .file-input {
        display: none;
    }
</style>
