<template>
    <Modal v-slot="{ close }">
        <div class="container mt-5 d-flex flex-column align-items-center">
            <h1 class="fw-semibold mb-4 text-zinc-800">{{ __('Create HallType') }}</h1>
            <vee-form
                :validation-schema="schema"
                @submit.prevent="submitForm"
                v-slot="{ meta, setErrors }"
                class="col-12"
            >
                <vee-field name="name" v-slot="{ field, errors }">
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __("Name") }}</label>
                    <input
                        type="text" class="form-control"
                        v-bind="field" v-model="form.name"
                        id="name" name="name" placeholder="Enter name"
                        :aria-describedby="'nameError'"
                    />
                    <span v-if="errors.length" id="nameError" class="text-danger">{{errors[0]}}</span>
                </div>
                </vee-field>

                <vee-field name="description" v-slot="{ field, errors }">
                <div class="mb-3">
                    <label for="description" class="form-label">{{__("Description")}}</label>
                    <textarea
                        class="form-control"
                        v-bind="field" v-model="form.description"
                        id="description" name="description" rows="3" placeholder="Enter description"
                        :aria-describedby="'descError'"
                    ></textarea>
                </div>
                </vee-field>

                <button
                    type="submit" @click="close"
                    class="btn btn-primary !font-medium !text-zinc-50"
                    :disabled="!meta.valid || form.processing"
                    @click.prevent="submitForm(setErrors)"
                >
                    <span
                        v-if="form.processing"
                        class="spinner-border spinner-border-sm me-2"
                        role="status"
                        aria-hidden="true"
                    ></span>
                    {{ __("Submit") }}
                </button>
            </vee-form>
        </div>
    </Modal>
</template>

<script setup>
    import { useForm } from "@inertiajs/vue3";
    import { markRaw } from "vue";
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

    const submitForm = () => {
        form.post(route('dashboard.hall_types.store'));
    }

</script>
