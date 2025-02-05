<template>
    <Modal v-slot="{ close }">
        <div>
            <h1>{{ __('Edit Language') }}</h1>
            <vee-form :validation-schema="schema" @submit.prevent="submitForm" v-slot="{ meta, setErrors }">
                <vee-field name="code" v-model="form.code" v-slot="{ field: { value, ...field }, errors }">
                    <v-text-field v-bind="field" :model-value="value" :error-messages="errors" :label="__('Code')"
                        variant="outlined"></v-text-field>
                </vee-field>

                <vee-field name="name" v-model="form.name" v-slot="{ field: { value, ...field }, errors }">
                    <v-text-field v-bind="field" :model-value="value" :error-messages="errors" :label="__('Name')"
                        variant="outlined"></v-text-field>
                </vee-field>

                <v-file-input v-model="form.attachment" accept="image/*"></v-file-input>

                <v-btn @click="close" color="primary" :disabled="!meta.valid || form.processing"
                    :loading="form.processing" @click.prevent="submitForm(setErrors)" block>Submit</v-btn>
            </vee-form>
        </div>
    </Modal>
</template>

<script setup>
    import { markRaw, defineProps } from 'vue';
    import { useForm } from '@inertiajs/vue3';
    import * as yup from 'yup';
    import { __ } from 'matice';
    import { useSetFormErrors } from 'vee-validate';

    const schema = yup.object({
        name: yup.string().required(__('Language name is required')),
        code: yup.string().required(__('Language code is required')),
    });

    const props = defineProps({
        language: {
            type: Object,
            required: true,
        }
    });

    const form = useForm({
        name: props.language.name,
        code: props.language.code,
        attachment: null,
    });

    const submitForm = () => {
        form.method = "PUT";
        form.transform((data) => ({
            ...data,
            _method: "PUT",
        })).post(route('dashboard.languages.update', {
            language: props.language.id
        }), {
            preserveScroll: true,
            preserveState: true,
            onError: (errors) => {
                useSetFormErrors(errors, form);
            }
        });
    }
</script>
