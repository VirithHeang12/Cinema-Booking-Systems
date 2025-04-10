<template>
  <Modal v-slot="{ close }">
    <div class="form-container">
      <div class="form-header !mb-3">
        <h2 class="form-title">Edit Classification</h2>
        <button
          type="button"
          class="btn btn-sm btn-close shadow-none"
          aria-label="Close"
          @click="close"
        ></button>
      </div>

      <vee-form
        class="form-content-container"
        :validation-schema="schema"
        @submit.prevent="submitForm"
        v-slot="{ meta, setErrors }"
        :initialValues="form"
      >
        <classification-form :form="form"></classification-form>

        <div class="form-actions">
          <v-btn
            color="primary"
            :disabled="!meta.valid || form.processing"
            :loading="form.processing"
            @click.prevent="submitForm(setErrors, close)"
            size="large"
            block
          >
            <v-icon class="me-2">mdi-check</v-icon>
            {{ __("Submit") }}
          </v-btn>
        </div>
      </vee-form>
    </div>
  </Modal>
</template>

<script setup>
  import { useForm } from "@inertiajs/vue3";
  import { __ } from "matice";
  import * as yup from "yup";
  import { onMounted } from "vue";
  import ClassificationForm from "../../../Forms/ClassificationForm.vue";

  const props = defineProps({
    classification: {
      type: Object,
      required: true,
    },
  });

  const schema = yup.object().shape({
    name: yup
      .string()
      .required(__("Classification name is required."))
      .max(50, __("Classification name must not exceed 50 characters.")),
    description: yup
      .string()
      .required(__("Classification description is required.")),
  });

  const form = useForm({
    name: "",
    description: "",
    _method: "PUT",
  });

  /**
   * Pre-fill the form with existing movie data
   *
   * @returns void
   */
  onMounted(() => {
    form.name = props.classification.name;
    form.description = props.classification.description;
  });

  /**
   * Submit the form data to the server
   *
   * @param setErrors
   * @param close
   *
   * @returns void
   */
  const submitForm = (setErrors, close) => {
    form
      .transform((data) => ({
        ...data,
        _method: "PUT",
      }))
      .post(
        route("dashboard.classifications.update", {
          classification: props.classification.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onError: (errors) => {
            setErrors(errors.errors);
          },
          onSuccess: () => {
            form.reset();
            close();
          },
        }
      );
  };
</script>
