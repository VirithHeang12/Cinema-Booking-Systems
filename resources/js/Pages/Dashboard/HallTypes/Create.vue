<template>
    <Modal v-slot="{ close }">
        <div class="container mt-5 d-flex flex-column align-items-center">
            <h1 class="fw-semibold mb-5 text-zinc-800">{{ __('Create HallType') }}</h1>
            <vee-form :validation-schema="schema" @submit.prevent="submitForm" v-slot="{ meta, setErrors }"
                class="col-12">
                <v-row dense>
                    <v-col :cols="12">
                        <vee-field name="name" v-slot="{ field, errors }">
                            <v-text-field v-bind="field" v-model="form.name" :label="__('Name')" variant="outlined"
                                :error-messages="errors"></v-text-field>
                        </vee-field>
                    </v-col>
                    <v-col :cols="12">
                        <vee-field name="description" v-slot="{ field, errors }">
                            <v-textarea v-bind="field" v-model="form.description" :label="__('Description')" variant="outlined"
                                :error-messages="errors"></v-textarea>
                        </vee-field>
                    </v-col>
                </v-row>

                <v-row dense>
                    <v-col :cols="12">
                        <v-btn color="primary" class="mt-4 d-inline-flex justify-content-start "
                            :disabled="!meta.valid || form.processing" @click.prevent="submitForm(setErrors, close)">
                            <span v-if="form.processing" class="spinner-border spinner-border-sm me-2" role="status"
                                aria-hidden="true"></span>
                                {{ __("Submit") }}
                        </v-btn>
                    </v-col>
                </v-row>
            </vee-form>
        </div>
    </Modal>
</template>

<script setup>
    import { useForm} from "@inertiajs/vue3";
    import { markRaw} from "vue";
    import * as yup from "yup";
    import { __ } from "matice";

    const schema = markRaw(
        yup.object({
            name: yup
                .string()
                .required(__("HallType name is required."))
                .max(50, __("HallType name must not exceed 50 characters."))
        })
    );

    const form = useForm({
        name: '',
        description: '',
    });

    const submitForm = (setErrors, close) => {
        form.post(route('dashboard.hall_types.store'), {
            preserveState: true,
            onError: (errors) => {
                setErrors(errors);
            },
            onSuccess: () => {
                close();
            },
        });
    }
</script>
