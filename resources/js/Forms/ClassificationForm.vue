<template>
  <div class="form-content grid gap-3">
    <vee-field name="name" v-slot="{ field, errors }" class="!mb-5">
      <v-text-field
        v-bind="field"
        :error-messages="errors"
        v-model="form.name"
        :label="__('Name')"
        variant="outlined"
        density="comfortable"
      ></v-text-field>
    </vee-field>

    <vee-field name="description" v-slot="{ field, errors }" class="!mb-3">
      <v-textarea
        v-bind="field"
        :error-messages="errors"
        v-model="form.description"
        :label="__('Description')"
        variant="outlined"
        rows="3"
        auto-grow
      ></v-textarea>
    </vee-field>
  </div>
</template>

<script setup>
  import { __ } from "matice";

  const props = defineProps({
    form: {
      type: Object,
      required: true,
    }
  });
</script>
