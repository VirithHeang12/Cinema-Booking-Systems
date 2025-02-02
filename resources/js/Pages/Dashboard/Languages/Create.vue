<template>
    <Modal v-slot="{ close }">
        <div>
            <h1>Create Language</h1>
            <vee-form :validation-schema="schema" @submit.prevent="submitForm" v-slot="{ meta, setErrors }">
                <v-card class="mt-2">
                    <vee-field name="code" v-slot="{ field, errors }">
                        <v-text-field v-bind="field" :error-messages="errors" v-model="form.code" :label="__('Code')"
                            variant="outlined"></v-text-field>
                    </vee-field>
                    <v-card-text>
                        <v-btn @click="close" :disabled="!meta.valid || form.processing" :loading="form.processing"
                            @click.prevent="submitForm(setErrors)" block>Submit</v-btn>
                    </v-card-text>
                </v-card>
            </vee-form>
        </div>
    </Modal>
</template>

<script setup>
    import { defineComponent, markRaw } from 'vue';
    import { useForm } from '@inertiajs/vue3';
    import { Field, Form, ErrorMessage } from 'vee-validate';
    import * as yup from 'yup';

    defineComponent({
        Form,
        Field,
        ErrorMessage
    });

    const schema = markRaw(yup.object({
        name: yup.string().required('Name is required'),
        code: yup.string().required('Code is required'),
    }));

    const form = useForm({
        name: '',
        code: '',
    });

    const submitForm = () => {
        form.post(route('dashboard.languages.store'));
    }

</script>
