<template>
    <Modal v-slot="{ close }">
        <div>
            <h1>{{ __('Create Language') }}</h1>
            <vee-form :validation-schema="schema" @submit.prevent="submitForm" v-slot="{ meta, setErrors }">
                <v-row dense>
                    <v-col :cols="12" :md="6">
                        <vee-field name="name" v-slot="{ field, errors }">
                            <v-text-field v-bind="field" v-model="form.name" label="Name" variant="outlined"
                                :error-messages="errors"></v-text-field>
                        </vee-field>
                    </v-col>
                    <v-col :cols="12" :md="6">
                        <vee-field name="code" v-slot="{ field, errors }">
                            <v-text-field v-bind="field" v-model="form.code" label="Code" variant="outlined"
                                :error-messages="errors"></v-text-field>
                        </vee-field>
                    </v-col>
                </v-row>

                <v-row dense>
                    <v-col :cols="12">
                        <v-btn color="primary" class="mt-4 d-inline-flex justify-content-start "
                            :disabled="!meta.valid || form.processing" @click.prevent="submitForm(setErrors, close)">
                            <span v-if="form.processing" class="spinner-border spinner-border-sm me-2" role="status"
                                aria-hidden="true"></span>
                            Submit
                        </v-btn>
                    </v-col>
                </v-row>

            </vee-form>
        </div>
    </Modal>
</template>

<script setup>
    import { markRaw } from 'vue';
    import { useForm } from '@inertiajs/vue3';
    import * as yup from 'yup';
    import { __ } from 'matice';

    const schema = markRaw(yup.object({
        name: yup.string().required(__('Language name is required')),
        code: yup.string().required(__('Language code is required')),
    }));

    const form = useForm({
        name: '',
        code: '',
    });

    const submitForm = (setErrors, close) => {
        form.post(route('dashboard.languages.store'), {
            preserveState: true,
            onError: (errors) => {
                setErrors(errors);
            },
            onSuccess: () => {
                close();
            }
        });
    }

</script>
