<template>
    <Modal v-slot="{ close }">
        <div>
            <h4 class="text-gray-600">{{ __('Update Country') }}</h4>
            <form @submit.prevent="submitForm">
                <div class="form-group">
                    <label for="name" class="text-gray-600">{{ __('Name') }}</label>
                    <input type="text" v-model="form.name" class="form-control mt-2" id="name" name="name">
                </div>
                <button type="submit" @click="close" class="btn btn-primary text-white mt-5">{{ __('Update') }}</button>
            </form>
        </div>
    </Modal>
</template>

<script setup>
    import { defineProps } from 'vue';
    import { useForm } from '@inertiajs/vue3';

    const props = defineProps({
        country: {
            type: Object,
            required: true,
        }
    });

    const form = useForm({
        name: props.country.name,
    });

    const submitForm = () => {
        form.put(route('dashboard.countries.update', props.country.id));
    }
</script>



<!-- <template>
    <Modal v-slot="{ close }">
        <div>
            <h4 class="text-gray-600 mb-5">{{ __('Update Country') }}</h4>
            <vee-form :validation-schema="schema" @submit.prevent="submitForm" v-slot="{ meta, setErrors }">
                <vee-field name="name" v-slot="{ field, errors }">
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input type="text" id="name" class="form-control" v-bind="field" v-model="form.name"
                            :aria-describedby="'nameError'" />
                        <span v-if="errors.length" id="nameError" class="text-danger">{{ errors[0] }}</span>
                    </div>
                </vee-field>
                <v-btn @click="close" color="primary" class="mt-4 d-inline-flex justify-content-start"
                    :disabled="!meta.valid || form.processing" @click.prevent="submitForm(setErrors)">
                    <span v-if="form.processing" class="spinner-border spinner-border-sm me-2" role="status"
                        aria-hidden="true"></span>
                    {{ __('Update') }}
                </v-btn>
            </vee-form>
        </div>
    </Modal>
</template>

<script setup>
import { markRaw, defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';
import * as yup from 'yup';
import { __ } from 'matice';

const props = defineProps({
    country: {
        type: Object,
        required: true,
    },
});

const schema = markRaw(
    yup.object({
        name: yup.string().required(__('Country name is required')),
    })
);

const form = useForm({
    name: props.country.name,
});

const submitForm = () => {
    form.put(route('dashboard.countries.update', props.country.id));
};
</script> -->
