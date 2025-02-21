<template>
    <Modal v-slot="{ close }">
        <div>
            <h1>Create Screen Type</h1>
            <vee-form :validation-schema="schema" @submit.prevent="submitForm" v-slot="{ meta, setErrors }">
                <vee-field name="name" v-slot="{ field, errors }">
                    <v-text-field v-bind="field" :error-messages="errors" v-model="form.name" :label="__('Name')"
                        variant="outlined"></v-text-field>
                </vee-field>

                <vee-field name="description" v-slot="{ field, errors }">
                    <v-text-field v-bind="field" :error-messages="errors" v-model="form.description"
                        :label="__('Description')" variant="outlined"></v-text-field>
                </vee-field>

                <v-btn @click="close" color="primary" :disabled="!meta.valid || form.processing"
                    :loading="form.processing" @click.prevent="submitForm(setErrors)" block>Submit</v-btn>
            </vee-form>
        </div>
    </Modal>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import * as yup from 'yup'
import { __ } from 'matice'

const schema = yup.object().shape({
    name: yup.string().required(__('Screen Type name is required')),
    description: yup.string().required(__('Screen Type description is required')),
});

const form = useForm({
    name: '',
    description: '',
});

const submitForm = () => {
    form.post(route('dashboard.screen_types.store'));
}
</script>
