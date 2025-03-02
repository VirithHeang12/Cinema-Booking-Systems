<template>
    <div class="container mt-5 d-flex flex-column align-items-center">
        <h1 class="fw-semibold mb-3 text-zinc-800">{{ __('Create Genre') }}</h1>
        <hr class="my-2" />
        <vee-form :validation-schema="schema" @submit.prevent="submitForm" v-slot="{ meta, setErrors }" class="col-12">
            <vee-field name="name" v-slot="{ field, errors }">
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __("Name") }}</label>
                    <input type="text" class="form-control" v-bind="field" v-model="form.name" id="name" name="name"
                        placeholder="Enter genre name" :aria-describedby="'nameError'" />
                    <span v-if="errors.length" id="nameError" class="text-danger">{{
                        errors[0]
                    }}</span>
                </div>
            </vee-field>

            <vee-field name="description" v-slot="{ field, errors }">
                <div class="mb-3">
                    <label for="description" class="form-label">{{
                        __("Description")
                    }}</label>
                    <textarea class="form-control" v-bind="field" v-model="form.description" id="description"
                        name="description" rows="3" placeholder="Enter genre description"
                        :aria-describedby="'descError'"></textarea>
                    <span v-if="errors.length" id="descError" class="text-danger">{{
                        errors[0]
                    }}</span>
                </div>
            </vee-field>

            <button type="submit"
                class="btn btn-dark text-white w-full mt-4 bg-primary-800 round-[10px] px-9 py-2 hover:bg-gray-800"
                :disabled="!meta.valid || form.processing" @click.prevent="submitForm(setErrors)">
                <span v-if="form.processing" class="spinner-border spinner-border-sm me-2" role="status"
                    aria-hidden="true"></span>
                {{ __("Submit") }}
            </button>
        </vee-form>
    </div>
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
                .required(__("Genre name is required."))
                .max(50, __("Genre name must not exceed 50 characters.")),
        })
    );

    const form = useForm({
        name: "",
        description: "",
    });
    const submitForm = () => {
        form.post(route("dashboard.genres.store"));
    };

</script>
