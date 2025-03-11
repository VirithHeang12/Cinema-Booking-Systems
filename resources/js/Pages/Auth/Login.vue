<template>
    <v-card width="500" class="mx-auto mt-8">
        <vee-form :validation-schema="schema" @submit.prevent="submitForm" v-slot="{ meta, setErrors }">
            <vee-field name="email" v-slot="{ field, errors }">
                <v-text-field v-bind="field" :error-messages="errors" v-model="form.email" label="Email"
                    variant="outlined"></v-text-field>
            </vee-field>
            <vee-field name="password" v-slot="{ field, errors }">
                <v-text-field v-bind="field" :error-messages="errors" v-model="form.password" label="Password"
                    variant="outlined"></v-text-field>
            </vee-field>
            <v-checkbox v-model="form.remember" label="Remember me"></v-checkbox>
            <v-btn color="primary" class="mt-4 d-inline-flex justify-content-start "
                :disabled="!meta.valid || form.processing" @click.prevent="submitForm(setErrors)">
                <span v-if="form.processing" class="spinner-border spinner-border-sm me-2" role="status"
                    aria-hidden="true"></span>
                Submit
            </v-btn>
        </vee-form>
    </v-card>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3';
    import * as yup from 'yup';
    import { route } from 'ziggy-js';

    const schema = yup.object().shape({
        email: yup.string().required().email(),
        password: yup.string().required().min(8),
    })

    const form = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const submitForm = (setErrors) => {
        form.post(route('login.store'), {
            onError: (errors) => {
                setErrors(errors);
            }
        });
    }
</script>
