<template>
    <div>
        <h1>{{ __('Create Language') }}</h1>
        <vee-form :validation-schema="schema" @submit.prevent="submitForm" v-slot="{ meta, setErrors }">
            <vee-field name="code" v-slot="{ field, errors }">
                <v-text-field v-bind="field" :error-messages="errors" v-model="form.code" :label="__('Code')"
                    variant="outlined"></v-text-field>
            </vee-field>

            <vee-field name="name" v-slot="{ field, errors }">
                <v-text-field v-bind="field" :error-messages="errors" v-model="form.name" :label="__('Name')"
                    variant="outlined"></v-text-field>
            </vee-field>

            <v-btn color="primary" :disabled="!meta.valid || form.processing" :loading="form.processing"
                @click.prevent="submitForm(setErrors)" block>Submit</v-btn>
        </vee-form>
    </div>
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

    const submitForm = () => {
        form.post(route('dashboard.languages.store'));
    }

</script>
