
<template>
    <Modal v-slot="{ close }">
        <div>
            <h4 class="text-gray-700 mb-5">{{ __('Create Country') }}</h4>
            <vee-form :validation-schema="schema" @submit="submitForm" v-slot="{ meta, setErrors }">
                <vee-field name="name" v-slot="{ field, errors }">
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input type="text" id="name" class="form-control" v-bind="field" v-model="form.name"
                            :aria-describedby="'nameError'" />
                        <span v-if="errors.length" id="nameError" class="text-danger">{{ errors[0] }}</span>
                    </div>
                </vee-field>

                <!-- <v-btn color="primary" class="mt-4 d-inline-flex justify-content-start"
                    :disabled="!meta.valid || form.processing" @click.prevent="submitForm(setErrors, close)">
                    <span v-if="form.processing" class="spinner-border spinner-border-sm me-2" role="status"
                        aria-hidden="true"></span>
                    {{ __('Submit') }}
                </v-btn> -->

                <button type="submit" @click="close" class="btn btn-primary !font-medium !text-zinc-50"
                    :disabled="!meta.valid || form.processing" @click.prevent="submitForm(setErrors)">
                    <span v-if="form.processing" class="spinner-border spinner-border-sm me-2" role="status"
                        aria-hidden="true"></span>
                    {{ __("Submit") }}
                </button>
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
    name: yup.string()
            .required(__('Country name is required'))
            .max(50, __("Country name must not be greater than 50 characters.")),
}));

const form = useForm({
    name: '',
});

const submitForm = (setErrors, close) => {
    form.post(route('dashboard.countries.store'), {
        preserveState: true,
        onError: (errors) => {
            setErrors(errors);
        },
        onSuccess: () => {
            close();
        },
    });
};
</script>

<style>
.im-close-button {
    background-color: transparent !important;
}
</style>
